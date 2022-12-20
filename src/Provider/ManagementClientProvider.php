<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Management;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Di\ProviderInterface;

class ManagementClientProvider implements ProviderInterface
{
    use AuthenticationClientInject;

    /** @var array */
    private $config;

    /**
     * @Auth0Config("config")
     *
     * @param array $config
     */
    #[Auth0Config('config')]
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function get() : Management
    {
        $response = $this->authClient->client_credentials([
            'audience' => 'https://' . $this->config['domain'] . '/api/v2/',
        ]);

        return new Management($response['access_token'], $this->config['domain']);
    }
}
