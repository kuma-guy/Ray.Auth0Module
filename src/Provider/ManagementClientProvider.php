<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Ray\Di\Di\Named;
use Ray\Di\ProviderInterface;

use function assert;
use function is_string;

/**
 * @implements ProviderInterface<Management>
 */
class ManagementClientProvider implements ProviderInterface
{
    /** @var string */
    public $domain;

    /** @var Authentication */
    protected $authClient;

    /**
     * @Named("domain=Ray\Auth0Module\Annotation\Domain")
     */
    #[Named('domain=Ray\Auth0Module\Annotation\Domain')]
    public function __construct(string $domain, Authentication $authClient)
    {
        $this->domain = $domain;
        $this->authClient = $authClient;
    }

    public function get(): Management
    {
        $response = $this->authClient->client_credentials([
            'audience' => 'https://' . $this->domain . '/api/v2/',
        ]);

        $accessToken = $response['access_token'];
        assert(is_string($accessToken));

        return new Management($accessToken, $this->domain);
    }
}
