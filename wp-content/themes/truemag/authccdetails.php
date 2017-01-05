<?php /* Template Name: MY DETAILS */ ?>
<?php
   global $wpdb;
get_header();

?>
<?php global $current_user;
      get_currentuserinfo();
$name = $current_user->user_firstname;
$username = $current_user->user_login;
$course = $current_user->courses;
$idu = $current_user->ID;
$ccnumber = $current_user->ccnumber;
//echo $username;
?>
<?php 

// where `user_login`='$username' AND `courses`='$course'
//$list_q = "select * from wp_users WHERE user_login = '$username'";
//$list_q = $wpdb->get_results($list_q);



//foreach($list_q as $list_q){


//}





<?php 

get_footer(); ?>