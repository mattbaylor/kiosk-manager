<?php
function post_catchall() {
	global $wpdb;
	$table = $wpdb->get_row( "EXPLAIN `post_catchall`" );
	if(!$table) {
		createPost_catchallTable();	
	}
	if( ! empty($_SERVER['REQUEST_URI'])) {
		$uri = $wpdb->escape( $_SERVER['REQUEST_URI'] );
	} else {
		$uri = '';
	}
	if( ! empty($_SERVER['HTTP_REFERER'])){
		$caller = $wpdb->escape( $_SERVER['HTTP_REFERER'] );
	} else {
		$caller = '';	
	}
	$post = $wpdb->escape(serialize($_POST));
	$get = $wpdb->escape(serialize($_GET));
	$server = $wpdb->escape(serialize($_SERVER));
	$cookie = $wpdb->escape(serialize($_COOKIE));
	$files = $wpdb->escape(serialize($_FILES));
	
	$query = $wpdb->query("INSERT INTO `post_catchall` (`when`,`uri`,`post`,`get`,`server`,`cookies`,`files`,`caller`)
	VALUES(NOW(),'$uri', '$post', '$get', '$server', '$cookie', '$files', '$caller' );");

	$wpdb->flush();
	return;
	
}

function createPost_catchallTable() {
	global $wpdb;
	$sql = 'CREATE TABLE IF NOT EXISTS `post_catchall` (
  `id` bigint(20) NOT NULL auto_increment,
  `when` datetime NOT NULL default \'0000-00-00 00:00:00\',
  `uri` varchar(254) NOT NULL,
  `caller` varchar(254) NOT NULL,
  `post` text NOT NULL,
  `get` text NOT NULL,
  `server` text NOT NULL,
  `cookies` text NOT NULL,
  `files` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uri` (`uri`,`when`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;';
	
	$wpdb->query($sql);
	
	return;
}