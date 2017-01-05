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
$idu = $current_user->id;
//echo $username;
?>
<?php 

// where `user_login`='$username' AND `courses`='$course'
$list_q = "select * from wp_users WHERE user_login = '$username'";
$list_q = $wpdb->get_results($list_q);



foreach($list_q as $list_q)
				{
$cour = $list_q->user_login;
//echo $cour;


/*if(($list_q->courses) == $cour){

echo do_shortcode("[iframe_loader type='iframe'  width='100%' height='600' frameborder='0' src='http://ideabytestraining.com/espectra/wp-content/uploads/articulate_uploads/Transportation of Dangerous Goods-new/story.html']");
echo "<br /><br />";
echo '<div align="left"><strong><h4><a href="http://ideabytestraining.com/espectra/wp-content/uploads/2015/07/Transportation-of-Dangerous-Goods-Reference-Material.pdf" target="_blank">Download-PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;<br /><a href="http://ideabytestraining.com/espectra/exam-canada/" target="_blank">Exam</a></h4></strong></div>';
} */
}

/*$detan_q = "select * from wp_pms_member_subscriptions WHERE user_id = ('$idu')";
$detan_q = $wpdb->get_results($detan_q);

foreach($detan_q as $detan_q)
				{
//$ndta = implode(', ', $detan_q->user_id);
$ndta = $detan_q->user_id;

if(($ndta) == '$idu'){
echo $idu;
} else { 
$ndtan = "no data found";

}

}
echo $ndtan;*/

$deta_q = "select * from wp_pms_member_subscriptions WHERE user_id = '$idu'  GROUP BY subscription_plan_id, start_date";
$deta_q = $wpdb->get_results($deta_q);
echo "<div id='body'>
<div class='container'>
            <div class='row'>
            						<div id='content' class='col-md-12' role='main'>
					<article class='post-1817 page type-page status-publish hentry'>	

           
    <div class='content-single'><div id='table_cover' style='height:500px;width:50%;margin:0 auto;'>";
//echo "<div style='margin : 0 auto;'></div>";
echo "<table id='mysubs_table' align='center'><th>Package</th><th>Plan</th><th>Start Date</th><th>End Date</th><th>Status</th>";
foreach($deta_q as $deta_q)
				{
$plan = $deta_q->subscription_plan_id;

$plan_q = "select * from wp_posts WHERE ID = '$plan'";
$plan_q = $wpdb->get_results($plan_q);

echo "<tr>";

echo "<td>";
//echo $plan;
/*if(($plan)  == "1187") {

echo "Records found.";

} else {
echo "Records not found.";

}*/

if(($plan)  == "1186" || ($plan)  == "1187" || ($plan)  == "1328" || ($plan)  == "1329"){
echo "<a href='http://qezyplay.com/subscribe-qezy/' target='_blank'>Qezy Bouquet</a>";

}

if(($plan)  == "1149" || ($plan)  == "1146" || ($plan)  == "1147"|| ($plan)  == "1689"){
echo "<a href='http://qezyplay.com/subscribe-bangla/' target='_blank'>Bangla Bouquet</a>";

}
echo "</td>";



echo "<td>";




foreach($plan_q as $plan_q)
				{



echo $plan_q->post_title;

}
echo "</td>";

echo "<td>";

//echo $idu;

/*$count=$_GET['$idu'];
echo $plan_q->user_id;
$people = array($plan_q->user_id);
echo $count;
if(in_array($idu, $people, FALSE)){

echo $idu;
echo '<div align="center"style="color:#ffccff; font-weight:bold; font-size:16px;">qwewew'.$ndta.'</div>';
} else {
echo $idu;
echo '<div align="center"style="color:#ffccff; font-weight:bold; font-size:16px;">werewre'.$ndta.'</div>';
}*/

$sdtme = strtotime($deta_q->start_date);
$myFormatForView = date("d/m/Y", $sdtme);

$edtm = strtotime($deta_q->expiration_date);
$myFormatView = date("d/m/Y", $edtm);


echo $myFormatForView;
echo "</td>";

echo "<td>";
echo $myFormatView;
echo "</td>";

echo "<td>";
echo ucfirst($deta_q->status);
echo "</td>";

echo "</tr>";

}
echo "</table>";
echo "</div></div></article></div></div></div></div>";
?>
<?php 

get_footer(); ?>