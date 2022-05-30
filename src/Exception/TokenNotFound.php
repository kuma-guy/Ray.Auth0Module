<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Exception;

use RuntimeException;

class TokenNotFound extends RuntimeException implements AuthenticationException
{
    /** @var string */
    protected $message = 'token not found';
}
