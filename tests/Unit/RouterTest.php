<?php

declare(strict_types=1);

namespace Chestnut\Router\Tests\Unit;

use Chestnut\Router\Resolver;
use Chestnut\Router\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testRegister(): void
    {
        $router = new Router(new Resolver());
        $result = $router->register('get', '/test', ['test']);

        $this->assertInstanceOf(Router::class, $result);
    }

    public function test__construct()
    {
    }

    public function testResolve()
    {
    }

    public function testRoutes()
    {
    }

    public function testRegisterRoutesFromControllerAttributes()
    {
    }
}
