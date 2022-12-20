<?php

declare(strict_types=1);
namespace Ray\Auth0Module;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use josegonzalez\Dotenv\Loader;
use PHPUnit\Framework\TestCase;
use Ray\AuraWebModule\AuraWebModule;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Auth0Module\Annotation\Extractors;
use Ray\Auth0Module\Auth\Auth;
use Ray\Auth0Module\Auth\AuthInterface;
use Ray\Auth0Module\Extractor\AuthorizationHeaderTokenExtractor;
use Ray\Auth0Module\Extractor\TokenExtractorResolver;
use Ray\Auth0Module\Provider\AuthenticationClientProvider;
use Ray\Auth0Module\Provider\ManagementClientProvider;
use Ray\Di\AbstractModule;
use Ray\Di\Injector;
use Ray\Di\Scope;

class Auth0ModuleTest extends TestCase
{
    public function testModule() : void
    {
        $this->module = new class extends AbstractModule {
            protected function configure() : void
            {
                $this->install(new Auth0Module([
                    'domain' => 'AUTH0_DOMAIN',
                    'client_id' => 'AUTH0_CLIENT_ID',
                    'client_secret' => 'AUTH0_CLIENT_SECRET',
                ]));
            }
        };
        $injector = (new Injector($this->module, dirname(__DIR__) . '/tmp'));
        $this->assertInstanceOf(Authentication::class, $injector->getInstance(Authentication::class));
    }
}
