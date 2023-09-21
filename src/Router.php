<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Http\RequestMethod;
use Chestnut\Router\Attribute\Route;
use ReflectionClass;

class Router implements RouterInterface
{
    public function __construct(
        private readonly ResolverInterface $resolver,
        private RouteCollection $routes
    ) {
    }

    // todo: enum RequestMethod
    // todo: action should be an object
    // todo: route should be an object
    public function register(RouteInterface $route): self
    {
        if ($this->routes->hasElement($route)) {
            return $this;
        }

        $this->routes->addElement($route);

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
            $method->getParameters();

            foreach ($attributes as $attribute) {
                $route = $attribute->newInstance();

                $this->register($route->method, $route->path, [$controller, $method->getName()]);
            }
        }

        return $this;
    }

    // todo: return routesCollection
    public function routes(): array
    {
        return $this->routes;
    }

    // todo Request object as param
    public function resolve(string $requestUri, RequestMethod $requestMethod): mixed
    {
        return $this->resolver->resolve($requestUri, $requestMethod, $this->routes);
    }
}
