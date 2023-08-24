<?php

declare(strict_types=1);

namespace Chestnut\Router;

class RouteBuilder implements RouteBuilderInterface
{
    public function __construct(private readonly Factory $factory)
    {
    }

    public function add(): self
    {

    }

    public function create(): RouteInterface
    {
        return $this->factory->createRoute();
    }
}