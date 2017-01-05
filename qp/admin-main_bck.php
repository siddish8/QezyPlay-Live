<?php

include("agent-config.php");
include("customer-include.php");

//Access your POST variables
$customer_id = $_SESSION['adminid'];
//echo "id:".$agent_id;
//Unset the useless session variable

	
include("header-admin.php");
?>
	<style>
	.menudiv{
		background: lightgrey;
		border: 2px solid black;
		text-align:center;
		width: 300px;
		margin: 1%;
		color: hsl(0, 0%, 0%);
		float: left;
		height: 100px;
		padding: 2% 3% 3% 3%;
	}
	</style>
	<div id="content" role="main" style="min-height:500px;margin: 2% 5%;">
		<center><h2>Dashboard</h2></center><br>
		<div class="pmpro_box" id="pmpro_account-invoices" style="width:70%;margin:3% auto;">
			<a href="agent_management.php"><div class="menudiv"><h3>Agent Management</h3></div></a>
			<a href="customer_management.php"><div class="menudiv"><h3>Customer Management</h3></div></a>
			<a href="admin_channel_analytics.php"><div class="menudiv"><h3>Channel Statistics</h3></div></a>
		</div>
	</div>
	
<?php	

include("footer-admin.php");
	
?>
