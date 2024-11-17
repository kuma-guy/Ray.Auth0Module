<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Di\ProviderInterface;

class ManagementClientProvider implements ProviderInterface
{
    use AuthenticationClientInject;

    /** @var SdkConfiguration */
    private $configuration;

    /**
     * @param array $config
     *
     * @Auth0Config("config")
     */
    #[Auth0Config('config')]
    public function __construct(private $config)
    {
        $this->configuration = new SdkConfiguration($config);
    }

    public function get() : Management
    {
        return new Management($this->configuration);
    }
}
