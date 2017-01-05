<?php 
include('header.php');
?>
<article class="content items-list-page">

<?php
$msg = ""; $action = "Add";

if(isset($_REQUEST['delShpc'])){

	$id = $_REQUEST['delShpcid'];


	$stmt11 = $dbcon->prepare("DELETE FROM promocodes_vs_shows WHERE id = ".$id."", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt11->execute();

	$stmt22 = $dbcon->prepare("DELETE FROM pc_vs_shows_timing_info WHERE promo_shows_id = ".$id."", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt22->execute();

	$msg = "<span id='msg' style='color:green'>Deleted Successfully</span>";
	
}


if(isset($_POST['Add_Submit'])){
	
	$promocode=trim($_POST['promocode']);
	$channel=trim($_POST['channel']);
	$progname=trim($_POST['programname']);
	$actors=trim($_POST['actors']);
	$desc=trim($_POST['channel_desc']);
		
	$number=trim($_POST['number']);

	
	$timing="";
	for($i=1;$i<=$number;$i++)
		{
			$timing.=$_POST['day-'.$i]."-".$_POST['time-'.$i].",";
		}
	$timing=rtrim($timing,',');
	
	$date = gmdate("Y-m-d H:i:s");
	
	$stmt21 = $dbcon->prepare('SELECT * FROM promocodes_vs_shows WHERE channel = "'.$channel.'" AND programname = "'.$progname.'" ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
	$stmt21->execute();
	$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
	$shpcexist = count($result21);	
//echo $userexit;	
//exit;
	if((int)$shpcexist > 0){

		$msg1="";
		

		
			$msg1.= "<i class='fa fa-arrow-right' aria-hidden='true'></i>This info already exist <br>";

			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
		
	}else{	
		//echo "NEW";
		if ($_FILES["logofile"]["error"] > 0){
			$msg = "<span style='color:red'>Problem with Program logo1. Please try again.</span>";
		}else{	
				
			$present_time = date("dmYHis");
			$file_name = $_FILES["logofile"]["name"];
			$image_extention = explode("/",$_FILES["logofile"]["type"]);
			//$sNewFileName = $present_time.".".$image_extention[1];
				$sNewFileName = $file_name;
				
									
			if(move_uploaded_file($_FILES["logofile"]["tmp_name"],MEDIA_FOLDER."/".$sNewFileName)){			
		
		$stmt210 = $dbcon->prepare('INSERT INTO promo_codes(bouquet_id,plan_id,pay_amount,coupon_code,added_datetime) VALUES("4","4","0.00","'.$promocode.'","'.$date.'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt210->execute();


			
		$stmt22 = $dbcon->prepare('INSERT INTO promocodes_vs_shows(promocode,channel,programname,program_logo_url,actors,description,created_datetime) VALUES("'.$promocode.'","'.$channel.'","'.$progname.'","'.MEDIA_FOLDER_LINK.'/'.$sNewFileName.'","'.$actors.'","'.$desc.'","'.$date.'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt22->execute();
		$shpc_id = $dbcon->lastInsertId();

		$timingsArray =explode(',',$timing); //added
		foreach($timingsArray as $timesAr)
		{
			$timeAr=explode('-',$timesAr);
			
			$stmt23 = $dbcon->prepare('INSERT INTO pc_vs_shows_timing_info(promo_shows_id,day,time) VALUES("'.$shpc_id.'","'.$timeAr[0].'","'.$timeAr[1].'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt23->execute();
		}

		$msg = "<span style='color:green'>Info added Successfully</span>";
					
	} else{					
				$msg = "<span style='color:red'>Problem with Program logo2. Please try again.</span>";
			}
			
		}			
	}
}


if(isset($_POST['Edit_Submit'])){

	$shpcid=trim($_POST['shpcid']);

	
	$channel=trim($_POST['channel']);
	$progname=trim($_POST['programname']);
	$actors=trim($_POST['actors']);
		
	$number=trim($_POST['number']);

	
	$timing="";
	for($i=1;$i<=$number;$i++)
		{
			$timing.=$_POST['day-'.$i]."-".$_POST['time-'.$i].",";
		}
	$timing=rtrim($timing,',');
	
	$date = gmdate("Y-m-d H:i:s");
	
	$stmt21 = $dbcon->prepare('SELECT * FROM promocodes_vs_shows WHERE WHERE id != '.$shpcid.' AND (channel = "'.$channel.'" AND programname = "'.$progname.'") ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
	$stmt21->execute();
	$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
	$shpcexist = count($result21);	
//echo $userexit;	
//exit;
	if((int)$shpcexist > 0){

		$msg1="";
		

		
			$msg1.= "<i class='fa fa-arrow-right' aria-hidden='true'></i> This info already exist <br>";

			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
		
	}else{
		if ($_FILES["logofile"]["error"] > 0 && $_FILES["logofile"]["error"] != "4"){
			$msg = "<span style='color:red'>Problem with Program logo3. Please try again.</span>";
		}else{	

			if($_FILES["logofile"]["name"] !=""){

				$select_q_content = "SELECT * FROM promocodes_vs_shows WHERE `id` = :id";
				$select_query = $dbcon->prepare($select_q_content);
				$select_query->bindParam(":id",$shpcid);
				$select_query->execute();
				if($select_query->rowCount() > 0){
					$cData = $select_query->fetch(PDO::FETCH_ASSOC);

					if($cData["program_logo_url"]!=""){
						$req_image_path = MEDIA_FOLDER."/".$cData["program_logo_url"];
						if (file_exists($req_image_path)){
							unlink($req_image_path);
						}
					}		
				}
				
				$present_time = date("dmYHis");
			$file_name = $_FILES["logofile"]["name"];
			$image_extention = explode("/",$_FILES["logofile"]["type"]);
			//$sNewFileName = $present_time.".".$image_extention[1];
				$sNewFileName = $file_name;
				
									
			if(move_uploaded_file($_FILES["logofile"]["tmp_name"],MEDIA_FOLDER."/".$sNewFileName)){	

					//update query
					$stmt22 = $dbcon->prepare('UPDATE promocodes_vs_shows SET channel = "'.$channel.'", programname = "'.$progname.'", genre = "'.$genre.'", program_logo_url = "'.MEDIA_FOLDER_LINK.'/'.$sNewFileName.'", created_datetime = "'.$date.'" WHERE id = '.$shpcid, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	 
					$stmt22->execute();


					$stmt24 = $dbcon->prepare('DELETE FROM pc_vs_shows_timing_info WHERE promo_shows_id = '.$shpcid.'', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt24->execute();
		
		$timingsArray =explode(',',$timing); //added
		foreach($timingsArray as $timesAr)
		{
			$timeAr=explode('-',$timesAr);
			
			$stmt23 = $dbcon->prepare('INSERT INTO pc_vs_shows_timing_info(promo_shows_id,day,time) VALUES("'.$shpcid.'","'.$timeAr[0].'","'.$timeAr[1].'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt23->execute();
		}

					$msg = "<span style='color:green'>Info updated Successfully</span>";

				} else{					
					$msg = "<span style='color:red'>Problem with program logo4. Please try again.</span>";
				}

			}else{

				//update query
		$stmt22 = $dbcon->prepare('UPDATE promocodes_vs_shows SET channel = "'.$channel.'", programname = "'.$progname.'", genre = "'.$genre.'",created_datetime = "'.$date.'" WHERE id = '.$shpcid, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	 
		$stmt22->execute();
		
		$stmt24 = $dbcon->prepare('DELETE FROM pc_vs_shows_timing_info WHERE promo_shows_id = '.$shpcid.'', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt24->execute();
		
		$timingsArray =explode(',',$timing); //added
		foreach($timingsArray as $timesAr)
		{
			$timeAr=explode('-',$timesAr);
			
			$stmt23 = $dbcon->prepare('INSERT INTO pc_vs_shows_timing_info(promo_shows_id,day,time) VALUES("'.$shpcid.'","'.$timeAr[0].'","'.$timeAr[1].'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt23->execute();
		}
		$msg = "<span style='color:green'>Info updated Successfully</span>";
								
	}		
	
	}	
}

}
if(isset($_REQUEST['editShpc'])){

	$id = $_REQUEST['editShpcid'];		

//echo $id;
//exit;
	$stmt1 = $dbcon->prepare("SELECT * FROM promocodes_vs_shows where id='".$id."'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt1->execute();
	$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	foreach($result1 as $row1){
		$shpcid1=$id;
		$channel1=$row1['channel'];
		$progname1=$row1['programname'];
		$actors1=$row1['actors'];
		$logo1=$row1['program_logo_url'];
	}

	$stmt2 = $dbcon->prepare("SELECT group_concat(concat(day,'-',time)) as timing FROM pc_vs_shows_timing_info where promo_shows_id='".$id."'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
	$stmt2->execute();
	$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	$timing1 = $result2['timing'];
	$times=explode(',', $timing1);
	$no_times=sizeof($times);
	//$location1 = "AA-BB-CC,DD-EE-FF,";
	//echo $no_locs=sizeof($locs);

		
			
	$action = "Edit";

}	

?>

<style>
.xoouserultra-field-value, .xoouserultra-field-type{
	width: unset !important;
	padding: 5px;
}

form[name="f_timezone"] {
    display: none;
}

#search_shpc > input[type="text"] {
    max-width: 250px;
}

.link_btn:hover{
    background: #000;
    color: #fff;
    border: solid 1px #000;
}

.link_btn:visited{color:white !important}
.link_btn{
    border-radius: 3px;
    line-height: 2.75;
    text-align: center;
    margin: 5px;
    padding: 6.5px 25px;
    outline: none;
    background: #4141a0;
    border: solid 1px #4141a0;
    color: #fff;
    transition: all .2s ease;
    text-decoration:none;
	border-radius:5px;
}
</style>
<h2 style="text-align:center"></h2>
<?php		if($_SESSION['adminlevel']<=1)
{ 


if ($action=="Edit"){ echo "<style>#add_shpc_btn{display:none} #shpc-form-section{display:block !important;}</style>";}
?>	
<section class="section">
<span style="float:"></span><div class="msg" align="center" style="display:inline-block"><h4><?php echo $msg;?></h4></div>
                        <div class="row sameheight-container">
				 <div class="col-md-3">
                             
				<button id="add_shpc_btn" class="btn btn-primary" onclick="return shpc_form()">Add New Show-promocode</button>

                            </div>
                            <div class="col-md-6">
                                <div id="shpc-form-section" class="card card-block sameheight-item" style="display:none;height:auto;/*height: 721px;*/">
                                   <div class="card card-primary">
					<div class="card-header">
                                        <div class="header-block">
                                            <p class="title"> <?php echo $action; ?> Show-Promocode </p>
                                        </div>
                                    </div>
				     <div class="xoouserultra-field-value" style="">
						<div id='error' style='color:red;'";></div>
					</div>
					<div class="card-block">
                                    <form role="form" method='post' enctype="multipart/form-data">
					<input type="hidden" id="shpcid" name="shpcid" value="<?php echo $id; ?>"/>
                                       <!-- <div class="form-group"> <label class="control-label">Channel Name</label> <input onclick="clearError()" type="text" value="<?php echo @$channel1;?>" id="channel" name="channel" class="form-control underlined"> </div> -->

					
					<div class="form-group"> <label class="control-label">Program Name</label> <input onclick="clearError()" type="text" value="<?php echo @$progname1;?>" id="programname" name="programname" class="form-control underlined"> </div>


					<div class="form-group"> <label class="control-label">Channel</label> <select name="channel" alt="" id="channel" onclick="clearError()" class="form-control underlined">
									<option value="">-Select channel-</option>
									<?php
									$stmt5 = $dbcon->prepare("SELECT ID,post_title FROM `wp_posts` WHERE post_status = 'publish' and post_type = 'post'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
									$stmt5->execute();
									$result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

									foreach($result5 as $row){
										$selected = ($row['ID'] == $channel1) ? "selected='selected'" : "";
										echo "<option value='".$row['ID']."'".$selected.">".$row['post_title']."</option>";
									}
									?>
								</select> </div>	

					<div class="form-group"> <label class="control-label">Promo Code</label> <input onclick="clearError()" type="text" value="<?php echo @$promocode1;?>" id="promocode" name="promocode" class="form-control underlined"> </div>



					<div class="form-group"> <label class="control-label">Logo (path)</label> 
					<?php if($logo1 !="" ) { echo '<img src="'.@$logo1.'" style="height:100px;width:200px;">'; } ?>
					<input onclick="clearError()" type="file" accept="image/*" id="logofile" name="logofile" class="form-control underlined"> </div>

					<div class="form-group"> <label class="control-label">Show-Channel Description<sup>max:78char</sup></label> <textarea onclick="clearError()" onkeyup="return countChar()" maxlength="78" rows="3" cols="15" value="<?php echo @$desc1;?>" placeholder="Ex: This channel is top E-language" id="channel_desc" name="channel_desc" class="form-control underlined"></textarea>Char left: <span id="left_char"></span> </div>


                                       
                                        <div class="form-group"> <label class="control-label">Actors</label> <input onclick="clearError()" type="text" value="<?php echo @$actors1;?>" id="actors" name="actors" class="form-control underlined" > </div>
                                     
                                        <div id="time" class="form-group"> <label class="control-label">Timings</label> <input class="btn btn-primary btn-sm" type="button" onclick="return add_timing_field()" id="add_timing" value="Add Another Timing" /><br>
						<?php if($action=="Edit"){?>
						<input type="hidden" id="number" name="number" value="<?php echo @(int)$no_times;?>"/>
						<?php if((int)$no_times>0)  {
							$i=1;
							foreach($times as $timeAr)
							{
							$timingAr=explode('-',$timeAr);?>
							<p>Timing <?php echo $i; ?>:</p>
							<label class="control-label">Day</label>

		<!-- <input onclick="clearError()" class="form-control underlined" type="text" id='day-<?php echo $i?>' name='day-<?php echo $i?>' value="<?php echo @$timingAr[0];?>"> -->

						<select name="day-<?php echo $i?>" alt="" id="day-<?php echo $i?>" onclick="clearError()" class="form-control underlined">
								
							
								
									<option value="">-Select Day-</option>

									<option value="1" <?php if($timingAr[0]=="1") echo 'selected="selected"'; ?>>Sunday</option>
									<option value="2" <?php if($timingAr[0]=="2") echo 'selected="selected"'; ?>>Monday</option>
									<option value="3" <?php if($timingAr[0]=="3") echo 'selected="selected"'; ?>>Tuesday</option>
									<option value="4" <?php if($timingAr[0]=="4") echo 'selected="selected"'; ?>>Wednesday</option>
									<option value="5" <?php if($timingAr[0]=="5") echo 'selected="selected"'; ?>>Thursday</option>
									<option value="6" <?php if($timingAr[0]=="6") echo 'selected="selected"'; ?>>Friday</option>
									<option value="7" <?php if($timingAr[0]=="7") echo 'selected="selected"'; ?>>Saturday</option>
									<option value="99" <?php if($timingAr[0]=="99") echo 'selected="selected"'; ?>>Daily</option>
									
						</select>

						<label class="control-label">Time</label> <input onclick="clearError()" class="form-control underlined" type="text" id='time-<?php echo $i?>' name='time-<?php echo $i?>' value="<?php echo @$timingAr[1];?>">
													
							<?
							$i=$i+1;
							}
						?>
							

						<?php }
							}
							if($action=="Add") {?>
						 <input type="hidden" id="number" name="number" value="1"/>
						<p>Timing 1:</p>
						<label class="control-label">Day</label> 
						<!--<input onclick="clearError()" class="form-control underlined" type="text" id='day-1' name='day-1'>-->
						<select name="day-1" alt="" id="day-1" onclick="clearError()" class="form-control underlined">
								
							
								
									<option value="">-Select Day-</option>
									<option value="1">Sunday</option>
									<option value="2">Monday</option>
									<option value="3">Tuesday</option>
									<option value="4">Wednesday</option>
									<option value="5">Thursday</option>
									<option value="6">Friday</option>
									<option value="7">Saturday</option>
									<option value="99">Daily</option>
									
						</select>

						<label class="control-label">Time</label> <input onclick="clearError()" class="form-control underlined" placeholder="Ex: 2:30 PM" type="text" id='time-1' name='time-1'><sup>Enter IST Timing (Note: Bangladesh_BDT-0:30=Indian_IST)</sup>
							
						<?php } ?>				
						 </div>
						<span id="timing"></span>
					<div class="xoouserultra-field-value" style="padding-left: 10px;">
								<?php if($action=="Edit"){?>
								<input type="hidden" name="editShpc"  value="true" />
								<input type="hidden" name="editShpcid"  value="<?php echo @$shpcid1;?>" />
								<?php } ?>
								<input class="btn btn-primary" type="submit" onclick="return callsubmit();" name="<?php echo $action;?>_Submit"  value="Submit" />
								<?php if($action=="Edit"){?>
								<a class="btn btn-primary" href="<?php echo SITE_URL.'/qp1/shows-promocodes.php'?>">Back</a>
   								<?php } ?>
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
<?php }

?>

<!-- <section class="section">
 <div class="col-md-3">
                             
                            </div>
<div id="search_epg" align="center" style="margin:15px auto;" class="col-md-6">
		Search EPG List using any criteria: <br /> 
		<div class="form-group"> 
		<input placeholder="Enter agent-name" id="searchAN" type="text" name="searchAN" class="form-control boxed"><span class="_or"> </span> 
	</div>
	<div class="form-group">   
		<input placeholder="Enter agent-phone" id="searchPH" type="text" name="searchPH" class="form-control boxed" /> <span class="_or"> </span>
	</div>
	<div class="form-group"> 
		<input placeholder="Enter agent-email" id="searchEM" type="text" name="searchEM" class="form-control boxed" /> 
			</div>	
		</div>
 <div class="col-md-3">
                             
                            </div>
   </section>
-->
<section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
							Show-Promocodes
						</h3> </div>
                                        <section class="example">		
		<form id="frm2" method="post">
		 <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
		
			<thead>
				<tr>	
					<th>PromoCode</th>
					<th>UsageCount</th>
					<th>Program Name</th>
					<th>Channel</th>
					<th>Logo</th>				
					<th>Description</th>	
					<th>Actors</th>
					<th>Timings</th>
					
					
					<?php		if($_SESSION['adminlevel']<=1)
{ ?> <th> Action  <i class="fa fa-cog"></i></th> <?php } ?>
				</tr>
			</thead>
			<tbody id="shpc_list" class="ui-sortable">
			<?php

			$stmt4 = $dbcon->prepare("SELECT * FROM promocodes_vs_shows", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt4->execute();
			$result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($result4 as $row){

				$id=$row['id'];
				$promo_code=$row['promocode'];
				$channelid = $row['channel'];
				$channel=get_var("SELECT post_title from wp_posts where ID=".$channelid." ");
				$progname=$row['programname'];
				$actors=$row['actors'];
				$desc=$row['description'];
				$logo = $row['program_logo_url'];

			
				$usage_count=get_var("SELECT usage_count from promo_codes where coupon_code='".$promo_code."' ");
				
				
				$stmt5 = $dbcon->prepare("SELECT day,time FROM pc_vs_shows_timing_info where promo_shows_id='".$id."'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
				$stmt5->execute();
				$result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

				$timing="";
				foreach($result5 as $r5)
				{
					$timing1 = $r5['day'];
					$timing2 = $r5['time'];

					

					if($timing1==1)
						{$timing1='Sunday';}
					if($timing1==2)
						{$timing1='Monday';}
					if($timing1==3)
						{$timing1='Tuesday';}
					if($timing1==4)
						{$timing1='Wednesday';}
					if($timing1==5)
						{$timing1='Thursday';}
					if($timing1==6)
						{$timing1='Friday';}
					if($timing1==7)
						{$timing1='Saturday';}
					if($timing1==99)
						{$timing1='Daily';}

				
					$timing.=$timing1."-".$timing2." ; ";
				}
			?>
				<tr style="" class="ui-sortable-handle">
				<td style="width: 200px;" class="level_name"><?php echo $promo_code;?></td>					
				<td style="" class="level_name"><?php echo $usage_count;?></td>							
				<td style="width: 200px;" class="level_name"><?php echo $progname;?></td>						
				<td style="width: 200px;" class="level_name"><?php echo $channel;?></td>
				<td style="width: 250px;"><img height="50px" width="150px" src="<?php echo $logo;?>"></td>
				
				<td style="width: 200px;" class="level_name"><?php echo $desc;?></td>
				<td style="width: 185px;"><?php echo $actors;?></td>
				<td style="width: 300px;"><?php echo $timing?></td>
				
				
<?php		if($_SESSION['adminlevel']<=1)
{ ?>
				
				<td style="width: 100px;">

<a style="cursor:pointer;color:blue;" id="editShpc" name="editShpc" onclick="return confirmEditShpc(<?php echo $id;?>)"><em title="Edit" class="fa fa-pencil"></em></a>
&nbsp;
<a style="cursor:pointer;color:blue;" id="removeShpc" name="removeShpc" onclick="return confirmDelShpc(<?php echo $id;?>)"><i title="Remove" class="fa fa-trash-o "></i></a>				

</td>
<?php } ?>				
</tr>
			<?php } ?>
			</tbody>
			<tr id="no_res_div" align="center" style="margin: 5px auto;
    border-bottom: 1px solid #999;
    max-width: 80%;
    font-size: 15px;"><td colspan="6" id="no_res" style="margin:0 auto;text-align:center"></td></tr>
		</table></div></form>
 </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
		


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
	
	$("#shpc-form-section").css("height","auto");
	
	var actors = $("#actors").val();
	var channel = $("#channel").val();
	var progname = $("#programname").val();
	//var timing = $("#timing").val();
	var logo = jQuery("#logofile").val();


	if(channel == ""){
		$("#error").html("Please enter channel name");
		return false;		
	}
			
	if(progname == ""){
		$("#error").html("Please enter program name");
		return false;		
	}


	 if(actors == ""){
		$("#error").html("Please enter any actors");	
		return false;	
	}

	//if(timing == ""){
	//	$("#error").html("Please enter program timing information");	
	//	return false;		
	//}

	if(channel != "" && progname  != "" && actors != ""){
		
				return true;
			
			
	}
	return false;

}



function clearError()
{

		$("#error").html("");
		$(".msg h4").html("");		
	
}


function findRows(table,searchText1,col1,searchText2,col2,searchText3,col3) {

//var table=document.querySelector("#sub_list > tr:visible");
//var table=$('#sub_list tr:visible');
    var rows = table.rows,
        r = 0,
        found = false,
        anyFound = false;
       // var found1,found2,found3;
        //alert(rows.length);
        //alert(searchText1+"in"+col1);
       // alert(searchText2+"in"+col2);
       // alert(searchText3+"in"+col3);
       //  alert(searchText4+"in"+col4);
       // alert(searchText5+"in"+col5);
        //alert(searchText1+"in"+col1);

//alert($('#sub_list tr:visible').length);
	
  var found1=false,found2=false,found3=false;
  
    for (; r < rows.length; r += 1) {
        row = rows.item(r);
          
     // var i=column;
       // alert(searchText1+"in col:"+col1+"  row::"+r);
        
        if(col1!=99)
        found1 = (row.cells.item(col1).textContent.toLowerCase().indexOf(searchText1.toLowerCase().trim()) !== -1);
        else
        found1=true;
         if(col2!=99)
          found2 = (row.cells.item(col2).textContent.toLowerCase().indexOf(searchText2.toLowerCase().trim()) !== -1);else
        found2=true;
          if(col3!=99)
            found3 = (row.cells.item(col3).textContent.toLowerCase().indexOf(searchText3.toLowerCase().trim()) !== -1);else
        found3=true;
          
            
            found=found1 && found2 && found3;
        anyFound = anyFound || found;
//alert(found);
			//if(row.style.display=="none")
      	//	found=false;
        row.style.display = found ? "table-row" : "none";
       }
        
	   
	if(col1==99 && col2==99 && col3==99)
	{
		for (; r < rows.length; r += 1) {
			row = rows.item(r);
			 row.style.display = "table-row" ;}
	}
    //document.getElementById('no_res').style.display = anyFound ? "none" : "block";
var x = document.getElementById("shpc_list").rows.length;
//alert("x"+x);
var cnt=0;

for(i=0;i<x;i=i+1)
{
 var y=document.getElementById("shpc_list").rows[i].style.display;

if(y=="none")
cnt=cnt+1;
}

//alert("cnt:"+cnt);
if(x==(cnt))
{
document.getElementById("no_res").innerHTML="NO SEARCH RESULTS";
$("#no_res").html("NO SEARCH RESULTS");
$("#no_res_div").show();
}
else
{
$("#no_res").html("");
$("#no_res_div").hide();
}

}

function performSearch() {
    var searchText1 = document.getElementById('searchAN').value,
        searchText3 = document.getElementById('searchEM').value,
        searchText2= document.getElementById('searchPH').value,
        targetTable = document.getElementById('shpc_list');
	var searchText=[],col;
	
	if(searchText1!="")
	{
	searchText[0]=searchText1;
	col1=0;
	}
  else{col1=99;}
  
  
	if(searchText2!="")
	{
	searchText[1]=searchText2;
	col2=1;
	}
  else{col2=99;}
  
  
 if(searchText3!="")
	{
	searchText[2]=searchText3;
	col3=3;
	}
  else{col3=99;
}

  	

	//alert(searchText);
    findRows(targetTable,searchText1,col1,searchText2,col2,searchText3,col3);

}

//document.getElementById("search").onclick = performSearch;
//document.getElementById("searchAN").onkeyup = performSearch;
//document.getElementById("searchEM").onkeyup = performSearch;
//document.getElementById("searchPH").onkeyup = performSearch;


function confirmDelShpc(Delid)
{

 swal({
 		title:' ', 
  text: 'Do you really want to remove this info?',
  type: 'warning',
  
  showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Remove",   cancelButtonText: "Cancel",  closeOnCancel: true
},function(){ 

var input1 = $("<input>")
               .attr("type", "hidden")
               .attr("name", "delShpcid").val(Delid);
var input2 = $("<input>")
               .attr("type", "hidden")
               .attr("name", "delShpc").val(true);
$('#frm2').append($(input1));
$('#frm2').append($(input2));
 $("#frm2").submit();

}); 

}

function confirmEditShpc(Editid)
{

 swal({
 		title:' ', 
  text: 'Do you want to edit this info?',
  type: 'warning',
  
  showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Edit",   cancelButtonText: "Cancel",  closeOnCancel: true
},function(){ 

var input1 = $("<input>")
               .attr("type", "hidden")
               .attr("name", "editShpcid").val(Editid);
var input2 = $("<input>")
               .attr("type", "hidden")
               .attr("name", "editShpc").val(true);
$('#frm2').append($(input1));
$('#frm2').append($(input2));
 $("#frm2").submit();

}); 

}

function countChar(){

var max=78;
var count=jQuery("#channel_desc").val().length;

var left=max-count;
jQuery("#left_char").html(left);

}


function add_timing_field()
{

var i;
i=$("#number").val();
j=parseInt(i)+1;
$("#number").val(j);


var head=$("<p>")
		.html("Timing "+j+":");		
var input01 =$("<label>")
		.attr("class","control-label").html("Day");


var input1 = $ ("<select>")
			.attr("id", "day-"+j)
               .attr("name", "day-"+j)
		.attr("onclick", "clearError()")
		.attr("class", "form-control underlined")
		.append($('<option>', {
    value: "",
    text: '-Select Day-'
})).append($('<option>', {
    value: "1",
    text: 'Sunday'
})).append($('<option>', {
    value: "2",
    text: 'Monday'
})).append($('<option>', {
    value: "3",
    text: 'Tuesday'
})).append($('<option>', {
    value: "4",
    text: 'Wednesday'
})).append($('<option>', {
    value: "5",
    text: 'Thursday'
})).append($('<option>', {
    value: "6",
    text: 'Friday'
})).append($('<option>', {
    value: "7",
    text: 'Saturday'
})).append($('<option>', {
    value: "99",
    text: 'Daily'
}));

/*var input1 = $("<input>")
		.attr("type", "text")
		.attr("id", "day-"+j)
               .attr("name", "day-"+j)
		.attr("onclick", "clearError()")
		.attr("class", "form-control underlined");*/

var input02 =$("<label>")
		.attr("class","control-label").html("Time");
var input2 = $("<input>")
		.attr("type", "text")
               .attr("id", "time-"+j)
               .attr("name", "time-"+j)
		.attr("onclick", "clearError()")
		.attr("class", "form-control underlined");


$("#time").append(head);
$("#time").append(input01);
$("#time").append(input1);
$("#time").append(input02);
$("#time").append(input2);

$("#shpc-form-section").css("height","auto");



}

$("#shpc-form-section").css("height","auto");

function shpc_form(){

var s=document.getElementById("shpc-form-section");

if(s.style.display=="none")
{
jQuery("#shpc-form-section").show();
}
else
{
jQuery("#shpc-form-section").hide();
}
}


if($("tr#no_res_div td").html()=="")
	$("tr#no_res_div").hide();
</script>
</article>

<?php
/*
date_default_timezone_set('Asia/Kolkata');

					$d=$time;
					$datetime = new DateTime($d);
					$ist=$datetime->format('D h:i A T') . "\n"."<br>"; //INDIA

					$gmt_time = new DateTimeZone('Europe/London');
					$datetime->setTimezone($gmt_time);
					$gmt=$datetime->format('D h:i A T') . "\n"."<br>"; //London


					
					$cst_time = new DateTimeZone('America/Costa_Rica');
					$datetime->setTimezone($cst_time);
					$cst=$datetime->format('D h:i A T') . "\n"."<br>"; //America Central CST


					$aus_time = new DateTimeZone('Australia/Sydney');
					$datetime->setTimezone($aus_time);
					$aedt=$datetime->format('D h:i A T') . "\n"."<br>"; //Australia

*/

include('footer.php');
?>
