<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Utils\AbstractFactory;

class Factory extends AbstractFactory
{
    public function createRouteCollection(): RouteCollection
    {
        return new RouteCollection();
    }

    public function createResolver(): ResolverInterface
    {
        return new Resolver();
    }

    public function createRoute(): RouteInterface
    {
        return new Route();
    }

    public function createRouteBuilder(): RouteBuilderInterface
    {
        return new RouteBuilder($this);
    }

    public function createRouter(): RouterInterface
    {
        return new Router(
            $this->createResolver(),
            $this->createRouteCollection()
        );
    }
}
