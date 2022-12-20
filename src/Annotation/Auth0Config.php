<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Annotation;

use Attribute;
use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;
use Ray\Di\Di\Qualifier;

/**
 * @Annotation
 * @Target("METHOD")
 * @Qualifier
 * @NamedArgumentConstructor
 */
#[Attribute(Attribute::TARGET_METHOD), Qualifier]
final class Auth0Config
{
    /** @var array */
    public $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }
}
