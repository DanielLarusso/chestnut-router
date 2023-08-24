<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Router\Exception\RouteNotFoundException;

use function call_user_func;
use function explode;
use function is_callable;

class Resolver implements ResolverInterface
{
    public function resolve(string $requestUri, string $requestMethod, array $routes): mixed
    {
        $route = explode('?', $requestUri)[0];
        $action = $routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException($route, $requestMethod);
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;

        if (class_exists($class)) {
            $class = $this->container->get($class);

            if (method_exists($class, $method)) {
                return call_user_func_array([$class, $method], []);
            }
        }

        throw new RouteNotFoundException($class, $method);
    }
}
