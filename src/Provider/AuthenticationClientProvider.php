<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Authentication;
use Ray\Auth0Module\Annotation\ClientId;
use Ray\Auth0Module\Annotation\ClientSecret;
use Ray\Auth0Module\Annotation\Domain;
use Ray\Di\ProviderInterface;

/**
 * @implements ProviderInterface<Authentication>
 */
class AuthenticationClientProvider implements ProviderInterface
{
    /** @var string */
    public $domain;

    /** @var string */
    public $clientId;

    /** @var string */
    public $clientSecret;

    /**
     * @Domain
     * @ClientId
     * @ClientSecret
     */
    #[Domain]
    #[ClientId]
    #[ClientSecret]
    public function __construct(string $domain, string $clientId, string $clientSecret)
    {
        $this->domain = $domain;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function get(): Authentication
    {
        return new Authentication($this->domain, $this->clientId, $this->clientSecret);
    }
}
