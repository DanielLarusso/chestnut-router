<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Router\Attributes\Route;
use Psr\Container\ContainerInterface;
use ReflectionClass;

class Router
{
    public const REQUEST_METHOD_GET = 'get';
    public const REQUEST_METHOD_POST = 'post';

    /**
     * @param Resolver $resolver
     * @param array<string> $routes
     */
    public function __construct(private readonly Resolver $resolver, private array $routes = [])
    {
    }

    public function register(string $requestMethod, string $route, callable|array $action): static
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function registerRoutesFromControllerAttributes(array $controllers): static
    {
        foreach ($controllers as $controller) {
            $controllerReflection = new ReflectionClass($controller);

            foreach ($controllerReflection->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();

                    $this->register($route->method, $route->path, [$controller, $method->getName()]);
                }
            }
        }
    }

    public function get(string $route, callable|array $action): static
    {
        return $this->register(self::REQUEST_METHOD_GET, $route, $action);
    }

    public function post(string $route, callable|array $action): static
    {
        return $this->register(self::REQUEST_METHOD_POST, $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        return $this->resolver->resolve($requestUri, $requestMethod, $this->routes);
    }
}
