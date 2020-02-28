<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Management;

trait ManagementClientInject
{
    /**
     * @var Management
     */
    protected $managementClient;

    /**
     * @\Ray\Di\Di\Inject
     */
    public function setManagementClient(Management $managementClient) : void
    {
        $this->managementClient = $managementClient;
    }
}
