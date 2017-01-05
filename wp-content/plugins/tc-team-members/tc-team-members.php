<?php
/**
 * Plugin Name:		   TC Team Members
 * Plugin URI:		  https://www.themescode.com/items/tc-team-members/
 * Description:		   TC Team Members plugin is fully responsive and perfectly present  team members  profiles information with social media links using our shortcode on your website.
 * Version: 		     1.3
 * Author: 			     themesCode < imran@themescode.com >
 * Author URI: 		   https://www.themescode.com/items/tc-team-members/
 * Text Domain:      team-members
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * License: GPL2
 */


 require_once('loader.php');

 // After Plugin Activation redirect
if( !function_exists( 'tc_team_after_activation_redirect' ) ){
  function tc_team_after_activation_redirect( $plugin ) {
      if( $plugin == plugin_basename( __FILE__ ) ) {
          exit( wp_redirect( admin_url( 'edit.php?post_type=tcmembers&page=tc_teammember_menu_help' ) ) );
      }
  }
}
add_action( 'activated_plugin', 'tc_team_after_activation_redirect' );

 // adding link
 add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'tc_teammember_plugin_action_links' );

 function tc_teammember_plugin_action_links( $links ) {
    $links[] = '<a class="tc-pro-link" href="https://www.themescode.com/items/tc-team-members" target="_blank">Go Pro !</a>';
    $links[] = '<a href="https://www.themescode.com/items/category/wordpress-plugins" target="_blank">TC Plugins</a>';
    return $links;
 }
