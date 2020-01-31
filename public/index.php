<?php
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );

//@error_reporting (-1);

$rootPath = __DIR__ . '/..';
$vendorPath = $rootPath . '/vendor';

header('Access-Control-Allow-Origin: *');

define ( 'DONTHACKME', true );
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'CORE_DIR', ROOT_DIR . '/core' );
define ( 'DESIGN_DIR', ROOT_DIR . '/design' );

require_once ROOT_DIR . '/core/core.php';

?>