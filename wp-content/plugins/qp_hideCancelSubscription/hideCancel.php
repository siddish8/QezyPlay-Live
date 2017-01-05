<?php 
    /*
    Plugin Name: HideCancelBtn
    Plugin URI: 
    Description: Hiding plan cancel button after the free time pmpro
    Author: IB
    Version: 1.0
    Author URI: ib
    */
ob_start();
add_shortcode('hidecancel','cancel_btn_hide');

function cancel_btn_hide(){
global $current_user;
global $wpdb;

get_currentuserinfo();
$user_id = get_current_user_id();

/* $startdate = $wpdb->get_var("SELECT startdate FROM ".$wpdb->prefix."pmpro_memberships_users WHERE user_id =  ".$user_id. " ORDER BY id DESC LIMIT 1
"); */ //LIVE
$startdate = $wpdb->get_var("SELECT startdate FROM wp_pmpro_memberships_users WHERE user_id =  ".$user_id. " ORDER BY id DESC LIMIT 1
"); //DEMO
$dateNow = new DateTime("now");
//$dateNow1 = new DateTime("2016-05-14");
$startdate=new DateTime($startdate);

$hide=($dateNow > $startdate);
//echo "hide:".$hide;
$hide1=($dateNow1 > $startdate);
//echo "hide1:".$hide1;

//echo $startdate->format('Y-m-d');
//echo $dateNow1->format('Y-m-d');
//echo $dateNow->format('Y-m-d');


if($hide==1) {
//echo "ok hide cancel link............."; 
echo "<span>Plan started</span>";
?>
<script>document.getElementById('plancancelLink').style.display="";</script>
<?php }else{//echo "Cancel NOW";
echo "<span>Plan starts in </span>";

$startdate=$startdate->format("Y-m-d H:i:s");
$dateNow=$dateNow->format("Y-m-d H:i:s");

$timeFirst  = strtotime($startdate);
$timeSecond = strtotime($dateNow);
$differenceInSeconds = $timeFirst-$timeSecond;
$interval = ($differenceInSeconds);
?>
<span id="countdown" class="timer"></span>
<script>
var upgradeTime = <?php echo $interval ?>

var seconds = upgradeTime;
function timer() {
    var days        = Math.floor(seconds/24/60/60);
    var hoursLeft   = Math.floor((seconds) - (days*86400));
    var hours       = Math.floor(hoursLeft/3600);
    var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
    var minutes     = Math.floor(minutesLeft/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = days + ":" + hours + ":" + minutes + ":" + remainingSeconds + " days";
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Completed";
    } else {
        seconds--;
    }
}
var countdownTimer = setInterval('timer()', 1000);
</script>


<?php
}
}?>

<?php
