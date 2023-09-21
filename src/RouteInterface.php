<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Http\RequestMethod;

interface RouteInterface
{
    public function getMethod(): RequestMethod;

    public function getRoute(): string;

    public function getAlias(): ?string;

    public function getAction(): callable|array;
}