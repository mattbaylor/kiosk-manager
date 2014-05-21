<?php
define( 'HOSTNAME',   php_uname('n')      );
$host_parts = array_reverse(explode('.', $_SERVER['HTTP_HOST']));
define( 'TLD',        $host_parts[0]      ); 
define( 'HOST',       $host_parts[1]      );
define( 'DATACENTER', $host_parts[2]      );
unset($host_parts);

date_default_timezone_set('America/Denver');

define( 'DB_CHARSET', 'utf8'              );
define( 'DB_COLLATE', 'utf8_general_ci' );

ini_set('display_errors', false);
ini_set('error_log', dirname( dirname( __FILE__ ) ) . '/logs/php-errors');


// Load up our core API
foreach ( glob( dirname(__FILE__) . '/functions/*.php' ) as $file ) {
	require $file;
}

// Load up our plugins
foreach ( glob( dirname(__FILE__) . '/plugins/*.php' ) as $file ) {
	require $file;
}

$db_tables = array();
$db_servers = array();


// // partitioned data example
// add_db_server('partitioned', 1, 'lt', 1, 1,'localhost:3306','localhost:3306', 'db', 'user', 'pass');
// add_db_server('partitioned', 2, 'lt', 1, 1,'localhost:3306','localhost:3306', 'db', 'user', 'pass');
// $wpdb->query("select * from partitioned_81_blah");
// 
// // dataset example	
// add_db_server('dataset', 0, 'lt', 1, 1, 'localhost:3306','localhost:3306', 'db', 'user', 'pass');
// add_db_table('dataset', 'tablename');
// $wpdb->query("select * from tablename");
//
// dataset, partition, datacenter, R, W, internet host:port, internal network host:port, database, user, password
switch ( $_SERVER['HTTP_HOST'] ) {
	case 'fqdn.of.your.server':
		add_db_server('global', 0, 'lt', 1, 1,'localhost:3306','localhost:3306', 'db', 'user', 'password');
		break;
}

if ( !isset($wpdb) ) {
	if ( class_exists('HyperDB') )
		$wpdb = new proc_fix;
	else
		$wpdb = new DB;
}

// We want all NOW()s in the db to be UTC -- is this correct?
//$wpdb->query("SET time_zone = UTC");

// Initialize memcached
/*$mc = new memcached(
	array( 
		'servers' => array(
			'127.0.0.1:11211', 
		), 
	)
);*/

// Output buffering lets us to neat stuff like circumventing output and redirecting in-process
ob_start();

// The breadcrumb provides us with the "go back to last page" functionality which will be necessary after some actions... like friend requests, forum posts, etc...
do_breadcrumb();

$__template = "default";	// Template File`
$__title = "";		// Template Title
$__headers = array(
		'Content-Type' => 'text/html', 
	);

require dirname( __FILE__ ) . '/routing.php';

// Template Stuff
$__payload = ob_get_clean();

if ( !isset($__template) || $__template == '' || !file_exists( dirname(__FILE__) .'/templates/'.$__template.'.php' ) )
	$__template = "default";

foreach ( $__headers as $h => $v ) {
	if ( !is_array($v) ) {
		header("$h: $v");
	} else {
		foreach ( $v as $sv ) {
			header("$h: $sv");
		}
	}
}

require_once dirname(__FILE__) . '/templates/' . $__template . '.php';