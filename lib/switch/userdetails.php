<?php
$__template = "none";
if(isset($_GET['ID'])) {
	$ID = $_GET['ID'];
	$where = "WHERE authorized_user_id = $ID";
} else {
	die('missing ID');
}

if(isset($_GET['callback'])) {
	$callback = $_GET['callback'];	
}

$sql = '
	SELECT *
	FROM authorized_users ' .
$where .';
';

$ret = '';

if(isset($callback)){
	$ret = $_GET['callback'] . "(";
}

$ret .= json_encode($wpdb->get_results($sql,ARRAY_A));

if(isset($callback)){
	$ret .= ")";
}


echo($ret);
?>