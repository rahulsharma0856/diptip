<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Convert the path to unix style
$path = str_replace( '\\', '/', BASEPATH );
$path = preg_replace( '|(?<=.)/+|', '/', $path );
if ( ':' === substr( $path, 1, 1 ) ) {
	$path = ucfirst( $path );
}

// Go up a few directories
$path = $path.'../../../';

// Redirect to Error Handle
require_once $path.'error/missing.php';

?>
