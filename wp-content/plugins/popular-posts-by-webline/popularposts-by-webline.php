<?php
/**
 Plugin Name: Popular Posts by Webline
 Plugin URI: http://www.weblineindia.com
 Description: This plugin is used to show the Popular Posts as per the different filters applied on it. This is very simple and light plugin and easy to use.
 Author: Weblineindia
 Version: 1.0.2
 Author URI: http://www.weblineindia.com
 License: GPL
*/

// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

require_once ( ABSPATH . 'wp-admin/includes/plugin.php' );

$plugin_data = get_plugin_data( __FILE__ );

define( 'WLIPOPULARPOSTS_VERSION', $plugin_data['Version'] );
define( 'PP_DEBUG', FALSE );
define( 'PP_PATH', plugin_dir_path( __FILE__ ) );
define( 'PP_URL', plugins_url( '', __FILE__ ) );
define( 'PP_PLUGIN_FILE', basename( __FILE__ ) );
define( 'PP_PLUGIN_DIR', plugin_basename( dirname( __FILE__ ) ) );
define( 'PP_ADMIN_DIR', PP_PATH . 'admin' );

require_once ( PP_ADMIN_DIR . '/class/hook.php' );

require_once ( PP_ADMIN_DIR . '/class/popular-posts.php' );
?>
