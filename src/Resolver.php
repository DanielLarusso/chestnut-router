<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\DependencyInjection\ContainerTrait;
use Chestnut\Http\RequestMethod;
use Chestnut\Router\Exception\RouteNotFoundException;

use function call_user_func;
use function class_exists;
use function explode;
use function is_callable;
use function method_exists;

class Resolver implements ResolverInterface
{
    use ContainerTrait;

    public function resolve(string $requestUri, RequestMethod $requestMethod, array $routes): mixed
    {
        $route = explode('?', $requestUri)[0];
        $action = $routes[$requestMethod->value][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException($route, $requestMethod);
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;

        if (class_exists($class)) {
            $class = $this->getContainer()->get($class);

            if (method_exists($class, $method)) {
                return call_user_func_array([$class, $method], []);
            }
        }

        throw new RouteNotFoundException($class, $method);
    }
}
