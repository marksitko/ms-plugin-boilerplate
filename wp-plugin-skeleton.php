<?php 
/*
Plugin Name: WP-Plugin-Skeleton
Version: 0.0.1
Plugin URI: 
Description: A easy OOP WP Plugin Skeleton
Author: Mark Sitko
Author URI: https://www.sitko-designing.de
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) exit;

require_once( plugin_dir_path( __FILE__ ) . 'inc/MyPlugin.php' );

function run_myPlugin() {
	$myPlugin = new MyPlugin();
	$myPlugin->run();
}

run_myPlugin();
?>
