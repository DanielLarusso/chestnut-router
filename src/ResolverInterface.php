<?php

declare(strict_types=1);

namespace Chestnut\Router;

interface ResolverInterface
{
    public function resolve(string $requestUri, string $requestMethod, array $routes): mixed;
}