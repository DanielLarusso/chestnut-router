<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Controller\AbstractController;
use Chestnut\Router\Attributes\Route;
use ReflectionClass;

class Router
{
    public const REQUEST_METHOD_GET = 'get';

    private array $routes = [];

    public function __construct(private readonly Resolver $resolver)
    {
    }

    public function register(string $requestMethod, string $route, callable|array $action): static
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function registerRoutesFromControllerList(array $controllers): static
    {
        foreach ($controllers as $controller) {
            $this->registerRoutesFromController($controller);
        }

        return $this;
    }

    public function registerRoutesFromController(string $controller): static
    {
        $controllerReflection = new ReflectionClass($controller);

        foreach ($controllerReflection->getMethods() as $method) {
            $attributes = $method->getAttributes(Route::class);

            foreach ($attributes as $attribute) {
                $route = $attribute->newInstance();

                $this->register($route->method, $route->path, [$controller, $method->getName()]);
            }
        }

        return $this;
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        return $this->resolver->resolve($requestUri, $requestMethod, $this->routes);
    }
}
