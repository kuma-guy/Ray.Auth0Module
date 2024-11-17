<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Auth;

use Auth0\SDK\Contract\TokenInterface;

interface AuthInterface
{
    public function verifyToken(string $token) : TokenInterface;
}
