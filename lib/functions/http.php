<?php

// Automagic routing and location information
list($server_tld, $server_domain, $server_dc, $server_host) = array_reverse(explode('.', php_uname('n')));
list($site_tld, $site_domain, $site_host) = array_reverse(explode('.', strtolower($_SERVER['HTTP_HOST'])));
$parsed_url = parse_url("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
$parsed_url['path'] = explode('/', substr($parsed_url['path'], 1));

// shortcut for code cluttering logic
function argv($part, $default=false) {
        global $parsed_url;
        return empty($parsed_url['path'][$part]) ? $default : $parsed_url['path'][$part];
}

function argvf($part, $default=false, $filter="rawurldecode") {
        $val = argv($part, $default);
        if ( !is_array($filter) ) {
                if ( function_exists($filter) )
                        $val = $filter($val);
        } else {
                foreach ( $filter as $function ) {
                        if ( function_exists($function) )
                                $val = $function($val);
                }
        }
        return $val;
}

function argvs($part, $default=false) {
        return argvf($part, $default, array('rawurldecode', 'strtolower'));
}

function getargv($part, $getarg, $default=false) {
        $clean = argv($part);
        if ( !empty($clean) )
                return $clean;
        if ( isset($_GET[$getarg]) ) {
                $arg = $_GET[$getarg];
                if ( !empty($arg) )
                        return $arg;
        }
        return $default;
}

function redirect($location, $status=302) {
        global $disable_redirect;
        if ( $disable_redirect )
                return false;
        ob_clean();
        header("Location: $location", true, $status);
        die();
}

function nocache() {
	@ header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');
	@ header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	@ header('Cache-Control: no-cache, must-revalidate, max-age=0');
	@ header('Pragma: no-cache');
}

function do_breadcrumb() {
	if ( count($_POST) )
		return false;
	if ( isset($_COOKIE['breadcrumb']) && $_COOKIE['breadcrumb'] == $_SERVER['REQUEST_URI'] )
		return true;
	$leave_breadcrumb = apply_filters("leave_breadcrumb", true);
	if ( $leave_breadcrumb )
		setcookie('breadcrumb', $_SERVER['REQUEST_URI'], 0, '/', $_SERVER['HTTP_HOST']);
	return $leave_breadcrumb;
}

function get_breadcrumb() { 
	if ( !isset($_COOKIE['breadcrumb']) || !$_COOKIE['breadcrumb'] )
		return '/dashboard';
	return $_COOKIE['breadcrumb'];
}