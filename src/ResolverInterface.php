<?php

declare(strict_types=1);

namespace Chestnut\Router;

use Chestnut\Http\RequestMethod;

interface ResolverInterface
{
    public function resolve(string $requestUri, RequestMethod $requestMethod, array $routes): mixed;
}