<?php
/*
Plugin Name: User Access
Plugin URI: https://ideabytes.com-Get-started-with-the-User-Access-Shortcodes-plugin
Description: "The most simple way of controlling who sees what in your posts/pages". This plugin adds a button to your post editor, allowing you to restrict content to logged in users only (or guests) with a simple shortcode. Find help and information on our <a href="http://ideabytes.com/support/">support site</a>. Use this restriction shortcode[my_ccard_shortcode] Hey, this is the content within the awesome shortcode. [/my_ccard_shortcode]
Version: 2.1
Author: ideabytes
Author URI: http://ideabytes.com
License: GPL2
 */



function my_ccard_shortcode_func( $atts, $content = null ) {

global $wpdb;
global $current_user;
      get_currentuserinfo();
$name = $current_user->user_firstname;
$username = $current_user->user_login;
$course = $current_user->courses;
$idu = $current_user->id;
$ccard = $current_user->ccnumber;

if(($ccard) != '0'){
   return '<ccardness>' . $content . '</ccardness>';

} else {
echo '<div class="xoouserultra-wrap xoouserultra-login"><div class="xoouserultra-inner xoouserultra-login-wrapper"><div class="xoouserultra-head" style="font-size:14px"><br /><strong><a href="http://qezyplay.com/ccard-edit/">Finish the Signup and enjoy viewing Free Trial.</a></strong></div></div></div>';
}
}

add_shortcode( 'my_ccard_shortcode', 'my_ccard_shortcode_func' );