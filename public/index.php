<?php

$rootPath = __DIR__ . '/..';
$vendorPath = $rootPath . '/vendor';

header('Access-Control-Allow-Origin: *');

define('DONTHACKME', true);
define('ROOT_DIR', dirname(__FILE__));
define('CORE_DIR', ROOT_DIR . '/core');
define('LANG_DIR', ROOT_DIR . '/lang');

require_once ROOT_DIR . '/core/core.php';
