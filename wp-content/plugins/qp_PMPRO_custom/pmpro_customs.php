<?php 
    /*
    Plugin Name: pmpro customs
    Plugin URI: 
    Description: This is to help customizations for pmpro
    Author: IB
    Version: 1.0
    Author URI: ib
    */

function my_pmpro_profile_start_date($startdate, $order) { 

  $next_year = strtotime(" + 1 Year"); 
  $startdate = date("Y", $next_year) . "-01-01T0:0:0"; 
	$startdate=strtotime("16-12-2016");
  return $startdate; 
} 
add_filter("pmpro_profile_start_date", "my_pmpro_profile_start_date", 10, 2);

function my_pmpro_profile_end_date($enddate, $order) { 

  $next_year = strtotime(" + 1 Year"); 
  $enddate = date("Y", $next_year) . "-01-01T0:0:0"; 
	$enddate=strtotime("14-11-2017");
  return $enddate; 
} 
add_filter("pmpro_profile_end_date", "my_pmpro_profile_end_date", 10, 2);



function my_pmpro_member_startdate($start_date, $user_id, $level_id)
{
	$date = strtotime("10 December 2015");
	return $date;
}

add_filter('pmpro_member_startdate', 'my_pmpro_member_startdate', 10, 3);

function my_profile_start_date($startdate, $user_id, $level) { 

$startdate=new DateTime("now");
$startdate->addInterval("P30D");
$startdate->format("");
//$date = strtotime("16 December 2015");
	return $date;
} 
add_filter("pmpro_checkout_start_date", "my_profile_start_date", 10, 3);

add_action('init', 'post_open'); 
function post_open()
{
if(is_single()){
if(!is_user_logged_in()){

echo "<script>window.alert('No.....');</script>";
}
}
}

add_shortcode('postalert','alert_post');
function alert_post()
{

}


?>
<?php
