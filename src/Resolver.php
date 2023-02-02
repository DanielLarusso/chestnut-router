<?php

declare(strict_types=1);

namespace Chestnut\Router;

use function call_user_func;
use function explode;
use function is_callable;

class Resolver
{
    public function resolve(string $requestUri, string $requestMethod, array $routes)
    {
        $route = explode('?', $requestUri)[0];
        $action = $routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
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

        throw new RouteNotFoundException();
    }
}