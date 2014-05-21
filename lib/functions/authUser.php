<?php
function authUser($username,$password) {
	global $wpdb;
	$adldap = new adLDAP(array('domain_controllers'=>array('pdc01rr,pdc02rr')));
	$authUser = $adldap->user()->authenticate($username, $password);
	if ($authUser == true) {
		$isUser = $wpdb->get_var("CALL checkUser('$username')",0,0);
		error_log(print_r($wpdb->query('SELECT 1'),true));
		if(isset($isUser)) {
			setcookie("username", $username, time()+1800);
			setcookie("role", $isUser, time()+1800);
			return("authorized");
		} else {
			return("User not authorized for this application. Please contact your admin");
		}
	}
	else {
		return("Username or Password is incorrect");
	}	
}

function checkUser($username) {
	global $wpdb;
	$isUser = $wpdb->get_var("CALL checkUser('$username')",0,0);
	error_log(print_r($wpdb->query('SELECT 1'),true));
	if(isset($isUser)) {
		return($isUser);
	} else {
		return(false);
	}	
}