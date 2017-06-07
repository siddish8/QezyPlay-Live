<?php 
	include('header.php');
?>
<style>


</style>

<article class="content items-list-page">
<h2></h2>
    <?php
global $users;

if($_SESSION['adminlevel']>0)
{
//header("Location:".SITE_URL."/qp/admin-main.php");
//exit;
}


						if(isset($_POST['push'])){

							$app = $_POST['apps'];
							$message = $_POST['message'];
							$sync = $_POST['sync'];
							$userok = $_POST['userok'];
							
							if($sync==""){
								$sync=0;
							}
							if($userok==""){
								$userok=0;
							}

							if($message=="" and $sync!=1){
								$msg = "Message is Empty and Data-Sync also Not Set";
							}else{

								if($sync==1 and $message==""){
									$message="datasync";
								}

								if($app==1){

									$ios_resp=push_ios($message,$sync,$userok)."<br><br><br>";

								}else if($app==2){

									$android_resp=push_android($message,$sync,$userok)."<br><br><br>";

								}else if($app==3){

									$ios_resp=push_ios($message,$sync)."<br><br><br>";
									$android_resp=push_android($message,$sync,$userok)."<br><br><br>";

								}
							
							
							}			

							
						}

						/*if(isset($_POST['preview'])){

							$subject = $_POST['subject'];
							$regards = $_POST['regards'];
							if($regards==""){
								$regards = "<p>Regards, <br>QezyPlay Team</p>";
							}
							$body = $_POST['body'];
							$users = $_POST['users'];
							$salute = $_POST['salutation'];
							$saluteF = $_POST['salutationF'];
							$txt="";
							if($users==1){
								echo $rSU;
								$res=$resSU;
								$txt.="Subscribed: ";
							}else if($users==2){
								$res=$resUS;
								$txt.="Unsubscribed: ";
							}else if($users==3){
								$res=$resAll;
								$txt.="All Users: ";
							}

							
							foreach($res as $r){

								$em=$r['user_email'];
								$un=$r['user_login'];
								$un=ucfirst($un); //added

								$body0="<p>$salute $un $saluteF,</p>";
								$txt.="<p>$em <br> $un</p>";
							}

							$users_list = $txt."<br><br><br>";
							$preview = $subject."<br><br>".$body0."<br>".$body."<br>".$regards."<br><br><br>";

						}*/
	
						
?>
<section class="section">
<span style="float:"></span><div class="msg" align="center" style="display:inline-block"><h4><?php echo $msg;?></h4></div>
                        <div class="row sameheight-container">
				 <div class="col-md-3">
                             
			
                            </div>
                            <div class="col-md-6">
                                <div id="boq-form-section" class="card card-block sameheight-item" style="height:auto !important;/*height: 721px;*/">
                                   <div class="card card-primary">
					<div class="card-header">
                                        <div class="header-block">
                                            <p class="title"> Push Notification </p>
											<p>
											<sub>For the latest updates on App versions.<br>
											Message: Latest version is available<br>
											User Interaction : Tick
											</sub>
											</p>
                                        </div>
                                    </div>
				     <div class="xoouserultra-field-value" style="">
						<div id='error' style='color:red;'></div>
					</div>
					<div class="card-block">
                                    <form role="form" method='post' enctype="multipart/form-data">
									<div class="form-group"> <label class="control-label">Apps</label> 
					
									<select name="apps" alt="" id="apps" onclick="clearError()" class="form-control underlined">
									
									<option value="">-Select Apps-</option>
									<option value="1" >Push iOS</option>
									<option value="2" >Push Android</option>
									<option value="3" >Push All (Both ios&android)</option>
									</select>
					</div>	
										<div class="form-group"> <label class="control-label">Message</label><input placeholder="Ex: Qezyplay Update" onkeyup="return checkMsg();" class="form-control underlined" type="text" onclick="clearError()" name="message" id="message" value="">
					</div>            
								<!--<div class="form-group"> <label class="control-label">Data Sync</label> 
					
									<select name="sync" alt="" id="sync" onclick="clearError()" class="form-control underlined">
									
									<option value="">-Data-Sync Selection (Y/N)-</option>
									<option value="1" >Yes</option>
									<option value="0" >No</option>
									</select>
					</div>	-->
					<div class="form-group"> <input disabled="false" type="checkbox" name="userok" id="userok" value="">&nbsp;<label class="control-label">User Interaction(with message only)</label> 
						</div>

					<div class="form-group"> <input type="checkbox" name="sync" id="sync" value="">&nbsp;<label class="control-label">Data Sync</label> 
						</div>	
							
						
					<!--<div class="form-group"> <label class="control-label">User Interaction</label> 
					
									<select name="toast" alt="" id="toast" onclick="clearError()" class="form-control underlined">
									
									<option value="">-User-Interaction(Alert OK) (Y/N)-</option>
									<option value="1" >Yes</option>
									<option value="0" >No</option>
									</select>
					</div>-->	
					                  			
                                        
					<div class="xoouserultra-field-value" style="padding-left: 10px;">
								
								<input class="btn btn-primary" type="submit" onclick="return callsubmit();" name="push"  value="Push" />
								
					</div>
							
	
                                    </form>
				</div>
				</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                             
                            </div>
                        </div>
                    </section>
					<section>
					<div class="col-md-6">
                              <?php echo $ios_resp; ?>
                            </div>
							<div class="col-md-6">
                             <?php echo $android_resp ?>
                            </div>
					
					
					</section>
<script>
function checkMsg(){
	var msg=jQuery("#message").val();
	if(msg != ""){
	jQuery("#userok").prop('disabled', false);
	}else{
		jQuery("#userok").prop('disabled', true);
		jQuery("#userok").prop('checked', false);
	}
}

function callsubmit(){	

	var apps = jQuery("#apps").val();
	var message = jQuery("#message").val();
	
	var sync=jQuery("#sync").is(':checked');
	if(sync==true){
		jQuery("#sync").val("1");
		sync=1;
	}else{
		jQuery("#sync").val("0");
		sync=0;
	}

	var userok=jQuery("#userok").is(':checked');

	if(userok==true){
		jQuery("#userok").val("1");
		userok=1;
	}else{
		jQuery("#userok").val("0");
		userok=0;
	}

	if(apps == ""){
		jQuery("#error").html("Please select apps -ios/android/both");return false;
	}

	/*if(message == "" && sync != 1 ){
		jQuery("#error").html("Please enter a message or tick data-sync");return false;		
	}else if(message == "" && userok == 1){
		jQuery("#error").html("Please enter a message or untick user-interaction");return false;
	}else{
		return false;
	}*/
	if(userok=="0"){

		if(message == "" && sync != 1 ){
		jQuery("#error").html("Please enter a message or tick data-sync");return false;		
		}
		else{
			return true;
		}
	}else{

		if(message == ""){
		jQuery("#error").html("Please enter a message or untick user-interaction or tick only data-sync");return false;
		}else{
		return true;
		}

	}

	return true;
	
	var customerid = jQuery("#customerid").val();
	var email = jQuery("#email").val();
	var customername = jQuery("#customername").val();
	var phone = jQuery("#phone").val();
	var logo = jQuery("#logofile").val();
	var channel = jQuery("#channel").val();


	if(customername == ""){
		jQuery("#error").html("Please enter Broadcaster name");return false;		
	}
	
			
	if(phone == ""){
		jQuery("#error").html("Please enter phone no");
		return false;		
	}else if (!validatePhone(phone)) {

		jQuery("#error").html("Please enter valid phone no");
		return false;
			
			}


	 if(email == ""){
		jQuery("#error").html("Please enter email address");	
		return false;	
	}else if (!validateEmail(email)) {
		jQuery("#error").html("Please enter valid email address");
		return false;	
	}

	 if(logo == "" && customerid == ""){
		jQuery("#error").html("Please select logo file");	return false;		
	}

	 if(channel == ""){
		jQuery("#error").html("Please choose channel");		return false;	
	}

	if(customername != "" && phone != "" && email != "" && (logo != "" || customerid != "") && channel != ""){
		if (validateEmail(email)) {
			if (validatePhone(phone)) {
				return true;
			
			} else {
				jQuery("#error").html("Please enter valid phone no");
			}
			
		} else {
			jQuery("#error").html("Please enter valid email address");
		}
	}
	return false;
}





		function clearError()
		{

		jQuery("#error").html("");
		jQuery(".msg h4").html("");		
	
		}


</script>

<?php

function push_ios($message,$sync,$alertButton){

	$resp="<h2>iOS Response</h2>".$message."<br>";
	$result="";

	$sql = "SELECT device_id FROM user_notify_devices WHERE app = 1";	

	$devices=get_all($sql);
	foreach($devices as $device){

		$registration_ids[] = $device['device_id'];	
	}	

	// set time limit to zero in order to avoid timeout
	set_time_limit(0);
	
	// charset header for output
	header('content-type: text/html; charset: utf-8');
	
	// this is the pass phrase you defined when creating the key
	$passphrase = 'ideabytes';
	$ioscert = 'pushcert.pem';
	$apple_ssl_link = 'ssl://gateway.sandbox.push.apple.com:2195';//dev
	//$apple_ssl_link = 'ssl://gateway.push.apple.com:2195';//live
	
	// you can post a variable to this string or edit the message here

	// tr_to_utf function needed to fix the Turkish characters
	//$message = tr_to_utf($_POST['msg']);
	$message = tr_to_utf($message);
	
	// load your device ids to an array
	/*$deviceIds = array(
	'edcd2e7cf6a5c3150a05f97b0aebd2b2994a52fcf80580f785476a588e0c8625',
	'02312470da3fc34c337d8c8b10222f7fd71fe7f84e289c9ad61bd554b70d581a'
	);*/
	
	// this is where you can customize your notification
	$payload = '{"aps":{"alert":"' . $message . '","sound":"default","content-available":"'.$sync.'","alertButton":"'.$alertButton.'","sync":"'.$sync.'"}}';
	
	//$result = 'Start' . '<br />';
	
	////////////////////////////////////////////////////////////////////////////////
	// start to create connection
	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', $ioscert);
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
	
	//echo count($registration_ids) . ' devices will receive notifications.<br />';
	if(count($registration_ids)>0){

			foreach ($registration_ids as $item) {
			// wait for some time
			sleep(1);
			
			// Open a connection to the APNS server
			$fp = stream_socket_client($apple_ssl_link, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
		
			if (!$fp) {
				//exit("Failed to connect: $err $errstr" . '<br />');
				$resp.="Failed to connect: $err $errstr" . '<br />';
			} else {
				$resp.='Apple service is online. ' . '<br />';
			}
		
			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $item) . pack('n', strlen($payload)) . $payload;
			
			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));
			
			if (!$result) {
				$resp.='Undelivered message to: ' . $item . '<br />';
			} else {
				$resp.='Delivered message to: ' . $item . '<br />';
			}
		
			if ($fp) {
				fclose($fp);
				$resp.='The connection has been closed by the client' . '<br />';
			}
		}

		$resp.=count($registration_ids) . ' devices have received notifications.<br />';

		return $resp;	

	}else{

		$resp.="No devices registerd with Qezy". '<br />';	
		return $resp;		

	}

		
	
	// function for fixing Turkish characters

	
	// set time limit back to a normal value
	set_time_limit(30);

	
}

function push_android($message,$sync,$alertButton){

	$resp="<h2>Android Response</h2>Message:".$message."<br>";
	$result="";

	$sql = "SELECT device_id FROM user_notify_devices WHERE app = 2";	

	$devices=get_all($sql);
	foreach($devices as $device){

		$registration_ids[] = $device['device_id'];	
	}	
	
	
	//$registration_ids = array();
	//$registration_ids[0]="f8-RQk_dAcs:APA91bGYqia6S-fRUJlTx_nd63yrPnJ9NC1MLxAMLaqsjzh-yBevlfR4tO5ht3kW5VOkZChECl7O4gALAMwZmLnXwMREUE4x3JsIwj7dqrO5dstLVNGCWcFGZb8cySnbhYXmcBefOHmD";
	//$registration_ids[1]="dogPKlPScp4:APA91bEKKgpGCY1rUdeIj0CFD40ty517fb9ohLfObJwQTPNYx4V2G7thSKa47FKGs17h6p2McfwKdUbC3nUlbw3DtcfmrYwHBgLfJG4jsslNX5A9Q0ULEQFDg4MXNQFWxSnAT_8_ReFc";
   
	if($registration_ids!=""){
		
		$url ='https://fcm.googleapis.com/fcm/send';
	   
		// $message = array("Notice" => $_POST['message']);
		$message = array("notice" => $message,"sync" => $sync, "alertButton" => $alertButton);
		$fields = array(
		 'registration_ids' => $registration_ids,
		 'data' => $message,
		);

		$headers = array(
		 'Authorization: key=AIzaSyD-gAVf2QlVsGMbFQAtrmKLCtB66QPpXvM',
		 'Content-Type: application/json'
		);
		// Open connection
		$ch = curl_init();

		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) {
		 //die('Curl failed: ' . curl_error($ch));
		 $resp.="FCM reach failed"."<br>";

		}else{
			$resp.="FCM reached"."<br>";
		}

		// Close connection
		curl_close($ch);
		
		$res_obj=json_decode($result);
		$res="";
		$res.="Success device:".$res_obj->success."<br>";
		$res.="Failure devices:".$res_obj->failure."<br>";
		$res.="Result:".$res_obj->result."<br>";
		return $resp.$res;	
		
	}
	else{
		$resp.="No devices registerd with Qezy";
		return $resp.$result;	
	}
	
}

function tr_to_utf($text) {
    $text = trim($text);
    $search = array('Ü', 'Þ', 'Ð', 'Ç', 'Ý', 'Ö', 'ü', 'þ', 'ð', 'ç', 'ý', 'ö');
    $replace = array('Ãœ', 'Åž', '&#286;ž', 'Ã‡', 'Ä°', 'Ã–', 'Ã¼', 'ÅŸ', 'ÄŸ', 'Ã§', 'Ä±', 'Ã¶');
    $new_text = str_replace($search, $replace, $text);
    return $new_text;
}

include('footer.php');
?>
