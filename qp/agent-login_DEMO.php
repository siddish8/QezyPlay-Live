<?php
session_start(); 
/* create connection */
try{
   // $dbcon = new PDO("mysql:host=192.169.213.239;dbname=qezyplay_wordpress", "qezyplay_test", "test_qezyplay"); //LIVE
	$dbcon = new PDO("mysql:host=50.62.170.42;dbname=tradmin_qezyplaydemo", "tradmin_qezyplay", "&(qezy@word)&");	 //DEMO

}
catch(PDOException $e){
    echo $e->getMessage();    
}


$username = $password = $userError = $passError = '';

if(isset($_POST['login'])){
 	 $email = trim($_POST['email']); $authkey = trim($_POST['authkey']);


	$sql1 = "SELECT email FROM agent_info";		
	try {
		$stmt1 = $dbcon->prepare($sql1, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt1->execute();
		$result1 = $stmt1->fetchall(PDO::FETCH_ASSOC);
 
    		$stmt1 = null;
		
		$match=0;
		//echo $result1;
		//print_r($result1);
		foreach($result1 as $em)
		{
			if($em['email'] == $email)
				{$match=1;}
			
		}
		
	     }
	catch (PDOException $e){
			print $e->getMessage();
             }

if($match==0)
{
echo "<script>window.alert('Email doesnt exist');</script>";$emailError = 'Email doesnt exists';
}
else
{
	$sql2 = "SELECT id,authkey FROM agent_info WHERE email = ?";		
	try {
		$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt2->execute(array($email));
		$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
 
    		$stmt2 = null;

		$agent_id=$result2['id'];
		$authkey_db=$result2['authkey'];
	
		
	     }
	catch (PDOException $e){
			print $e->getMessage();
             }

  if($email === $email && $authkey === $authkey_db){
    $_SESSION['login'] = true; 
session_start();

//Dump your POST variables
$_SESSION['POST'] = $agent_id;

//Redirect the user to the next page
header('LOCATION:agent-main.php'); die();
	
  }

  
  if($authkey !== $authkey_db) { echo "<script>window.alert('Invalid Key');</script>";$authError = 'Invalid key';}
}
}

echo "<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
   <head>
     <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Agent Login</title>
     
<link rel='stylesheet' href='../qp/globals.css'>
<link rel='stylesheet' href='../qp/grid.css'>
   </head>
<body>
<div class='row' style='padding:0px 10px;background-color:#000 !important;height:90px;color:#fff !important;ma-width:1500px;'>
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
								<h4 style='color:#fff !important;'>AGENT PORTAL LOGIN</h4>
							</div>
						</div>
						
				  </header>
				</div>
			</div>
<div class='clear'></div>
<div align='center' class='row' style='margin:0 auto;padding:12.5% 10px;background-color:white !important;height:90px;color:#fff !important;max-width:1500px;'>
  <form name='input' action='{$_SERVER['PHP_SELF']}' method='post'>
<table>
<tr>
   <td> <label for='email'>Email</label></td><td><input type='text' value='$email' id='email' name='email' required /></td></tr>
    <tr><td></td><td><div class='error' style='color:red;'>$emailError</div></td></tr>
    <tr><td><label for='authkey'>Auth Key</label></td><td><input type='password' value='$authkey' id='authkey' name='authkey' required /></td></tr>
        <tr><td></td><td><div class='error' style='color:red;'>$authError</div></td></tr>
    <tr><td></td><td><input type='submit' value='Login' name='login' /></td></tr>
</table>
  </form>
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
?>
