<?php

declare(strict_types=1);

namespace Ray\Auth0Module;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
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
use Ray\Di\Scope;

class Auth0Module extends AbstractModule
{
    /** @var array */
    private $config;

    public function __construct(array $config, ?AbstractModule $module = null)
    {
        $this->config = $config;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure() : void
    {
        $this->install(new AuraWebModule);

        $this->bind()->annotatedWith(Auth0Config::class)->toInstance($this->config);
        $this->bind(AuthInterface::class)->to(Auth::class)->in(Scope::SINGLETON);
        $this->bind()->annotatedWith(Extractors::class)->toInstance([
            new AuthorizationHeaderTokenExtractor
        ]);
        $this->bind(TokenExtractorResolver::class)->in(Scope::SINGLETON);
        $this->bind(Management::class)->toProvider(ManagementClientProvider::class);
        $this->bind(Authentication::class)->toProvider(AuthenticationClientProvider::class);
    }
}
