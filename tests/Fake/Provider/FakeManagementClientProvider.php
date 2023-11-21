<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Management;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Di\ProviderInterface;

class FakeManagementClientProvider implements ProviderInterface
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
        return new Management($this->config);
    }
}
