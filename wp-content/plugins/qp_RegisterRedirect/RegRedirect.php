<?php 
    /*
    Plugin Name: RegisterRedirect
    Plugin URI: 
    Description:Redirection after the registration
    Author: IB
    Version: 1.0
    Author URI: ib
    */

add_shortcode('regRedirect','reg_redirect');

function reg_redirect(){

global $wpdb;

if(is_user_logged_in())
{wp_redirect( home_url() );
}

if(isset($_POST['home']))
{

global $current_user;
get_currentuserinfo();

//session_start();

//$user_id=$_SESSION['id'];

$user_id = $_REQUEST['id'];

//$user_info=get_userdata($user_id);
//$username=$user_info->user_login;
//$password=$user_info->user_pass;


$user = get_user_by( 'id', $user_id ); 
if( $user ) {
    wp_set_current_user( $user_id, $user->user_login );
    wp_set_auth_cookie( $user_id );
    do_action( 'wp_login', $user->user_login );
wp_redirect( home_url() );
}
}

if(isset($_POST['bouquet']))
{

global $current_user;
get_currentuserinfo();

//session_start();

//$user_id=$_SESSION['id'];

$user_id = $_REQUEST['id'];

//$user_info=get_userdata($user_id);
//$username=$user_info->user_login;
//$password=$user_info->user_pass;

$user = get_user_by( 'id', $user_id ); 
if( $user ) {
    wp_set_current_user( $user_id, $user->user_login );
    wp_set_auth_cookie( $user_id );
    do_action( 'wp_login', $user->user_login );
wp_redirect(  home_url().'/subscribe-bangla' );
}
}
?>
<div class="user_wel" style="float:left;padding-left: 13%; width:50%">
<h2>Thank You for your Registration.<br /> </h2><br />
<form method="post" >
<h4>Have a look over our Bouquet and plans</h4>
<input type="submit" name="bouquet" Value="Our Bouquet" />
<h4>You can skip this step and come back later.</h4>
<input type="submit" name="home" Value="Go HOME" /> 
</form>
</div>
<?php }
?>
<?php
