<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Di\ProviderInterface;

/**
 * @implements ProviderInterface<Management>
 */
class FakeManagementClientProvider implements ProviderInterface
{
    /** @var array<string, mixed> */
    private array $config;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(
        #[Auth0Config('config')] array $config
    ) {
        $this->config = $config;
        unset($this->config['customDomain']);
    }

    public function get() : Management
    {
        $this->config['strategy'] = SdkConfiguration::STRATEGY_MANAGEMENT_API;
        $configuration = new SdkConfiguration($this->config);

        return new Management($configuration);
    }
}
