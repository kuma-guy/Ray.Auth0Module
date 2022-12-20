<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Di\ProviderInterface;

class ManagementClientProvider implements ProviderInterface
{
    /** @var array */
    private $config;

    /**
     * @Auth0Config("config")
     *
     * @param array $config
     */
    #[Auth0Config('config')]
    public function __construct($config, Authentication $authClient)
    {
        $this->config = $config;
        $this->authClient = $authClient;
    }

    public function get() : Management
    {
        $response = $this->authClient->client_credentials([
            'audience' => 'https://' . $this->config['domain'] . '/api/v2/',
        ]);

        return new Management($response['access_token'], $this->config['domain']);
    }
}
