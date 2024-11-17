<?php

declare(strict_types=1);

namespace Ray\Auth0Module;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use PHPUnit\Framework\TestCase;
use Ray\Auth0Module\Provider\FakeManagementClientProvider;
use Ray\Di\AbstractModule;
use Ray\Di\Injector;

class Auth0ModuleTest extends TestCase
{
    private AbstractModule $module;

    public function testModule() : void
    {
        $this->module = new class extends AbstractModule {
            protected function configure() : void
            {
                $this->bind(Management::class)->toProvider(FakeManagementClientProvider::class);
                $this->install(new Auth0Module([
                    'domain' => 'https://example.com',
                    'clientId' => 'AUTH0_CLIENT_ID',
                    'clientSecret' => 'AUTH0_CLIENT_SECRET',
                    'cookieSecret' => 'AUTH0_COOKIE_SECRET'
                ]));
            }
        };
        $injector = (new Injector($this->module, dirname(__DIR__) . '/tmp'));
        $this->assertInstanceOf(Authentication::class, $injector->getInstance(Authentication::class));
        $this->assertInstanceOf(Management::class, $injector->getInstance(Management::class));
    }
}
