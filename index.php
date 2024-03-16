<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require './shorty.php';
require './config.php';

$shorty = new Shorty($hostname, $connection);

$shorty->set_chars($chars);
$shorty->set_salt($salt);
$shorty->set_padding($padding);

$shorty->set_site_specific($site_specific);

/**
 * Ensure $target does not have protocol or trailing slash
 */
if (preg_match('/^https?:\/\//', $target)) {
	$target = str_replace('https://', '', $target);
	$target = str_replace('http://', '', $target);
}
if (preg_match('/\/$/', $target)) {
	$target = str_replace('/', '', $target);
}
$shorty->set_target($target);

/**
 * Ensure $long_redirect has protocol and trailing slash
 */
if (!preg_match('/^https?:\/\//', $long_redirect)) {
	$long_redirect = 'https://' . $long_redirect;
}
if (!preg_match('/\/$/', $long_redirect)) {
	$long_redirect = $long_redirect . '/';
}
$shorty->set_long_redirect($long_redirect);

/**
 * Ensure $query_string starts with question mark
 */
if (isset($query_string) && !preg_match('/^$/', $query_string)) {
	if (!preg_match('/^\?/', $query_string)) {
		$query_string = '?' . $query_string;
	}
	$shorty->set_query_string($query_string);
}

$shorty->run();
?>
