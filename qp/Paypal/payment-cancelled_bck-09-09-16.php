<?php

$agentid = $_GET['go'];

include("../agent-config.php");

if(isset($_POST['home'])){
	session_start();
	$_SESSION['agentid'] = $_POST['agentid'];

	//Redirect the user to the next page
	header('LOCATION: ../agent-main.php'); die();
}

include("../header.php");
?>

<style>
@media (min-width: 1200px){
#content{
    margin-bottom: 80px;
    margin-top: 80px;
}
</style>
<div id="content" role="main">
	<div class="xoouserultra-wrap xoouserultra-login">
		<div class="xoouserultra-inner xoouserultra-login-wrapper">
			<div class="xoouserultra-main">
				<h1 align="center">Payment Cancelled</h1><br>
				<p align="center">Your payment was cancelled.</p><br>
				<form method="post" align="center"; style="margin: 0 auto; ">
					<input type="hidden" name="agentid" value="<?php echo $agentid; ?>">
					<center><input type="submit" value="Go HOME" name="home"></center>
				</form>
			</div>
		</div>
	</div>
</div>

	
<?php
include("../footer.php");
?>
