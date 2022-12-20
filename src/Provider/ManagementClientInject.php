<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Management;
use Ray\Di\Di\Inject;

trait ManagementClientInject
{
    /**
     * @var Management
     */
    protected $managementClient;

    /**
     * @\Ray\Di\Di\Inject
     */
    #[Inject]
    public function setManagementClient(Management $managementClient) : void
    {
        $this->managementClient = $managementClient;
    }
}
