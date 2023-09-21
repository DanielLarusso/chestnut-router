<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Http\RequestMethod;
use Closure;

class Route implements RouteInterface
{
    private RequestMethod $method = RequestMethod::GET;

    private string $route;

    private ?string $alias = null;

    private Closure|array $action;

    public function getMethod(): RequestMethod
    {
        return $this->method;
    }

    public function setMethod(RequestMethod $method): static
    {
        $this->method = $method;

        return $this;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getAction(): callable|array
    {
        return $this->action;
    }

    public function setAction(array|callable $action): static
    {
        $this->action = $action;

        return $this;
    }
}