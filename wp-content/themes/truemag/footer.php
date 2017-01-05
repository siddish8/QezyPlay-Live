<?php

/**

 * The template for displaying the footer.

 *

 * Contains footer content and the closing of the

 * #main and #page div elements.

 *

 */

?>

<div id="bottom-nav_1">

<div class="ts-section-top-footer">

<div class="ts-top-footer">

<div class="container">

<div class="row">

<div style="font-size:18px" class="col-lg-6 col-md-6 col-sm-6 ts-contact-email-info contact-info">

<div class="pull-left">

<span><i class="fa fa-envelope-o"></i></span>

<!-- <a target="_blank" href="mailto:contact@qezymedia.com">Email us</a>-->
<a href="mailto:admin@qezyplay.com?cc=siddish.gollapelli@ideabytes.com&amp;subject=QezyPlay%20Email%20Us&amp;">
Email us</a>

</div>

</div>

<div style="font-size:18px" class="col-lg-6 col-md-6 col-sm-6 ts-contact-phone-info contact-info">

<div class="pull-right">

<span><i class="fa fa-phone"></i></span>

<p>+91-910 002 9202</p>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

    <footer class="dark-div">

		<?php if ( is_404() && is_active_sidebar( 'footer_404_sidebar' ) ) { ?>

    	<div id="bottom">

            <div class="container">

                <div class="row">

					<?php dynamic_sidebar( 'footer_404_sidebar' ); ?>                    

                </div><!--/row-->

            </div><!--/container-->

        </div><!--/bottom-->

		<?php } elseif ( is_active_sidebar( 'footer_sidebar' ) ) { ?>

    	<div id="bottom">

            <div class="container">

                <div class="row">

					<?php dynamic_sidebar( 'footer_sidebar' ); ?>                    

                </div><!--/row-->

            </div><!--/container-->

        </div><!--/bottom-->

		<?php } ?>

		<?php tm_display_ads('ad_foot');?>

					

       

 <div id="bottom-nav">

        	<div class="container">

                <div class="row">

					<div class="copyright col-md-6"><?php echo ot_get_option('copyright',get_bloginfo('name').' - '.get_bloginfo('description')); ?></div>

					<nav class="col-md-6">

                    	<ul class="bottom-menu list-inline pull-right">

                        	<?php

								if(has_nav_menu( 'footer-navigation' )){

									wp_nav_menu(array(

										'theme_location'  => 'footer-navigation',

										'container' => false,

										'items_wrap' => '%3$s'

									));	

								}?>

                        </ul>

                    </nav>

				</div><!--/row-->

            </div><!--/container-->

        </div>

    </footer>

    <div class="wrap-overlay"></div>

</div><!--wrap-->

<?php if(ot_get_option('mobile_nav',1)){ ?>

<div id="off-canvas">

    <div class="off-canvas-inner">

        <nav class="off-menu">

            <ul>

            <li class="canvas-close"><a href="#"><i class="fa fa-times"></i> <?php _e('Close','cactusthemes'); ?></a></li>

			<?php

				$megamenu = ot_get_option('megamenu', 'off');

				if($megamenu == 'on' && function_exists('mashmenu_load')){

					global $in_mobile_menu;

					$in_mobile_menu = true;

					mashmenu_load();

					$in_mobile_menu = false;

				}elseif(has_nav_menu( 'main-navigation' )){

                    wp_nav_menu(array(

                        'theme_location'  => 'main-navigation',

                        'container' => false,

                        'items_wrap' => '%3$s'

                    ));	

                }else{?>

                    <li><a href="<?php echo home_url(); ?>/"><?php _e('Home','cactusthemes'); ?></a></li>

                    <?php wp_list_pages('title_li=' ); ?>

            <?php } ?>

            <?php

			 	$user_show_info = ot_get_option('user_show_info');

				if ( is_user_logged_in() && $user_show_info =='1') {

				$current_user = wp_get_current_user();

				$link = get_edit_user_link( $current_user->ID );

				?>

                    <li class="menu-item current_us">

                    <?php  

                    echo '<a class="account_cr" href="#">'.$current_user->user_login; 

                    echo get_avatar( $current_user->ID, '25' ).'</a>';

                    ?>

                    <ul class="sub-menu">

                        <li class="menu-item"><a href="<?php echo $link; ?>"><?php _e('Edit Profile','cactusthemes') ?></a></li>

                        <li class="menu-item"><a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e('Logout','cactusthemes') ?></a></li>

                    </ul>

                    </li>

				<?php }?>

                <?php //submit menu

				if(ot_get_option('user_submit',1)) {

					$text_bt_submit = ot_get_option('text_bt_submit');

					if($text_bt_submit==''){ $text_bt_submit = 'Submit Video';}

					if(ot_get_option('only_user_submit',1)){

						if(is_user_logged_in()){?>

						<li class="menu-item"><a class="submit-video" href="#" data-toggle="modal" data-target="#submitModal"><?php _e($text_bt_submit,'cactusthemes'); ?></a></li>

					<?php }

					} else{

					?>

						<li class="menu-item"><a class="submit-video" href="#" data-toggle="modal" data-target="#submitModal"><?php _e($text_bt_submit,'cactusthemes'); ?></a></li>

					<?php 

						

					}

				} ?>

            </ul>

        </nav>

    </div>

</div><!--/off-canvas-->

<script>off_canvas_enable=1;</script>

<?php }?>

<?php if(ot_get_option('theme_layout',false)){ ?>

</div><!--/boxed-container-->

<?php }?>

<div class="bg-ad">

	<div class="container">

    	<div class="bg-ad-left">

			<?php tm_display_ads('ad_bg_left');?>

        </div>

        <div class="bg-ad-right">

			<?php tm_display_ads('ad_bg_right');?>

        </div>

    </div>

</div>

</div><!--/body-wrap-->

<?php

	if(ot_get_option('user_submit',1)) {?>

	<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	  <div class="modal-dialog">

		<div class="modal-content">

		  <div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

			<h4 class="modal-title" id="myModalLabel"><?php _e('Submit Video','cactusthemes'); ?></h4>

		  </div>

		  <div class="modal-body">

			<?php dynamic_sidebar( 'user_submit_sidebar' ); ?>

		  </div>

		</div>

	  </div>

	</div>

<?php } ?>

<?php

	if( is_single() && ot_get_option('video_report','on')!='off' ) {?>

	<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	  <div class="modal-dialog">

		<div class="modal-content">

		  <div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

			<h4 class="modal-title" id="myModalLabel"><?php _e('Report Video','cactusthemes'); ?></h4>

		  </div>

		  <div class="modal-body">

			<?php echo do_shortcode('[contact-form-7 id="'.ot_get_option('video_report_form','').'"]'); ?>

		  </div>

		</div>

	  </div>

	</div>

<?php } ?>

<?php if(!ot_get_option('theme_layout') && (ot_get_option('adsense_slot_ad_bg_left')||ot_get_option('ad_bg_left')||ot_get_option('adsense_slot_ad_bg_right')||ot_get_option('ad_bg_right')) ){ //fullwidth layout ?>

<script>

	enable_side_ads = true;

</script>

<?php } ?>

<a href="#top" id="gototop" class="notshow" title="Go to top"><i class="fa fa-angle-up"></i></a>

<?php echo ot_get_option('google_analytics_code', ''); ?>

<?php wp_footer(); ?>



<?php



require_once ABSPATH.'/mobile_detect/Mobile_Detect.php';  //LIVE
require_once ABSPATH.'/mobile_detect/more_detection.php';  //LIVE
require_once ABSPATH.'/mobile_detect/secure_token.php';  //LIVE

global $wpdb;
global $current_user;
get_currentuserinfo();

$user_id = get_current_user_id();
$user_info=get_userdata($user_id);
$user_name=$user_info->user_login;

$detect = new Mobile_DetectNew;



if($detect->isMobile()){

	$device="Mobile";}

else{

	$device="Personal Computer";}



$session_id=session_id();

$time_val=time();

$unique_id=$session_id."-".$time_val;



$session_id=$unique_id;



global $post;

$post = $wp_query->post;

// echo "<script>console.log('postId:".get_the_ID()."')</script>";

//echo "<script>console.log('postId:".$post->ID."')</script>";



$post_id=$post->ID;



$postdata = get_post($post_id);

$post_title = $postdata->post_title;

$post_name = $postdata->post_name; 



$ip_address=$_SERVER['REMOTE_ADDR'];

//echo $ip_address;

$user_agent=$ua=$_SERVER['HTTP_USER_AGENT'];
$os_name=getOS($ua);
$browser_array=getBrowser($ua);

$browser_name=$browser_array[0];
$browser_version=$browser_array[1];

$page_referer=$_SERVER['HTTP_REFERER'];

if(is_single()) //is a channel
{
//plan_id from agent-side subscrptn
$subAgent = $wpdb->get_var("SELECT plan_id FROM agent_vs_subscription_credit_info WHERE subscriber_id =  ".$user_id. " ORDER BY id DESC LIMIT 1
");
//endtime from wp agent_vs_sub
$enddateAgent = $wpdb->get_var("SELECT subscription_end_on FROM agent_vs_subscription_credit_info WHERE subscriber_id =  ".$user_id. " ORDER BY id DESC LIMIT 1");
//echo "<script>console.log('endDateAgent:".$enddateAgent."')</script>";
$dateNow = new DateTime("now");

$enddateAgent=new DateTime($enddateAgent);
$validity2=($enddateAgent >= $dateNow)?1:0;

$subStatus = $wpdb->get_var("SELECT count(user_id) FROM wp_pmpro_memberships_users WHERE user_id =  ".$user_id. " and status='active' ORDER BY id DESC LIMIT 1");

//check for video play 

$user_access= $wpdb->get_var("SELECT user_id FROM user_video_accesslist WHERE user_id =  ".$user_id." ");
$user_access=(int)$user_access;
//echo "<script>console.log('acc_user:".$user_access."')</script>";

if(  ( $subStatus==1 or ((int)$subAgent>0 and $validity2==1)) or $user_access) 
{
$play=1;
//echo "<script>console.log('play:".$play."')</script>";
}
else
$play=0;
}
else 
$play=-1;


$access_token_json=qezy_enc_web_analytics($user_id,$user_name,$post_id,$post_title,$post_name,$page_referer,$os_name,$browser_name,$browser_version,$session_id,$ip_address,$play,$device);
$access_token_arr=json_decode($access_token_json, true);
$access_token=$access_token_arr["access_token"];
//echo "<script>console.log('AT:".$access_token_arr["access_token"]."')</script>";
echo '<script type="text/javascript">	addonce();

					function addonce(){										

						var myValues1 = { "action" : "addanalytics","access_token":"'.$access_token.'"};

							jQuery.ajax({

								url: "'.site_url().'/mobile_detect/updatesessionbyapp.php",

								type: "post",

								data: myValues1,

								success: function(data){
						
										if(data == "1"){

												//window.alert("ok");

											}

									     	}
								});	
						 }

						

					setInterval( function(){

						var myValues1 = { "action" : "addanalytics","access_token":"'.$access_token.'"};

							jQuery.ajax({

								url: "'.site_url().'/mobile_detect/updatesessionbyapp.php",

								type: "post",

								data: myValues1,

								success: function(data){if(data == "1"){



												//window.alert("ok");

											}

									     	}

								});	

						 }, 30000);					

					</script>'; 



if(is_user_logged_in())

{

do_action('update_daily');

do_action('subscribed');

}



?>
<?php

$postdata = get_post( $id, $output, $filter );
/* create connection */
try{    
    $dbconAnalytics = new PDO('mysql:host=198.12.159.153;port=3306;dbname=cmadmin_qezyplay_analytics', 'cmadmin_dev', 'CmAdmin123', array( PDO::ATTR_PERSISTENT => false));
}catch(PDOException $e){
    echo $e->getMessage();    
}

$ipaddress = $_SERVER['REMOTE_ADDR'];
$pageReferer = (@$_SERVER['HTTP_REFERER']!="") ? @$_SERVER['HTTP_REFERER'] : "";
        
$pageData = ""; $pageId = $postdata->ID;
$sql = 'SELECT count(id) as count FROM page WHERE id = ?';
try {
    $stmt = $dbconAnalytics->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute(array($pageId));
    $pageData = $stmt->fetch(PDO::FETCH_ASSOC);                        
    $stmt = null;
    if($pageData['count'] == 0){                
        $sqlInsert = 'INSERT INTO page(id,page_name,short_name) VALUES(?,?,?)';
        $stmt = $dbconAnalytics->prepare($sqlInsert, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->execute(array($pageId,$postdata->post_title,$postdata->post_name));
        $stmt = null;        
    }            
}catch (PDOException $e){
    print $e->getMessage();
}


$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))    
    $device = "Mobile";
else
    $device = "Personal Computer";

if($pageId > 0){
    $langId = 1;
    $datetime = gmdate("Y-m-d H:i:s");

   $sql = 'INSERT INTO visitors_info (page_id,lang_id,ip_address,datetime,page_referer,device) VALUES(:page_id,:lang_id,:ip_address,:datetime,:page_referer,:device)';
    $stmt1 = $dbconAnalytics->prepare($sql);
    $stmt1->bindParam(":page_id",$pageId);
    $stmt1->bindParam(":lang_id",$langId);
    $stmt1->bindParam(":ip_address",$ipaddress);
    $stmt1->bindParam(":datetime",$datetime);
    $stmt1->bindParam(":page_referer",$pageReferer);
    $stmt1->bindParam(":device",$device);
    $stmt1->execute();
	$stmt1=null;
    //print_r($dbconAnalytics->errorInfo());
}
?>
</body>

</html>