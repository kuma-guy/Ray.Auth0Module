<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Authentication;

trait AuthenticationClientInject
{
    /**
     * @var Authentication
     */
    protected $authClient;

    /**
     * @\Ray\Di\Di\Inject
     */
    public function setAuthClient(Authentication $authClient) : void
    {
        $this->authClient = $authClient;
    }
}
