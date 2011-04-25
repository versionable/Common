<?php

require_once(__DIR__.'/../vendor/autoload/src/Versionable/Autoload/Autoload.php');

use Versionable\Autoload\Autoload;

$al = new Autoload();
$al->registerNamespace('Versionable\Tests\Common', __DIR__.'/../tests');
$al->registerNamespace('Versionable\Common', __DIR__.'/../src');
$al->register();
