<?php
session_start(); 
//Access your POST variables
$agent_id = $_SESSION['POST'];
//echo "id:".$agent_id;
//Unset the useless session variable
if($agent_id==""){
header('Location:../qp/agent.php');
}
else{

unset($_SESSION['POST']);


/* create connection */
try{
    $dbcon = new PDO("mysql:host=192.169.213.239;dbname=qezyplay_wordpress", "qezyplay_test", "test_qezyplay"); //LIVE
	//$dbcon = new PDO("mysql:host=50.62.170.42;dbname=tradmin_qezyplaydemo", "tradmin_qezyplay", "&(qezy@word)&");	//DEMO
}
catch(PDOException $e){
    echo $e->getMessage();    
}

session_start();

$sql = "SELECT agentname FROM agent_info WHERE id = ?";		
	try {
		$stmt = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute(array($agent_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
 
    		$stmt = null;

		$agent_name=$result['agentname'];
		
	     }
	catch (PDOException $e){
			print $e->getMessage();
             }



if(isset($_GET['logout'])){

session_destroy();
// or...
//unset($_SESSION['username'];

header('Location:../qp/agent.php');

}


$html="";
$html.="<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
   <head>
     <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Agent Home</title>
    <link rel='stylesheet' href='../qp/globals.css'>
<link rel='stylesheet' href='../qp/grid.css'>
   </head>
<body>
<script language='javascript' type='text/javascript' src='js/jquery.js'></script>
<script language='javascript' type='text/javascript' src='js/jquery-1.6.1.js'></script>
 <div class='row' style='padding:0px 10px;background-color:#000 !important;height:90px;color:#fff !important;max-width:1500px;'>
				<div class='twelve columns'>
					<header>
						<div class='four columns'>
							<div id='logo'>
							<img src='../qp/qezyplay-logo.png' alt='QezyPlay' height='73' width='173'>
							</div>
						</div>
						<div class='four columns'>
							<div id='hedtext'>
								<h3 style='color:#fff !important;'>QEZYPLAY</h3>
								<h4 style='color:#fff !important;'>AGENT PORTAL HOME</h4>
							</div>
						</div>

						<div class='four columns'>
							<div id='hedtext'>
								<h4 style='color:#fff !important;'>Welcome ".$agent_name."&nbsp;<span><a id='logout' href='?logout=true'>Logout</a></span></h4>
							</div>
						</div>
						
				  </header>
				</div>
			</div>
<div class='clear'></div>
<div align='center' class='row' style='margin:0 auto;padding:7% 10px;background-color:white !important;height:90px;color:#fff !important;max-width:1500px;'>
<table id='emailchecking'><tr><td><label for='subscriber'>Enter User's E-mail</label></td><td><input type='text' required name='user-mail' id='user-mail' onclick='clearError()' /></td><td><button onclick='checkMail();' value='Check e-mail' >Check Mail</button></td></tr>
<tr><td></td><td><p style='color:black;' id='emailErr'></p></td></tr></table>

<p id='emailSuccess' style='color:black;display:none;'></p>



<form class='paypal' action='../qp/Paypal/payments.php' method='post' id='paypal_form' target='_self' style='display:none;'>
		<input type='hidden' name='cmd' value='_xclick' />
		<input type='hidden' name='no_note' value='1' />
		<input type='hidden' name='lc' value='IND' />
		<input type='hidden' name='currency_code' value='USD' />
		<input type='hidden' name='bn' value='PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest' />
		<input type='hidden' name='first_name' value=''  />
		<input type='hidden' name='last_name' value=''  />
		
		<input type='hidden' name='subscriber' id='sub' />
		
	  
<table>
<!-- <tr><td><label for='subscriber'>User/Subscriber</label></td><td><select name='subscriber' required><option value=''>Select User</option> -->";

/*$sql1 = "SELECT ID,user_login,user_email FROM wp_users";		
	try {
		$stmt1 = $dbcon->prepare($sql1, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt1->execute();
		$result1 = $stmt1->fetchall(PDO::FETCH_ASSOC);
 		$stmt1 = null;
		foreach($result1 as $user){
		$userid=$user["ID"];
		$username=$user["user_login"];
		$usermail=$user["user_email"];
		//$html.="<option value='".$userid."'>".$username."</option>";
		}
		
	     }
	catch (PDOException $e){
			print $e->getMessage();
             }
*/

$html.="<tr><td><label for='bouquet'>Bouquet</label></td><td><select name='bouquet' required><option value=''>Select Bouquet</option><option value='1'>Bangla Bouquet</option>";

    //For other bouquets 

$html.="</select></td></tr>
<tr><td><label for='plan'>Subscription Plan</label></td><td><select name='item_number' required><option value=''>Select Plan</option>";

$sql2 = "SELECT id,name FROM wp_pmpro_membership_levels";		
	try {
		$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt2->execute();
		$result2 = $stmt2->fetchall(PDO::FETCH_ASSOC);
 		$stmt2 = null;
		foreach($result2 as $plan){
		$planid=$plan["id"];
		$planname=$plan["name"];
		$html.="<option value='".$planid."'>".$planname."</option>";}
		
	     }
	catch (PDOException $e){
			print $e->getMessage();
             }




$html.="</select></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Pay' id='Paypal' /></td></tr>
</table>
	<input type='hidden' name='payer_email' value=''  />	
	<input type='hidden' name='agent_id' value='".$agent_id."' / >

  </form>
</div>
<script>
function clearError()
{
document.getElementById('emailErr').style.display='none';
}

function checkMail()
{
//alert('Hi');
var mail=document.getElementById('user-mail').value;
	var val={'action':'agentuser-email','mail':mail};
	if(mail=='')
		{
		alert('Enter e-mail');
		document.getElementById('user-mail').setCustomValidity('Enter e-mail and check');
		}
	else{

		jQuery.ajax({url: 'https://qezyplay.com/qp/uservalidation_check.php',
		type: 'post',
		data: val,
		success: function(response){   
				if(response==1)
				{document.getElementById('emailErr').style.display='block';document.getElementById('emailErr').innerHTML='Entered E-mail doesnt exists';}
				else if(response==2)
				{document.getElementById('emailErr').style.display='block';document.getElementById('emailErr').innerHTML='Something wrong! Contact Admin';}
				else

				{
					document.getElementById('emailchecking').style.display='none';
					document.getElementById('emailSuccess').innerHTML='User exists with email:'+mail;	
				document.getElementById('emailSuccess').style.display='block';						
					document.getElementById('paypal_form').style.display='block';
					document.getElementById('sub').value=response;}
			}
						    	});	
		}
	

}
</script>

<div id='AgentCredits' align='center' style='padding:7% 0px;'><h2>".$agent_name."'s Credit Table</h2> 
<table class='widefat membership-levels' style='text-align: center;width:95% !important;color:black !important;'>

		<thead>
			<tr>
				<th>Subscriber E-mail</th>
				<th>Bouquet Id</th>
				<th>Plan Id</th>
				<th>Amount</th>
				<th>Subscription Startdate</th>
				<th>Subscription Enddate</th>
				<th>Paid Date</th>
			</tr>
		</thead>
		<tbody class='ui-sortable'>";

$sql3 = "SELECT * FROM agent_vs_subscription_credit_info where agent_id=?";		
	try {
		$stmt3 = $dbcon->prepare($sql3, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt3->execute(array($agent_id));
		$result3 = $stmt3->fetchall(PDO::FETCH_ASSOC);
 		$stmt3 = null;
		foreach($result3 as $credit){
		$subid=$credit["subscriber_id"];
		$boqid=$credit["bouquet_id"];
		$planid=$credit["plan_id"];
		$amount=$credit["amount"];
		$start=$credit["subscription_start_from"];
		$end=$credit["subscription_end_on"];
		$paid=$credit["credited_datetime"];

$sql4 = "SELECT user_login,user_email FROM wp_users where ID=?";		
	try {
		$stmt4 = $dbcon->prepare($sql4, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt4->execute(array($subid));
		$result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
		$user_email=$result4['user_email'];
		}
	catch (PDOException $e){
			print $e->getMessage();
             }
		$html.="<tr style='' class='ui-sortable-handle'>			
				<td style='width: 44px;'>".$user_email."</td>
				<td style='width: 342px;'>".$boqid."</td>
				<td style='width: 184px;'>".$planid."</td>
				<td style='width: 192px;'>".$amount."</td>
				<td style='width: 192px;'>".$start."</td>
				<td style='width: 192px;'>".$end."</td>
				<td style='width: 192px;'>".$paid."</td>
			</tr>";

				}
			
	     }
	catch (PDOException $e){
			print $e->getMessage();
             }


$html.="	</tbody>
	</table>
</div>


<div id='footernew' style='background-color:black !important;'>
		<div class='container'>
			<div class='row'>
				<div class='twelve columns'>
<div class='copyright col-md-6 ver_sep' style='width=25%;'>Copyright © 2016  <a href='http://www.qezymedia.com' target='_blank'>Qezy Media</a> All rights reserved.</div>
					<div id='copyright'>
						<!-- <img src='../qp/ib_newlogo.jpeg' alt='logo' height='63' width='150'> -->
					</div>
				</div>
			</div>
		</div>
        </div>
  <script type='text/javascript' src='common.js'></script>
</body>
</html>";
echo $html;
}?>
