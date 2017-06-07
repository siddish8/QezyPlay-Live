<?php


include("function_common.php");


$action=$_REQUEST['action'];

include("db-config.php");
date_default_timezone_set("UTC");

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


// 	case "setStreamStatus":
		
// 			//$file=fopen("chan_status.txt","a");

// 			$id=$_REQUEST['id'];
// 			$channel_id=$_REQUEST['channel_id'];
// 				//echo $channel_name=$_REQUEST['channel_name'];
// 			$status=$_REQUEST['status'];
			
// 			//insert/update into db

// 			if($id==""){
// 				$id=0;
// 				$channel=get_var("SELECT channel_name from channel_stream_status where channel_id=".$channel_id." ");
// 				$cid=$channel_id;
// 			}

// 			if($channel_id==""){
// 				$channel_id=0;
// 				$channel=get_var("SELECT channel_name from channel_stream_status where id=".$id." ");
// 				$cid=$id;
// 			}

// 			echo $cid.":".$channel."\n Status: ".$status;
			
// 			$exist_status=get_var("SELECT status from channel_stream_status where id=".$id." or channel_id=".$channel_id." limit 1");
			
// 			if($status!=$exist_status){
// 				$url1="https://qezyplay.com/qp1/check-stream";
// 				$url2="https://qezyplay.com/qp1/channel-streaming-status";
// 				//fwrite($file,$id.$channel_id.$status.$sql5);
// 				$sql5="UPDATE channel_stream_status SET status=".$status." where id=".$id." or channel_id=".$channel_id." ";
// 				$stmt5 = $dbcon->prepare($sql5, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 				$stmt5->execute();

// 				$headers = "MIME-Version: 1.0" . "\r\n";
// 				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// 				$headers .= 'From: Admin-QezyPlay <admin@qezyplay.com>' . "\r\n";
// 				//fwrite($file,$id.$channel_id.$status.$sql5);

// 				$ppl="gourab.mohanty@ideabytes.com,azhar.mohiuddin@ideabytes.com,sreevalli.mogdumpuram@ideabytes.com,george.kongalath@ideabytes.com,srinivas.katta@ideabytes.com,Anna.anthony@ideabytes.com,mamun.a.bd@ideabytes.com,kiran.kumar@ideabytes.com,mstml@ideabytes.com,derek.chung@ideabytes.com";

// 				if($status==0){

// 					$body="<p>Hi,</p><p> Stream not available for the ".$channel." channel
// </p><p>Please check @ ".$url1."</p><br><p>Thanks<br>Admin - QezyPlay</p>";

// 					//mail("siddish.gollapelli@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
// 					// mail("gourab.mohanty@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
// 					// mail("azhar.mohiuddin@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
// 					// mail("sreevalli.mogdumpuram@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
// 					// mail("george.kongalath@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
// 					// mail("srinivas.katta@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
// 					mail($ppl,"$channel-Streaming error",print_r($body,true),$headers);

// 					echo "\n Inactive mail sent";
// 					//fwrite($file,"o if");
// 				}
// 				else if($status==1){

// 					$body="<p>Hi,</p><p>".$channel." streaming Activated</p><p>Please re-check @ ".$url1."</p><br><p>Thanks<br>Admin - QezyPlay</p>";

// 				//	mail("siddish.gollapelli@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
// 					// mail("gourab.mohanty@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
// 					// mail("azhar.mohiuddin@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
// 					// mail("sreevalli.mogdumpuram@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
// 					// mail("george.kongalath@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
// 					// mail("srinivas.katta@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
// 					mail($ppl,"$channel-Streaming Activated",print_r($body,true),$headers);
		
// 					echo "\n Activated Mail Sent";
// 					//fwrite($file,"1 if");
// 				}
// 			}

// 			exit;
// 			break;

case "setStreamStatus":
		
			//$file=fopen("chan_status.txt","a");

			$id=$_REQUEST['id'];
			$channel_id=$_REQUEST['channel_id'];
				//echo $channel_name=$_REQUEST['channel_name'];
			$status=$_REQUEST['status'];

			if(isset($_REQUEST['mail'])){
				
				$mail=$_REQUEST['mail'];
			}else{
				$mail=1;
			}

			$service_hittime=new DateTime();
			$service_hittime=$service_hittime->format('Y-m-d H:i:s');
			
			
			
			//insert/update into db
			$channel_name1=strtolower(preg_replace('/\s+/', '', $channel_id));

			if($id==""){
				$id=0;
				$channel=get_var("SELECT channel_name from channel_stream_status where channel_id='".$channel_id."' or LOWER(REPLACE(channel_name,' ',''))='".strtolower(preg_replace('/\s+/', '', $channel_id))."' or LOWER(REPLACE(channel_name,' ',''))='".$channel_name1."' ");
				$cid=$channel_id;
			}

			if($channel_id==""){
				$channel_id=0;
				$channel=get_var("SELECT channel_name from channel_stream_status where id=".$id." or channel_id='".$channel_id."' or LOWER(REPLACE(channel_name,' ',''))='".$channel_name."'");
				$cid=$id;
			}

			echo "Request: ".$cid.":".$channel."\n Status: ".$status."\n Mail: ".$mail;

			$channel_name=strtolower(preg_replace('/\s+/', '', $channel_id));

			//echo "SELECT status from channel_stream_status where id=".$id." or channel_id='".$channel_id."' or LOWER(REPLACE(channel_name,' ',''))='".$channel_name."' limit 1";
			
			$exist_status=get_var("SELECT status from channel_stream_status where id=".$id." or channel_id='".$channel_id."' or LOWER(REPLACE(channel_name,' ',''))='".$channel_name."'");
			
			echo "\n EXist Status:".$exist_status;

			if($status!=$exist_status){
				$url1="http://admin.qezyplay.com/qp1/check-stream";
				$url2="http://admin.qezyplay.com/qp1/channel-streaming-status";
				//fwrite($file,$id.$channel_id.$status.$sql5);
				$sql5="UPDATE channel_stream_status SET status=".$status.",service_hittime='".$service_hittime."' where id=".$id." or channel_id='".$channel_id."' or LOWER(REPLACE(channel_name,' ',''))='".$channel_name."' ";
				$stmt5 = $dbcon->prepare($sql5, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt5->execute();

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: Admin-QezyPlay <admin@qezyplay.com>' . "\r\n";
				//$headers .= 'Cc: test@test.com,rakesh.marka@ideabytes.com';
				
				//fwrite($file,$id.$channel_id.$status.$sql5);
				$ppl="siddishg@gmail.com,siddish.gollapelli@ideabytes.com";
				$ppl1="sreevalli.mogdumpuram@ideabytes.com,gourab.mohanty@ideabytes.com,azhar.mohiuddin@ideabytes.com";

				//echo $status;
				if($status==0){
					echo "\n Status changed to $status -Inactive";

					$body="<p>Hi,</p><p> Stream not available for the ".$channel." channel $channel_name
</p><p>Please check @ ".$url1."</p><br><p>Thanks<br>Admin - QezyPlay</p>";

					if($mail==1){

						//mail($ppl,"$channel-Streaming error",print_r($body,true),$headers);
						mail($ppl1,"$channel-Streaming error",print_r($body,true),$headers);

						echo "\n Inactive mail sent";

					}
					
					//mail($ppl,"$channel-Streaming error",print_r($body,true),$headers);
					// mail("gourab.mohanty@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
					// mail("azhar.mohiuddin@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
					// mail("sreevalli.mogdumpuram@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
					//mail("george.kongalath@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
					//mail("srinivas.katta@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);

					
					//fwrite($file,"o if");
				}
				else if($status==1){
					echo "\n Status changed to $status -Active";

					$body="<p>Hi,</p><p>".$channel." streaming Activated</p><p>Please re-check @ ".$url1."</p><br><p>Thanks<br>Admin - QezyPlay</p>";


					if($mail==1){
							//mail($ppl,"$channel-Streaming Activated",print_r($body,true),$headers);
							mail($ppl1,"$channel-Streaming Activated $channel_name",print_r($body,true),$headers);

							echo "\n Activated Mail Sent";
						

					}
					//mail("siddish.gollapelli@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
					//mail($ppl,"$channel-Streaming error",print_r($body,true),$headers);
					// mail("gourab.mohanty@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
					// mail("azhar.mohiuddin@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
					// mail("sreevalli.mogdumpuram@ideabytes.com","$channel-Streaming Activated",print_r($body,true),$headers);
					//mail("george.kongalath@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
					//mail("srinivas.katta@ideabytes.com","$channel-Streaming error",print_r($body,true),$headers);
		
					
					//fwrite($file,"1 if");
				}
				// else{
				// 	echo "No case";
				// }
			}else{
				//no status change,but update service hit time

				$sql5="UPDATE channel_stream_status SET service_hittime='".$service_hittime."' where id=".$id." or channel_id='".$channel_id."' or LOWER(REPLACE(channel_name,' ',''))='".$channel_name."' ";
				$stmt5 = $dbcon->prepare($sql5, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt5->execute();

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
		
		$a=array("status"=>$status);
		echo json_encode($a);

		exit;
		break;

	case "getPromoUserDetails":


		$pid=$_REQUEST['pid'];
		$pc=get_var("SELECT promocode from promocodes_vs_shows where id=".$pid."");

		$userdetails=get_all("SELECT * from promocodes_vs_users where promocode='".$pc."' order by id desc");


		$res="";

		if(count($userdetails)>0)
		{
			foreach($userdetails as $u)
			{

			$n = date("Y-m-d"); 
			$n=date_create($n);
			$s=$u['start_datetime'];
			$e=date_create($u['end_datetime']);
			//$s=date_create("2016-10-30");
		//	$e=date_create("2016-12-31");
			$x=date_diff($n,$e);
	//$interval = date_diff($datetime1, $datetime2);
	    
	   		//$delay=$x->format("%a");

				$delay=$x->format('%R%a');

				if($delay < 0)
 					{$delay=0;}
				else
				{$delay=$x->format('%a');}
				date_default_timezone_set('UTC');
				$start=new DateTime($u['start_datetime']);
				$start=$start->format('d-m-Y');

				$end=new DateTime($u['end_datetime']);
				$end=$end->format('d-m-Y');

			$un=get_var("SELECT user_login from wp_users where ID=".$u['user_id']."");
			$ph=get_var("SELECT phone from wp_users where ID=".$u['user_id']."");
			$user_ip=get_var('SELECT meta_value FROM wp_usermeta where meta_key="uultra_user_registered_ip" and user_id='.$u['user_id'].' ');

			if($user_ip!=""){
				
				$user_city=get_var('SELECT city FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_city=$user_city_arr['city'];
				$user_state=get_var('SELECT state FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_state=$user_state_arr['state'];
				$user_country=get_var('SELECT country FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_country=$user_country_arr['country'];

			}
			else{

				$user_ip="Not Detected";
				$user_city=$user_state=$user_country="-";
			}

			

			$res.="<tr><td>".$un."</td><td>".$ph."</td>
				<td>".$user_city."(".$user_state.",".$user_country.")</td><td>".$delay."</td><td>".$start." to ".$end."</td></tr>";
			}
		}
		else{

			$res.="<tr><td style='text-align:center' colspan='5'>No users</td></tr>";
		}
		
	echo $res;

	exit;
		break;

	case "getRequests":
		
		$sql=$_REQUEST['sql'];
		
		//$pc=get_var("SELECT promocode from promocodes_vs_shows where id=".$pid."");

		//$userdetails=get_all("SELECT * from promocodes_vs_users where promocode='".$pc."' order by id desc");


		$res="";

		$result4 = get_all($sql);
			
			if(count($result4)>0){

				foreach($result4 as $row){

				$id=$row['id'];
				$rqname = $row['rq_name'];
				$site=$row['site'];
				$rqdesc=$row['description'];
				$status = $row['status'];			
				
			
				$res.='
				<tr style="" class="ui-sortable-handle">	
				<td style="width: 200px;" class="level_name">'.$rqname.'</td>						
				<td style="width: 200px;" class="level_name">'.$site.'</td>				
				<td style="width: 300px;">'.$rqdesc.'</td>
				<td style="width: 185px;">'.$status.'</td>
				
				<td style="width: 100px;">
				<a style="cursor:pointer;color:blue;" id="editAR" name="editAR" onclick="return confirmEditAR('.$id.')"><em title="Edit" class="fa fa-pencil"></em></a>
				&nbsp;
				<a style="cursor:pointer;color:blue;" id="removeAR" name="removeAR" onclick="return confirmDelAR('.$id.')"><i title="Remove" class="fa fa-trash-o "></i></a>				
				</td>
			</tr>';
			 } 				
			
			}else{
				
				$res.='<tr style="text-align:center" class="ui-sortable-handle">	
				<td colspan="5" style="width: 200px;" class="level_name">No Requests</td>	
				</tr>';
			
			}
			 
		
	echo $res;

	
		break;

	case "upadteTMreqStatus":

		$req_id = $_POST['rq_id'];
		$status = $_POST['status'];

		//echo "UPDATE team_requests SET status='".$status."' WHERE id=".$req_id." ";
		execute("UPDATE team_requests SET status='".$status."' WHERE id=".$req_id." ");
		
		echo "Status Changed Successfully";


		break;
		

	 case "getState":

		$country_code = $_POST['country_code'];
		$stateInfo = "";
		$sql2 = "SELECT state FROM visitors_info WHERE country_code = '".$country_code."' GROUP BY state";	
		$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt2->execute();
		$states = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		if(count($states) > 0){
			foreach($states as $state){

				$stateInfo .= "<option value='".$state['state']."'>".$state['state']."</option>";
			}
		}
		$stmt2 = null;
		echo $stateInfo;
		break;

	    case "getCity":
		$state = $_POST['state'];
		$cityInfo = "";
		$sql2 = "SELECT city FROM visitors_info WHERE state = '".$state."' GROUP BY city";	
		$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt2->execute();
		$cities = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		if(count($cities) > 0){
			foreach($cities as $city){

				$cityInfo .= "<option value='".$city['city']."'>".$city['city']."</option>";
			}
		}
		$stmt2 = null;
		echo $cityInfo;
		break;
	    
	    

		case "userAnalytics":

		$user_id=$_REQUEST["user_id"];
		$res="";
		
		$datenow=date("Y-m-d");
		$datewkbck=$date = date('Y-m-d', strtotime('-1 week +1 day')); 
		$datewkbckcal=$date = date('Y-m-d', strtotime('-1 week'));

		//if($_REQUEST['startdate'] != ""){
		$cond .= " AND DATE(CONVERT_TZ(start_datetime,'+00:00','".$coockie."')) >= '".$datewkbck."'";
		$startdate = $datewkbck;		
		//}
		//if($_REQUEST['enddate'] != ""){
		$cond .= " AND DATE(CONVERT_TZ(end_datetime,'+00:00','".$coockie."')) <= '".$datenow."'";
		$enddate = $datenow;		
		//}

		//$channelId = $_SESSION['channelid'];
		//$cond .= " AND page_id = ".$channelId;

		$cond .= "AND user_id = ".$user_id;

		//Analytics
		$sql1 = "SELECT count(*) as count,date(CONVERT_TZ(start_datetime,'+00:00','".$coockie."')) as date FROM visitors_info WHERE 1".$cond." GROUP BY date(CONVERT_TZ(start_datetime,'+00:00','".$coockie."'))";	
		$hits = get_all($sql1);

		$sql2 = "SELECT sum(duration) as duration,date(CONVERT_TZ(start_datetime,'+00:00','".$coockie."')) as date FROM visitors_info WHERE 1 AND duration > 0 AND play = 1".$cond." GROUP BY date(CONVERT_TZ(start_datetime,'+00:00','".$coockie."'))";	
		$durations = get_all($sql2);


		$chcond=" AND page_id in (SELECT id from channels)";

		//Channels List
		$sql3 = "SELECT count(*) as hits,page_id,page_name as name,sum(duration) as duration FROM visitors_info WHERE 1".$cond.$chcond." GROUP BY user_id,page_id order by hits desc, duration desc";	
		$channels = get_all($sql3);
		
		$channels_list="";

		if(!empty($channels)){

			$channels_list.="<thead>
													<tr>
                                                    	<th>Channel</th>
                                                     	<th>Hits</th>
                                                        <th>Duration</th>
													</tr>
												</thead>
												<tbody>";

			foreach($channels as $channel){
				$dur=min_hr($channel['duration']);
				$channels_list.="<tr>
								<td>".strtoupper($channel['name'])."</td>
								<td>".$channel['hits']."</td>
								<td>".$dur[0]."(".$dur[1].")</td>
								</tr>";
			}

			$channels_list.="</tbody>";

		}else{

			$channels_list.="<tbody><tr><td colspan='3'>No channels found</td></tr></tbody>";

		}
		

		//Location List
		$sql4 = "SELECT count(*) as count,ip_address,city,state,country FROM visitors_info WHERE 1".$cond." GROUP BY user_id,ip_address";	
		$locations = get_all($sql4);
		$locations_list="";

			if(!empty($locations)){
				$locations_list.="<thead>
													<tr>
														<th>IP</th>
                                                    	<th>City</th>
                                                     	<th>Country</th>
                                                    </tr>
												</thead>
												<tbody>";
				foreach($locations as $location){
				
				$locations_list.="<tr>
								<td>".$location['ip_address']."</td>
								<td>".$location['city']."</td>
								<td>".$location['country']."</td>
								</tr>";
			}
			$locations_list.="</tbody>";
		}else{

			$locations_list.="<tbody><tr><td colspan='3'>No locations found</td></tr></tbody>";

		}
		

		$res.='
		
		<section class="section">
						<div class="row">
						<h2 style="text-align:center">Last Week - User Analytics</h2>
						<h4 style="text-align:center"><span class="text-primary">
							From: '.$datewkbck.' - '.$datenow.'
					</span></h4>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
             Statistics for page hits
            </h3> </div>
                                        <section class="example">
                                            <div id="hitschart"></div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
              Statistics for video played duration
            </h3> </div>
                                        <section class="example">
                                            <div id="durationchart"></div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row">
						
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
             Channels Info
            </h3> </div>
                                        <section class="example">
                                            <div id="channels_list" class="table-responsive" align="center">
											<table>
												
											'.$channels_list.'
												
											</table>
											</div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
              Location Info
            </h3> </div>
                                        <section class="example">
                                            <div id="locations_list" class="table-responsive" align="center">
											<table>
												
											'.$locations_list.'
												
											</table>
											</div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </section>
		';

		if(count($hits) > 0){ 

			$hitsdata = "";
			foreach($hits as $hit){
				$hitsdata .= '{date:"'.$hit["date"].'",value:"'.$hit["count"].'"},';				
			}
			$hitsdata = substr($hitsdata,0,(strlen($hitsdata) - 1));

			$res.="<script>	
			new Morris.Line({
				element:'hitschart',
				data:[".$hitsdata."],
				 events: ['".$datewkbck."'],
    				eventStrokeWidth: 0,
   				 resize: true,
				xkey:['date'],
				ykeys:['value'],
				labels:['Hits'],
				xLabels: ['day'],
				/*xLabelMargin: 10,
				xLabelAngle:90,*/
				xLabelFormat: function(d) {
    return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
	
				}
			});
			</script>";
		
		}else{ 
			
			$res.="<script>document.getElementById('hitschart').innerHTML = 'No analytics found';</script>"; 
			} 

		if(count($durations) > 0){ 

			$durationsdata = "";
			foreach($durations as $duration){
				$playedduration = $duration['duration'] / 60;
				$playedduration=round($playedduration, 1, PHP_ROUND_HALF_DOWN); //added	
				$durationsdata .= '{date:"'.$duration["date"].'",value:"'.$playedduration.'"},';		
			}
			$durationsdata = substr($durationsdata,0,(strlen($durationsdata) - 1));

		$res.="<script>	
			new Morris.Line({
				element:'durationchart',
				data:[".$durationsdata."],
				 events: ['".$datewkbck."'],
    				eventStrokeWidth: 0,
   				 resize: true,
				xkey:['date'],
				ykeys:['value'],
				labels:['Duration(in minutes)'],
				xLabels: ['day'],
				/*xLabelMargin: 10,
				xLabelAngle:90,*/
				xLabelFormat: function(d) {
    return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();}
			});
			</script>";	
		}else{
			$res.="<script>document.getElementById('durationchart').innerHTML = 'No analytics found';</script>";
			} 

		echo $res;

		break;

		case "getUserNames":

			$alpha=$_REQUEST['alpha'];
			if($alpha!=""){

				$cond=" AND user_login like '".$alpha."%' ";
				$sql="SELECT user_login from wp_users where 1".$cond;
				$un=get_all($sql);
				if(count($un)>0){

					echo json_encode($un);

				}else{

					echo json_encode(array(array("user_login"=>"No users found")));
				}

				
			}

		default:
		break;
}
?>
