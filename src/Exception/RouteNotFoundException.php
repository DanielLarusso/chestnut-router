<?php

declare(strict_types=1);

namespace Chestnut\Router\Exception;

use Chestnut\Http\RequestMethod;

use function sprintf;

class RouteNotFoundException extends ResolverException
{
    public function __construct(string $route, RequestMethod $method)
    {
        parent::__construct(sprintf('Route %s with method %s nor found.', $route, $method->value));
    }
}