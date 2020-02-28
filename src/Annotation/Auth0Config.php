<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Annotation;

use Ray\Di\Di\Qualifier;

/**
 * @Annotation
 * @Target("METHOD")
 * @Qualifier
 */
final class Auth0Config
{
    /** @var array */
    public $value;
}
