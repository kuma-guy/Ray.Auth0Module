<?php

declare(strict_types=1);

use Koriym\Attributes\AttributeReader;
use Ray\ServiceLocator\ServiceLocator;

$loader = include dirname(__DIR__) . '/vendor/autoload.php';
$_ENV['TMP_DIR'] = __DIR__ . '/tmp';

// no annotation in PHP 8
if (PHP_MAJOR_VERSION >= 8) {
    ServiceLocator::setReader(new AttributeReader());
}
