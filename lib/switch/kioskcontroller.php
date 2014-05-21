<?php
$__template = "bootstrap";
if(!checkUser($_COOKIE['username'])) {
	setcookie("username", 'delete', time()-1800);
	header("location: login");
}

if(isset($_GET['page'])){
	$page = $_GET['page'];	
}

switch($page) {
	case "kiosks":
		require 'kiosks/kiosks.php';
		break;
	case "applications":
		require 'kiosks/apps.php';
		break;
	case "users":
		require 'kiosks/users.php';
		break;
	case "kioskSettings":
		require 'kiosks/kioskSettings.php';
		break;
	case "schedules":
		require 'kiosks/schedules.php';
		break;
	case "logout":
		setcookie('username','',time()-1800);
		header("location: login");
		break;
	default:
		require 'kiosks/default.php';
}