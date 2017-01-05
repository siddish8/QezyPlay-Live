<?php 
include('header.php');
//include("customer-include.php");
//include("function_common.php");
?>
<article class="content items-list-page">

<?php



if(($_POST['get_uname'])!=""){
$usrid=$_POST['uid'];
$usname=get_var("SELECT user_login from wp_users WHERE ID='".$usrid."'");
}

if(($_POST['get_uid'])!=""){	

$uname=$_POST['uname'];	
$usid=get_var("SELECT ID from wp_users WHERE user_login='".$uname."'");
}

if(isset($_POST['reg'])){

//Registrations Info Delete
echo "user_id:".$id=$_POST['userid'];
$msg="<br>";

$sql1="DELETE FROM wp_users WHERE ID = ".$id." ";
$r1=execute($sql1);
if($r1)
{
$msg.="Deleted from wp_users <br>";
}

$sql2 = "DELETE FROM wp_usermeta WHERE user_id = ".$id."";
$r2=execute($sql2);

if($r2)
{
$msg.="Deleted from wp_usermeta <br>";
}

$sql3 = "DELETE FROM wp_options WHERE option_name = 'activation_".$id."";
$r3=execute($sql3);
if($r3)
{
$msg.="Deleted from wp_options -activation <br>";
}

}

if(isset($_POST['sub'])){

//Subscription Info Delete
echo "user_id:".$id=$_POST['userid'];
$msg="<br>";

$sql1 = "DELETE FROM wp_pmpro_memberships_users WHERE user_id = ".$id."";
$r1=execute($sql1);
if($r1)
{
$msg.="Deleted from wp_pmpro_memberships_users <br>";
}

$sql2="DELETE FROM agent_vs_subscription_credit_info WHERE subscriber_id = ".$id."";
$r2=execute($sql2);
if($r2)
{
$msg.="Deleted from agent_vs_subscription_credit_info <br>";
}


$sql3 = "DELETE FROM pmpro_dates_chk1 WHERE user_id = ".$id."";
$r3=execute($sql3);
if($r3)
{
$msg.="Deleted from pmpro_dates_chk <br>";
}

$sql4 = "DELETE FROM wp_options WHERE option_name = 'subscribed_".$id."";
$r4=execute($sql4);
if($r4)
{
$msg.="Deleted from wp_options - subscribed <br>";
}

$sql5 = "DELETE FROM wp_options WHERE option_name = 'pmpro_sub_support_delay_".$id."";
$r5=execute($sql5);
if($r5)
{
$msg.="Deleted from wp_options - sub_supp_delay <br>";
}

$sql6 = "DELETE FROM wp_options WHERE option_name = 'pmpro_sub_support_prev_delay_".$id."";
$r6=execute($sql6);
if($r6)
{
$msg.="Deleted from wp_options - sub_supp_prev_delay <br>";
}



}

if(isset($_POST['subX'])){

//Agent Sub-req, Penidng Remittance Info Delete
echo "user_id:".$id=$_POST['userid'];
echo "user_name:".$name=$_POST['username'];

$msg="<br>";

$sql1 ="DELETE FROM agent_credit_requests WHERE user_name = ".$name."";
$r1=execute($sql1);
if($r1)
{
$msg.="Deleted from agent_credit_requests <br>";
}

$sql2 = "DELETE FROM agent_remittence_pending WHERE subscriber_id = ".$id."";
$r2=execute($sql2);
if($r2)
{
$msg.="Deleted from agent_remittence_pending <br>";
}


}

if(isset($_POST['comp'])){

//Complete Info Delete
echo "user_id:".$id=$_POST['userid'];
echo "user_name:".$name=$_POST['username'];


$sql2 = "DELETE FROM wp_usermeta WHERE user_id = ".$id."";
execute($sql2);

$sql3 = "DELETE FROM wp_options WHERE option_name = 'activation_".$id."";
execute($sql3);

$sql4 = "DELETE FROM wp_pmpro_memberships_users WHERE user_id = ".$id."";
execute($sql4);

$sql5 = "DELETE FROM agent_vs_subscription_credit_info WHERE subscriber_id = ".$id."";
execute($sql5);

$sql6 = "DELETE FROM pmpro_dates_chk1 WHERE user_id = ".$id."";
execute($sql6);

$sql7 = "DELETE FROM wp_options WHERE option_name = 'subscribed_".$id."";
execute($sql7);

$sql8 = "DELETE FROM wp_options WHERE option_name = 'pmpro_sub_support_delay_".$id."";
execute($sql8);

$sql9 = "DELETE FROM wp_options WHERE option_name = 'pmpro_sub_support_prev_delay_".$id."";
execute($sql9);

$sql10 = "DELETE FROM agent_credit_requests WHERE user_name = ".$name."";
execute($sql10);

$sql11 = "DELETE FROM agent_remittence_pending WHERE subscriber_id = ".$id."";
execute($sql11);

$sql1 = "DELETE FROM wp_users WHERE ID = ".$id."";
execute($sql1);

$msg="Deleted All info";
}


if($usid!=""){$f=$usid;}else{$f=$usrid;}

if($usname!=""){$g=$usname;}else{$g=$uname;}

echo '<div class="alert alert-info fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>'.$msg.'</strong> 
</div>';

echo "<style>.noclick{opacity: 0.65; 
  cursor: not-allowed;pointer-events:none}</style>";
echo '
<!-- Main -->
				<div id="main-wrapper">
					<div class="container">
						<div class="row 200%">
							
							<div class="8u 12u(medium) important(medium)">

								<!-- Content -->
									<div id="content">
										<section class="last">
											<h2>First Get User Info </h2>

											<p>
											<form method="post">
Enter Username : 
<input type="text" name="uname" id="uname" /> 
<input type="submit" name="get_uid" value="Get UserId" />  
<span >'.$usid.'</span><br /><br />

or Enter UserId: <input type="text" name="uid" id="uid" /> 
<input type="submit" name="get_uname" value="Get Username" />  
<span >'.$usname.'</span><br /><br />

 <input type="hidden" name="userid" id="userid" value="'.$f.'" />
<input type="hidden" name="username" id="username" value="'.$g.'" />

 										</p>

											<!-- a href="#" class="button icon fa-arrow-circle-right">Continue Reading</a -->
										</section>
									</div>

							</div>

							<div class="4u 12u(medium)">

								<!-- Sidebar -->
									<div id="sidebar">
										<section class="widget thumbnails">
											<h3>DELETE ACTIONS</h3>
											<div class="grid">
												<div class="row 50%">
													<div class="6u"><input id="delb1"  class="noclick" type="submit" name="sub" value="Subscription Delete" /></div>
													<div class="6u"><input id="delb2"  class="noclick" type="submit" name="subX" value="Agent Portal Req&Rem Delete" /></div>
													<div class="6u"><input id="delb3"  class="noclick" type="submit" name="reg" value="Registration Delete" /></div>
													<div class="6u"><input id="delb4"  class="noclick" type="submit" name="comp" value="Complete info Delete" /></div>
												</div>
											</div>
											<!-- a href="#" class="button icon fa-file-text-o">More</a -->
										</section>
									</div>

							</div>
						</form>						
						</div>
					</div>
				</div>




';

echo '
<script>
var a=document.getElementById("username").value;
var b=document.getElementById("userid").value;

var b1=document.getElementById("delb1");
var b2=document.getElementById("delb2");
var b3=document.getElementById("delb3");
var b4=document.getElementById("delb4");

if(a!="" && b!="")
{
b1.setAttribute("class","");
b2.setAttribute("class","");
b3.setAttribute("class","");
b4.setAttribute("class","");
}
else
{
b1.setAttribute("class","noclick");
b2.setAttribute("class","noclick");
b3.setAttribute("class","noclick");
b4.setAttribute("class","noclick");

}


</script>
';


?>
</article>
<?php
include('footer.php');
?>



?>
