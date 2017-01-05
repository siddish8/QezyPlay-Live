<?php


include("function_common.php");


$action=$_REQUEST['action'];


include("db-config.php");

switch($action){

	case "searchuser":
		
		$emailUN = trim($_POST['emailUN']);
		$email = trim($_POST['email']);
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$phone = $_POST['phone'];

		$cond1 = $condMeta = $cond2 = "";
		if($emailUN!="")
			$cond1 .= " AND (user_email = :emailUN OR user_login = :emailUN)";
		if($email!="")
			$cond1 .= " AND user_email = :email";
		if($username!="")
			$cond1 .= " AND user_login = :username";
		if($firstname!="")
			$cond2 .= " AND (meta_key = 'first_name' AND meta_value like :firstname)";
		if($lastname!="")
			$cond2 .= " AND (meta_key = 'last_name' AND meta_value like :lastname)";
		if($phone!="")
			$cond2 .= " AND (meta_key = 'phone' AND meta_value like :phone)";

		if($cond2 != ""){
			$condMeta = " AND ID in (SELECT DISTINCT user_id FROM wp_usermeta WHERE 1".$cond2.")";
		}

		$sql = "SELECT ID, user_login, user_email FROM wp_users WHERE 1".$cond1."".$condMeta;		
		try {
			$stmt = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			if($emailUN!="")	
				$stmt->bindParam(":emailUN", $emailUN);
			if($email!="")	
				$stmt->bindParam(":email", $email);
			if($username!="")
				$stmt->bindParam(":username", $username);
			if($firstname!="")
				$stmt->bindParam(":firstname", $firstname);
			if($lastname!="")
				$stmt->bindParam(":lastname", $lastname);
			if($phone!="")
				$stmt->bindParam(":phone", $phone);

			$stmt->execute();	
			$count = $stmt->rowCount();
			if($count > 0){
				
				$res = $stmt->fetch(PDO::FETCH_ASSOC);							
				echo json_encode($res);				
			}		

			$stmt = null;

		}catch (PDOException $e){
			print $e->getMessage();
		}
		exit;
		break;
	case "useractive":

		$sub_id=$_POST['user_id'];

		$sql2 = "SELECT count(*) as count FROM agent_vs_subscription_credit_info WHERE 1 AND subscriber_id = ? AND DATE(subscription_end_on) >= CURRENT_DATE()";	
	
	$sql3 = "SELECT count(*) as count FROM wp_pmpro_memberships_users WHERE 1 AND user_id = ? AND status = 'active'";	
	
	try {
		
		$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		//$stmt->execute(array($plan_id, $sub_id));
		$stmt2->execute(array($sub_id));
		$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);	
		$agentSubsCont = $result2['count'];
		$stmt2 = null;
		
		$stmt3 = $dbcon->prepare($sql3, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));		
		$stmt3->execute(array($sub_id));
		$result3 = $stmt3->fetch(PDO::FETCH_ASSOC);	
		$SelfSubsCont = $result3['count'];
		$stmt3 = null;

		$delay=get_var("select option_value from wp_options where option_name='pmpro_sub_support_delay_".$sub_id."' ");
		$upto=get_var("select next_paydate from pmpro_dates_chk1 where user_id=".$sub_id." order by id desc ");
		
		if(($agentSubsCont > 0) || ($SelfSubsCont > 0))
			{
				echo "{Delay:".$delay."} {NextPay/End Date:".$upto."}";
			}
		else
		
				echo "0";		
		
	}catch (PDOException $e){
		print $e->getMessage();
	}
	exit;
		break;

	case "userpending":

		$sub_id=$_POST['user_id'];

		$sql4 = "SELECT agent_id,count(*) as count FROM agent_remittence_pending WHERE subscriber_id = ? AND status = 'pending'";	
		
	try {
		
		$stmt4 = $dbcon->prepare($sql4, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		//$stmt->execute(array($plan_id, $sub_id));
		$stmt4->execute(array($sub_id));
		$result4 = $stmt4->fetch(PDO::FETCH_ASSOC);	
		$subPendingCount = $result4['count'];
		$agent=$result4['agent_id'];
		$stmt4 = null;
		
		//echo $sub_id."--".$subPendingCount;
				
		if($subPendingCount > 0)
			echo $agent;
		else
			echo "0";		
		
	}catch (PDOException $e){
		print $e->getMessage();
	}
	exit;
		break;


	case "setStreamStatus":


		
		//$file=fopen("chan_status.txt","a");

			echo $id=$_REQUEST['id'];
			echo $channel_id=$_REQUEST['channel_id'];
				//echo $channel_name=$_REQUEST['channel_name'];
			echo $status=$_REQUEST['status'];


			
			
			//insert/update into db

			if($id=="")
		{
		echo "id:".$id=0;
		$channel=get_var("SELECT channel_name from channel_stream_status where channel_id=".$channel_id." ");
		}
		if($channel_id=="")
		{echo "chan:".$channel_id=0;
		$channel=get_var("SELECT channel_name from channel_stream_status where id=".$id." ");
		}


		echo $exist_status=get_var("SELECT status from channel_stream_status where id=".$id." or channel_id=".$channel_id." limit 1");


		if($status!=$exist_status)
		{
		$url1="http://ideabytestraining.com/newqezyplay/qp1/check_stream";
		$url2="http://ideabytestraining.com/newqezyplay/qp1/channel_streaming_status";

			//fwrite($file,$id.$channel_id.$status.$sql5);
			
			$sql5="UPDATE channel_stream_status SET status=".$status." where id=".$id." or channel_id=".$channel_id." ";
			$stmt5 = $dbcon->prepare($sql5, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt5->execute();
			


			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: Admin-QezyPlay <admin@qezyplay.com>' . "\r\n";
			//fwrite($file,$id.$channel_id.$status.$sql5);

			if($status==0)
			{
			mail("siddish.gollapelli@ideabytes.com","$channel-Streaming error",print_r("There is an error with $channel streaming, please check @ $url1 and change @ $url2",true),$headers);

			mail("gourab.mohanty@ideabytes.com","$channel-Streaming error",print_r("There is an error with $channel streaming, please check @ $url1 and change @ $url2",true),$headers);

			mail("azhar.mohiuddin@ideabytes.com","$channel-Streaming error",print_r("There is an error with $channel streaming, please check @ $url1 and change @ $url2",true),$headers);
			echo "mail sent";
			//fwrite($file,"o if");
			}
			else if($status==1)
			{
			//mail("siddish.gollapelli@ideabytes.com","$id activated $channel_name",print_r("$id activated $channel_id, please check",true));
			echo "Activated";
			//fwrite($file,"1 if");
			}
		}
		exit;
		break;

	case "getStreamStatus":

		
		$id=$_REQUEST['id'];
		$channel_id=$_REQUEST['channel_id'];
				//echo $channel_name=$_REQUEST['channel_name'];
			//echo $status=$_REQUEST['status'];

		
		if($id=="")
		{
		$id=0;
		}
		if($channel_id=="")
		{$channel_id=0;}


		$sql6="SELECT status from channel_stream_status where id=".$id." or channel_id=".$channel_id." limit 1";
	
		$stmt6 = $dbcon->prepare($sql6, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		//$stmt->execute(array($plan_id, $sub_id));
		$stmt6->execute();
		$status= $stmt6->fetchColumn();	
		
		echo $status;

		exit;
		break;

	/*case "setOldStatus":

		$channel_id=$_REQUEST['channel_id'];
		$o_status=$_REQUEST['o_status'];

		$sql5="UPDATE channel_stream_status SET old_status=".$status." where id=".$id." or channel_id=".$channel_id." ";
			$stmt5 = $dbcon->prepare($sql5, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt5->execute();

		exit;
		break;*/
		


}
?>
