<?php 

include("agent-config.php");
include("customer-include.php");
include("function_common.php");

$msg = ""; $action = "Add";

if(isset($_GET['del'])){

	$id = $_GET['id'];

	$stmt11 = $dbcon->prepare("DELETE FROM agent_info WHERE id = ".$id."", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt11->execute();

	$stmt22 = $dbcon->prepare("DELETE FROM agent_location_info WHERE agent_id = ".$id."", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt22->execute();

	$msg = "<span style='color:green'>Agent deleted Successfully</span>";
	
}


if(isset($_POST['Add_Submit'])){
	
	$agentname=trim($_POST['agentname']);
	$phone=trim($_POST['phone']);
	$email=trim($_POST['email']);
	//$authkey=trim($_POST['add_authkey']);

	$city=trim($_POST['city']);
	//$cityArray = explode(',', $city); //uncomment
		
	
	$authkey = md5($email.rand());
	$authkey = substr($authkey, 0, 10);	
	//$authkey="";
	$date = gmdate("Y-m-d H:i:s");
	
	$stmt21 = $dbcon->prepare('SELECT id FROM agent_info WHERE mobile = "'.$phone.'" OR agentname = "'.$agentname.'" OR email = "'.$email.'"', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
	$stmt21->execute();
	$result21 = $stmt21->fetch(PDO::FETCH_ASSOC);
	$userexit = $result21['id'];	
		
	if((int)$userexit > 0){
		
		$msg = "<span style='color:red'>Agent already exist</span>";
		
	}else{			
		
		//insert query
		$stmt22 = $dbcon->prepare('INSERT INTO agent_info(agentname,mobile,email,authkey,created_datetime) VALUES("'.$agentname.'","'.$phone.'","'.$email.'","'.$authkey.'","'.$date.'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt22->execute();
		$agent_id = $dbcon->lastInsertId();

		$agentloginlink = SITE_URL."/qp/agent-login.php";
		
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// More headers
		$headers .= 'From: <'.ADMIN_EMAIL.'>' . "\r\n";
		
		$subjectAgent = "Your account info on Qezyplay.com as Agent";
		$regards = "<p>Regards, <br>Admin - QezyPlay</p>";
		$bodyAgent = "<p>Hi ".$agentname.",</p>
		<p>Your account has been created in Qezyplay.com as Agent</p>
		<p>Find below credentials to login with agent portal</p>
		<p>
		<b>Email:</b> $email<br>
		<b>Auth Key:</b> $authkey<br>
		</p>
		<p>Log in to your agent portal here: $agentloginlink</p>".$regards;	
		
		//mail Agent
		mail($email, $subjectAgent, print_r($bodyAgent,true), $headers);

		$locationsArray =explode(',',$city); //added
		foreach($locationsArray as $locAr)
		{
			$cityAr=explode('-',$locAr);
			$stmt23 = $dbcon->prepare('INSERT INTO agent_location_info(agent_id,location,region,country) VALUES("'.$agent_id.'","'.$cityAr[0].'","'.$cityAr[1].'","'.$cityAr[2].'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt23->execute();	
		}

		$msg = "<span style='color:green'>Agent added Successfully</span>";
					
	}
}


if(isset($_POST['Edit_Submit'])){

	$agentid=trim($_POST['agentid']);
	
	//$agentid = $_GET['id'];
	$agentname=trim($_POST['agentname']);
	$phone=trim($_POST['phone']);
	$email=trim($_POST['email']);
	$city=trim($_POST['city']);

	$cityArray = explode(',', $city);
	$date = gmdate("Y-m-d H:i:s");
	$stmt21 = $dbcon->prepare('SELECT id FROM agent_info WHERE id != '.$agentid.' AND (mobile = "'.$phone.'" OR agentname = "'.$agentname.'" OR email = "'.$email.'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
	$stmt21->execute();
	$result21 = $stmt21->fetch(PDO::FETCH_ASSOC);	
	$userexit = $result21['id'];
	
	if((int)$userexit > 0){
		
		$msg = "<span style='color:red'>Agent already exist</span>";
		
	}else{
		
		//update query
		$stmt22 = $dbcon->prepare('UPDATE agent_info SET agentname = "'.$agentname.'", mobile = "'.$phone.'", email = "'.$email.'",created_datetime = "'.$date.'" WHERE id = '.$agentid, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	 
		$stmt22->execute();
		
		$stmt24 = $dbcon->prepare('DELETE FROM agent_location_info WHERE agent_id = '.$agentid.'', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt24->execute();
		
		$locationsArray =explode(',',$city); //added
		//echo "<pre>";
		//print_r($locationsArray);
		foreach($locationsArray as $locAr)
		{
			$cityAr=explode('-',$locAr);
			$stmt23 = $dbcon->prepare('INSERT INTO agent_location_info(agent_id,location,region,country) VALUES("'.$agentid.'","'.$cityAr[0].'","'.$cityAr[1].'","'.$cityAr[2].'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt23->execute();	
		}	
		$msg = "<span style='color:green'>Agent updated Successfully</span>";
								
	}		
	
}	


if(isset($_GET['edit'])){

	$id = $_GET['id'];		

	$stmt1 = $dbcon->prepare("SELECT * FROM agent_info where id='".$id."'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt1->execute();
	$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	foreach($result1 as $row1){
		$agentname1=$row1['agentname'];
		$mobile1=$row1['mobile'];
		$email1=$row1['email'];
	}

	$stmt2 = $dbcon->prepare("SELECT group_concat(concat(location,'-',region,'-',country)) as location FROM agent_location_info where agent_id='".$id."'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
	$stmt2->execute();
	$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	$location1 = $result2['location'];		
	$action = "Edit";

}	

include("header-admin.php");
?>

<style>
.xoouserultra-field-value, .xoouserultra-field-type{
	width: unset !important;
	padding: 5px;
}
</style>

<div id="content" role="main" style="min-height:500px;margin: 2% 5%;">
	<!-- <h4 style="float:right;"><a alt="click to dashboard" href="admin-main.php">Dashborad</a></h4> -->
	<div class="pmpro_box" id="pmpro_account-invoices">
		<h2 style="text-align:center">Agent Management</h2>
		
		<div class="xoouserultra-wrap" style="max-width:100% !important;">
			<div class="msg" align="center" style="display:block"><h4><?php echo $msg;?></h4></div><br>	
			<div class="xoouserultra-inner xoouserultra-login-wrapper">
				<div class="xoouserultra-main">
					<h4><b><u><?php echo $action;?> Agent</u></b></h4>
					<form id="xoouserultra-login-form-1" method='post' onsubmit="return callsubmit();">
						<input type="hidden" id="agentid" name="agentid" value="<?php echo $id; ?>"/>
						<div class="xoouserultra-field xoouserultra-edit xoouserultra-edit-show">
							<label class="xoouserultra-field-type">	
								<span>Agent Name:</span>
							</label>
							<div class="xoouserultra-field-value">
								<input type="text" value="<?php echo @$agentname1;?>" id="agentname" name="agentname" />	
							</div>
							&nbsp;&nbsp;&nbsp;
							<label class="xoouserultra-field-type">	
								<span>Mobile:</span>
							</label>
							<div class="xoouserultra-field-value">
								<input type="text" placeholder="Ex:+919000000000" value="<?php echo @$mobile1;?>" id="phone" name="phone"/>
							</div>
							&nbsp;&nbsp;&nbsp;
							<label class="xoouserultra-field-type">	
								<span>Email:</span>
							</label>
							<div class="xoouserultra-field-value">
								<input type="text" value="<?php echo @$email1;?>" id="email" name="email" />
							</div>
						</div>		
						<div class="xoouserultra-clear"></div>
						<div class="xoouserultra-field xoouserultra-edit xoouserultra-edit-show">
						
							<label class="xoouserultra-field-type">	
								<span>Location:</span>
							</label>
							<div class="xoouserultra-field-value">
								<textarea rows="3" cols="35" name="city" id="city" placeholder="Ex: city1-state1-country1,city2-state2-country2" ><?php echo @$location1;?></textarea>
							</div>
							&nbsp;&nbsp;&nbsp;
							
							<div class="xoouserultra-field-value" style="padding-left: 10px;">
								<input type="submit" name="<?php echo $action;?>_Submit"  value="Submit" />
							</div>
							&nbsp;&nbsp;&nbsp;
							<div class="xoouserultra-field-value" style="padding-left: 10px;">
								<div id='error' style='color:red;padding-left:10px;'";></div>
							</div>
							
						</div>						
						<div class="xoouserultra-clear"></div>
					</form>
				</div>
			</div>

		</div>

		<table style="overflow-x:auto;min-width:50%;max-width:100% !important;" width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>					
					<th>Agent Name</th>
					<th>Mobile</th>
					<th>Location</th>
					<th>E-mail</th>
					<th>Auth Key</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="ui-sortable">
			<?php

			$stmt4 = $dbcon->prepare("SELECT * FROM agent_info", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt4->execute();
			$result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
	
			foreach($result4 as $row){

				$id=$row['id'];
				$agentname=$row['agentname'];
				$mobile=$row['mobile'];
				$email=$row['email'];
				$authkey=$row['authkey'];

				$stmt5 = $dbcon->prepare("SELECT group_concat(concat(location,'-',region,'-',country)) as location FROM agent_location_info where agent_id='".$id."'");
				$stmt5->execute();
				$result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
				$location = $result5['location'];
			?>
				<tr style="" class="ui-sortable-handle">							
				<td style="width: 342px;color:blue;" class="level_name"><?php echo $agentname;?></td>
				<td style="width: 184px;"><?php echo $mobile;?></td>
				<td style="width: 192px;"><?php echo $location?></td>
				<td style="width: 192px;"><?php echo $email;?></td>
				<td style="width: 192px;"><?php echo $authkey;?></td>
				<td style="width: 332px;"><a style="cursor: pointer;color:blue;" id="editAgent" href="agent_management.php?edit=true&id=<?php echo $id;?>" title="edit" name="Edit-<?php echo $id ?>" class="button-primary">Edit</a>&nbsp;
				<a style="cursor: pointer;color:blue;" title="delete" name="removeAgent-<?php echo $id;?>" id="removeAgent-<?php echo $id;?>" onclick="callConfirmation('agent_management.php?del=true&id=<?php echo $id;?>');" class="button-secondary">Delete</a></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>


<script>

function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function validatePhone(phone) {
	var re = /^([0|\+[0-9]{1,5})?([1-9][0-9]{9})$/;
	return re.test(phone);
}

function callsubmit(){	
	
	var email = jQuery("#email").val();
	var agentname = jQuery("#agentname").val();
	var phone = jQuery("#phone").val();
	var city = jQuery("#city").val();


	if(agentname == ""){
		jQuery("#error").html("Please enter agent name");		
	}else if(phone == ""){
		jQuery("#error").html("Please enter mobile");		
	}else if(email == ""){
		jQuery("#error").html("Please enter email address");		
	}else if(city == ""){
		jQuery("#error").html("Please enter location information");		
	}

	if(agentname != "" && phone != "" && email != "" && city != ""){
		if (validateEmail(email)) {
			if (validatePhone(phone)) {
				return true;
			
			} else {
				jQuery("#error").html("Please enter valid phone no");
			}
			
		} else {
			jQuery("#error").html("Please enter valid emaild address");
		}
	}
	return false;
}


function callConfirmation(url){

	var ans = confirm("Sure, do you want to delete this agent?");
	if(ans){
		window.location.href = url;
	}
}
</script>
<?php include("footer-admin.php"); ?>

