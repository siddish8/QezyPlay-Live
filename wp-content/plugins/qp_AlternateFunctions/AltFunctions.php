<?php 
    /*
    Plugin Name: My(Alt_not needed) Functions.php
    Plugin URI: 
    Description: This is helps to add filters, hooks without going into theme's functions.php file
    Author: IB
    Version: 1.0
    Author URI: ib
    */

add_action( 'wpmem_register_redirect', 'my_redirect' );

	function my_redirect() {
    // NOTE: this is an action hook that uses wp_redirect.
get_header();
echo "<style>body{background: rgba(0, 0, 0, 0.54) !important;}</style>";
//echo "<script>swal('Registration Success.. Please check your mail for password');</script>";
echo "<script>swal({   title: 'Registration Success',   text: 'Please check your mail for password',   type: 'warning',   showCancelButton: false,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Ok',   cancelButtonText: 'Go HOME',   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {window.location='".home_url()."/';   } else {   window.location='".home_url()."';     } });
</script>";

get_footer();
//echo "<script>window.location='".home_url()."';</script>";
//echo "<script>window.alert('Registration Success.. Please check your mail for password');</script>";
 
    	//wp_redirect(home_url());
    exit();
	}


add_action('sub_sup','sub_sup_fn');

function sub_sup_fn()
{
ob_start();
//echo "<script>alert('begin')</script>";

global $current_user;
global $wpdb;

get_currentuserinfo();
$user_id = get_current_user_id();

$last_updatedate=$wpdb->get_var("select last_update_date from sub_support where user_id=".$user_id." order by id desc");
$last_updatedate1=new DateTime($last_updatedate);
$today=new DateTime("now");
$today=$today->format("Y-m-d");
$today=new DateTime($today);

$update=$today>$last_updatedate1;

if(!$last_updatedate)
{
$update=true;
}
echo "<script>console.log('last_upd:'+'".$last_updatedate."')</script>";
echo "<script>console.log('upd:'+'".$update."')</script>";
if($update)
{


$startdate=$wpdb->get_var("select startdate from wp_pmpro_memberships_users where user_id=".$user_id." and status='active'");
$plan=$wpdb->get_var("select membership_id from wp_pmpro_memberships_users where user_id=".$user_id." and status='active'");

if($startdate!="")
{


$trail=$wpdb->get_var("select count(user_id) from wp_pmpro_memberships_users where user_id=".$user_id." ");

	if($trail>1) //no-trial
		{
			$plan_startdate=$startdate;
		}
	else
		{		
		
		$date=new DateTime($startdate); 
			$delay=get_option("pmpro_sub_support_delay_".$user_id);
			$traildays=get_option("pmpro_subscription_delay_" . $plan);
			if($delay!=0)
			{
			$plan_startdate=$date->add(new DateInterval('P'.$delay.'D'));
			}
			else
			$plan_startdate=$date->add(new DateInterval('P'.$traildays.'D'));
			/* if($plan==4)
				$plan_startdate=$date->add(new DateInterval('P1D')); //test
			else
				$plan_startdate=$date->add(new DateInterval('P30D')); */

			$plan_startdate=$plan_startdate->format('Y-m-d');

		}
	if($trail>1) //no-trail
		{

			$date=new DateTime($startdate); 
			$now=new DateTime("now");

			if($plan==1)
				{
				$next_paydate=$date->add(new DateInterval('P1Y'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
				}
			else if($plan==2)
				{
				$next_paydate=$date->add(new DateInterval('P6M'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
			}else if($plan==3)
				{
				$next_paydate=$date->add(new DateInterval('P3M'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
				}
			else if($plan==4)
				{
				$next_paydate=$date->add(new DateInterval('P1D'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
			}
			else
				{
				}
		$next_paydate=$next_paydate->format('Y-m-d');
		}
	else
		{
			$next_paydate=new DateTime($plan_startdate);
			$now=new DateTime("now");
			if($now>$next_paydate)
			{
				if($plan==1)
				{
				$next_paydate=$date->add(new DateInterval('P1Y'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
				}
				else if($plan==2)
				{
				$next_paydate=$date->add(new DateInterval('P6M'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
				}else if($plan==3)
				{
				$next_paydate=$date->add(new DateInterval('P3M'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
				}
				else if($plan==4)
				{
				$next_paydate=$date->add(new DateInterval('P1D'));
					if($now>$next_paydate)
					{
					$next_paydate=$next_paydate->add(new DateInterval('P1Y'));
					}
				}
				else
				{
				}
			}
		$next_paydate=$next_paydate->format('Y-m-d');
		}




	$last_updatedate=new DateTime("now");
	$last_updatedate=$last_updatedate->format("Y-m-d");
	



//echo "<script>alert('start')</script>";
echo "<script>console.log('user:'+".$user_id.")</script>";
echo "<script>console.log('plan:'+".$plan.")</script>";
echo "<script>console.log('trail:'+".$trail.")</script>";
echo "<script>console.log('traildays:'+".$traildays.")</script>";
echo "<script>console.log('delay:'+".$delay.")</script>";
echo "<script>console.log('startdate:'+'".$startdate."');</script>";
echo "<script>console.log('plan_startdate:'+'".$plan_startdate."');</script>";
echo "<script>console.log('next_paydate:'+'".$next_paydate."');</script>";
echo "<script>console.log('last_updatedate:'+'".$last_updatedate."');</script>";
//echo "<script>alert('end')</script>";


 $wpdb->replace("sub_support", array(
   
   "user_id" => $user_id,
   "start_date" => $startdate, 
   "plan_start_date" => $plan_startdate,
   "next_pay_date" => $next_paydate,
   "last_update_date"=>$last_updatedate)); 

$wpdb->update("sub_support", array(
   "next_pay_date" => $next_paydate,
   "last_update_date"=>$last_updatedate)); 

}//insertion depends on active plan

}//update time

}



/* add_filter("pmpro_checkout_start_date",change_startdate);

function change_startdate()
{
					global $current_user;
					global $wpdb;
					get_currentuserinfo();
					$this_user = get_current_user_id();

					$res=$wpdb->get_results("SELECT user_id FROM wp_pmpro_memberships_users"); 
					foreach($res as $user)
					{
						if($user->user_id== $this_user)
								$count=1;
					}
					if($count>=1)
						{
						$startdate=new DateTime("now");
						$startdate=$startdate->format("Y-m-d");
						}
					else
						{
						$date=new DateTime("now");
						$date=$date->addInterval('P30D');
						$startdate=$date->format("Y-m-d");
						}

return $startdate;

} */

add_shortcode('sub-page-btn1','sub_page_btn1');
function sub_page_btn1()
{
?><script>var str = "Need tips? Visit W3Schools!";
var str_esc = escape(str);
document.write(str_esc + "<br>")
document.write(unescape(str_esc))</script>

<?php
return "<input onclick=\"location.href='<?php echo home_url() ?>/login/'\" style=\"cursor: pointer;\" type=\"submit\" value=\"Login\" />";



}
add_shortcode('sub-page-btn2','sub_page_btn2');
function sub_page_btn2()
{

return "<button onclick=\"location.href='<?php echo home_url() ?>/regsitration/'\" id=\"reg_bt\" type=\"submit\" value=\"Sign-up\">Sign-up</button>";

}
add_shortcode('sub-page-btn3','sub_page_btn3');
function sub_page_btn3()
{

return "<button onclick=\"location.href='<?php echo home_url() ?>/get-qezycredit/'\" id=\"getCredit\" style=\"border-radius: 8px; color: white; background-color: black !important; font-size: 15px; text-transform: uppercase; font-weight: bold; text-align: center; height: 35px; border: none; margin-left: 40px;\">Get Qezy Credit</button>";


}
add_shortcode('home_link','sub_page_log_link');
function sub_page_log_link()
{

return "<a href=\"<?php echo home_url() ?>\">QezyPlay? </a>";

}


add_shortcode('rel_chan','rel_channels');
function rel_channels()
{
$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=> 12, // Number of related posts that will be displayed.
'caller_get_posts'=>1,
'orderby'=>'rand' // Randomize the posts
);
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
echo '<div id="related_main" class="clear"><h3>Related Channels</h3><div class="regular slider">';
while( $my_query->have_posts() ) {
$my_query->the_post(); ?>
<div>
<?php 
$width="300px";
$height="169px";
$crop="true";
set_post_thumbnail_size( $width, $height, $crop ); ?> 
<a class="rel-chan" href="<?php the_permalink(); ?>"> <?php echo the_post_thumbnail(); ?></a>
 </a>
</div>
<? }
echo '</div></div>

<!-- <script type="text/javascript">
jQuery(document).ready(function() {
         jQuery(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      }); });
  </script>--> ';
} }
$post = $orig_post;
wp_reset_query(); 
}

add_filter('validate_pass', 'check_user_pass', 10, 3);
function check_user_pass($pass){

if(preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()?])[0-9A-Za-z!@#$%^&*()?]{8,50}$/', $pass)) {
$valid=1; //matched
   }
else {$valid=0; //the password does not meet the requirements
}


return $valid;
}
?>
<?php
