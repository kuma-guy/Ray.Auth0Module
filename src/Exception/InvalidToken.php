<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Exception;

class InvalidToken extends \RuntimeException implements AuthenticationException
{
}
