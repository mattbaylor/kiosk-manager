<?php 

$routing_file = dirname(__FILE__) . '/switch/' . argvs(0) . '.php';
if ( file_exists( $routing_file ) ) {
	require $routing_file;
	return;
} else {
	require(dirname(__FILE__)	.'/switch/kioskcontroller.php');
	return;
}

switch ( argvs(0) ) {
default:
	break;
}