<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Authentication;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Di\ProviderInterface;

class AuthenticationClientProvider implements ProviderInterface
{
    /** @var array */
    private $config;

    /**
     * @Auth0Config
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function get() : Authentication
    {
        return new Authentication($this->config['domain'], $this->config['client_id'], $this->config['client_secret']);
    }
}
