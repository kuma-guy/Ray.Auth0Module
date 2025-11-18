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

    /** @var array */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(
        #[Auth0Config('config')] array $config
    )
    {
        $this->config = $config;
        unset($this->config['customDomain']);
    }

    public function get() : Management
    {
        $configuration = new SdkConfiguration($this->config);

        return new Management($configuration);
    }
}
