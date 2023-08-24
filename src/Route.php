<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Closure;

class Route implements RouteInterface
{
    private string $method = 'get';

    private string $route;

    private ?string $alias = null;

    private Closure|array $action;

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getAction(): callable|array
    {
        return $this->action;
    }

    public function setAction(array|callable $action): self
    {
        $this->action = $action;

        return $this;
    }
}