<?php

declare(strict_types=1);

namespace Ray\Auth0Module;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Ray\AuraWebModule\AuraWebModule;
use Ray\Auth0Module\Annotation\ClientId;
use Ray\Auth0Module\Annotation\ClientSecret;
use Ray\Auth0Module\Annotation\Domain;
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
    /** @var string */
    public $domain;

    /** @var string */
    public $clientId;

    /** @var string */
    public $clientSecret;

    public function __construct(string $domain, string $clientId, string $clientSecret, ?AbstractModule $module = null)
    {
        $this->domain = $domain;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->install(new AuraWebModule());

        $this->bind()->annotatedWith(Domain::class)->toInstance($this->domain);
        $this->bind()->annotatedWith(ClientId::class)->toInstance($this->clientId);
        $this->bind()->annotatedWith(ClientSecret::class)->toInstance($this->clientSecret);
        $this->bind(AuthInterface::class)->to(Auth::class)->in(Scope::SINGLETON);
        $this->bind()->annotatedWith(Extractors::class)->toInstance([
            new AuthorizationHeaderTokenExtractor(),
        ]);
        $this->bind(TokenExtractorResolver::class)->in(Scope::SINGLETON);
        $this->bind(Management::class)->toProvider(ManagementClientProvider::class);
        $this->bind(Authentication::class)->toProvider(AuthenticationClientProvider::class);
    }
}
