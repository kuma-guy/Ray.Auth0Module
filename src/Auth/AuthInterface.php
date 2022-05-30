<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Auth;

use Lcobucci\JWT\Token;

interface AuthInterface
{
    public function verifyToken(string $token): Token;
}
