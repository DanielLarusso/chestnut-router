<?php

declare(strict_types=1);

namespace Chestnut\Router\Attribute;

use Attribute;
use Chestnut\Http\RequestMethod;

#[Attribute]
readonly class Route
{
    public function __construct(public string $path, public RequestMethod $method = RequestMethod::GET)
    {

    }
}