<?php

declare(strict_types=1);

namespace Ray\Auth0Module;

use Auth0\SDK\API\Authentication;
use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;

class Auth0ModuleTest extends TestCase
{
    private Injector $injector;

    protected function setUp(): void
    {
        parent::setUp();
        $this->injector = new Injector(new Auth0Module('__TEST_DOMAIN', '__TEST_CLIENT_ID__', '__TEST_CLIENT_SECRET__'), __DIR__ . '/tmp');
    }

    public function testAuthentication(): void
    {
        $instance = $this->injector->getInstance(Authentication::class);
        $this->assertInstanceOf(Authentication::class, $instance);
    }
}
