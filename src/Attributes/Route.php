<?php

declare(strict_types=1);

namespace Chestnut\Router\Attributes;

use Attribute;

#[Attribute]
readonly class Route
{
    public function __construct(public string $path, public string $method = 'GET')
    {

    }
}