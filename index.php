<?php
/**
 * Detect country
 */
include_once 'geoip/geoip.inc';
$ip = $_SERVER['REMOTE_ADDR'];
$gi = geoip_open("geoip/GeoIP.dat", GEOIP_STANDARD);
$country = geoip_country_code_by_addr($gi, $ip);
geoip_close($gi);
if(strtoupper($country) !== "VN"){
    ob_start();
    header("location: http://" . $_SERVER['HTTP_HOST'] . "/en/");
    exit;
}

/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
