<?php

declare(strict_types=1);

namespace Chestnut\Router;

interface RouteInterface
{
    public function getMethod(): string;

    public function getRoute(): string;

    public function getAlias(): ?string;

    public function getAction(): callable|array;
}