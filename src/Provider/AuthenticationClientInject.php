<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Authentication;
use Ray\Di\Di\Inject;

/**
 * @codeCoverageIgnore
 */
trait AuthenticationClientInject
{
    /** @var Authentication */
    protected $authClient;

    /**
     * @Inject()
     */
    #[Inject]
    public function setAuthClient(Authentication $authClient): void
    {
        $this->authClient = $authClient;
    }
}
