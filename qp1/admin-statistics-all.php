<?php 
include('header.php');
?>
<article class="content items-list-page">

<?php

//echo "Page:".$_POST['page1'];

$searchstring = "";

$start_limit = 0;
@$page = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];

if(isset($_POST['page1']))
{

@$page =	$_POST['page1'];
}


if (!isset($page))
    $page = 1;
if ($page > 1)
    $start_limit = (($page * ROW_PER_PAGE) - ROW_PER_PAGE);

 $mobileselected =  $pcselected = $cond = $filter = "";
if($_REQUEST['device'] == "pc"){
	$cond .= " AND device = 'Personal Computer'";
	$pcselected = "selected='selected'";
	$searchstring .= "&device=pc";
	$filter.=" Device : Personal Computer | ";
}elseif($_REQUEST['device'] == "mobile"){
	$cond .= " AND device = 'Mobile'";
	$mobileselected = "selected='selected'";
	$searchstring .= "&device=mobile";
	$filter.=" Device : Mobile | ";
}

if($_REQUEST['country'] != ""){
	$cond .= " AND country_code = '".$_REQUEST['country']."'";
	$searchstring .= "&country=".$_REQUEST['country'];

	$filter.=" Country : ".$_REQUEST['country']." | ";
}
if($_REQUEST['state'] != ""){
	$cond .= " AND state = '".$_REQUEST['state']."'";
	//$stateselected = "<option selected='selected' value='".$_REQUEST['state']."'>".$_REQUEST['state']."</option>";
	$searchstring .= "&state=".$_REQUEST['state'];

	$filter.=" State : ".$_REQUEST['state']." | ";
}
if($_REQUEST['city'] != ""){
	$cond .= " AND city = '".$_REQUEST['city']."'";
	//$cityselected = "<option selected='selected' value='".$_REQUEST['city']."'>".$_REQUEST['city']."</option>";
	$searchstring .= "&city=".$_REQUEST['city'];

	$filter.=" City : ".$_REQUEST['city']." | ";
}
if($_REQUEST['startdate'] != ""){
	$cond .= " AND DATE(CONVERT_TZ(start_datetime,'+00:00','".$coockie."')) >= '".$_REQUEST['startdate']."'";
	$startdate = $_REQUEST['startdate'];
	$searchstring .= "&startdate=".$_REQUEST['startdate'];

	$filter.=" Startdate : ".$_REQUEST['startdate']." | ";
}
if($_REQUEST['enddate'] != ""){
	$cond .= " AND DATE(CONVERT_TZ(end_datetime,'+00:00','".$coockie."')) <= '".$_REQUEST['enddate']."'";
	$enddate = $_REQUEST['enddate'];
	$searchstring .= "&enddate=".$_REQUEST['enddate'];

	$filter.=" Enddate : ".$_REQUEST['enddate']." | ";
}

$channelId = $_SESSION['customerid'];
$cond .= " AND play = 1";

$sql1 = "SELECT count(*) as count FROM visitors_info WHERE 1 AND duration > 0 AND user_name !=''".$cond;	
$stmt1 = $dbcon->prepare($sql1, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
$stmt1->execute();
$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
$stmt1 = null;
$count = $result1['count'];

$countries = getCountries();
	
?>
<style>
.xoouserultra-field-value, .xoouserultra-field-type{
	width: unset !important;
	padding: 5px;
}

.paging{
	float:left;
}
/*td:nth-child(odd) {
    background: #DDD;
    color: #444;
}
thead{background-color: #4141a0;}
th{color: white !important;
    border: 1px solid #c6c6c6;}*/
</style>
<!--<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-ui.js"></script> -->
 <section class="section">
                <span style="float:"></span>
                <div class="msg" align="center" style="display:inline-block">
                    <h4>
					
                        </h4>
                </div>
                <div class="row sameheight-container">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-6">
                        <div id="filter-form-section" class="card card-block sameheight-item" style="height:auto;/*height: 721px;*/">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="header-block">
                                        <p class="title">Channel Statistics
                                            </p>
                                    </div>
                                </div>
                                <div class="xoouserultra-field-value" style="">
                                    <div id='error' style='color:red;'></div>
					</div>
					<div class="card-block ">
                                    <form role="form" id="xoouserultra-login-form-1" method='post' enctype="multipart/form-data">
					
										<div class="form-inline"> 
											<label class="control-label">Device</label> &nbsp; 
											<select class="form-control underlined" name="device">
												<option value=''>All</option>
												<option value='mobile' <?php echo $mobileselected; ?>>Mobile</option>
												<option value='pc' <?php echo $pcselected; ?>>Personal Computer</option>
											</select>	
										</div>
										<div class="form-inline"> 
											<label class="control-label">Country</label> &nbsp; 
											<select class="form-control underlined" onchange="return getStates(this.value);" name="country" name="country">
												<option value=''>All</option>
												<?php
												foreach($countries as $country){
													$countryselected = ($country['country_code'] == $_REQUEST['country']) ? 'selected="selected" ' : "";
													echo "<option ".$countryselected."value='".$country['country_code']."'>".$country['country']."</option>";
												}
												?>
											</select>
										</div>
										<div class="form-inline"> 
											<label class="control-label">State</label> &nbsp; 
											<select class="form-control underlined" onchange="return getCities(this.value);" name="state" id="state"><option value=''>All</option>
												<?php
												if($_REQUEST['country'] != ""){ 
													$states = getStates($_REQUEST['country']);
													foreach($states as $state){
														$stateselected = ($state['state'] == $_REQUEST['state']) ? 'selected="selected" ' : "";
														echo "<option ".$stateselected."value='".$state['state']."'>".$state['state']."</option>";
													}
													echo $stateselected; 
												} 
												?>
											</select>
										</div>
										<div class="form-inline"> 
											<label class="control-label">City</label> &nbsp; 
											<select class="form-control underlined" name="city" id="city"><option value=''>All</option>
													<?php
													if($_REQUEST['state'] != ""){ 
														$cities = getCities($_REQUEST['state']);
														foreach($cities as $city){
															$cityselected = ($city['city'] == $_REQUEST['city']) ? 'selected="selected" ' : "";
															echo "<option ".$cityselected."value='".$city['city']."'>".$city['city']."</option>";
														}
														echo $cityselected; 
													} 
													?>
											</select>
										</div>
										
											
                                        <div class="form-inline"> <label class="control-label">Start Date</label> &nbsp;  <input autocomplete="off" type="text" value="<?php echo $startdate; ?>" id='startdate' name='startdate' class="form-control underlined"> </div>
										
                                        <div class="form-inline"> <label class="control-label">End Date</label> &nbsp;  <input autocomplete="off" type="text" value="<?php echo $enddate; ?>" id='enddate' name='enddate' class="form-control underlined"> </div>

                                        <div class="xoouserultra-field-value" style="padding-left: 10px;">
                                           	<input type="hidden" name='page' value="1" id="page">
                                            <input class="btn btn-primary" type="submit" name="filter" id="filter" value="Filter" />
                                            
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
<section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
							
						</h3> 
						<span class="text-primary">
							<?php if($filter!=""){
					
									echo "Filters => ".$filter;
					
									}?>
					</span></div>
                                        <section class="example">		<!-- <div class="table-responsive"	style="max-height: 400px; overflow-y: scroll;"> -->

		<form id="frm2" method="post">
		<input type="hidden" name="device" value="<?php echo $_REQUEST['device']; ?>" >
		<input type="hidden" name="country" value="<?php echo $_REQUEST['country']; ?>" >
		<input type="hidden" name="state" value="<?php echo $_REQUEST['state']; ?>" >
		<input type="hidden" name="city" value="<?php echo $_REQUEST['city']; ?>" >
		<input type="hidden" name="startdate" value="<?php echo $_REQUEST['startdate']; ?>" >
		<input type="hidden" name="enddate" value="<?php echo $_REQUEST['enddate']; ?>" >
		 <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
		<!--<table style="overflow-x:auto;min-width:50%;max-width:100% !important;" width="100%" border="0" cellspacing="0" cellpadding="0">-->
			<thead>
				<tr>					
					
					<th>Subscriber</th>
					<th>Device</th>	
					<th>Geo Info</th>						
					<th>Start time</th>
					<th>End time</th>
					<th>Duration(min)</th>
					<th>Channel</th>
				
				</tr>
			</thead>
			<tbody class="ui-sortable">
			<?php if ($count > 0) { 

				//$sql3 = "SELECT * FROM visitors_info WHERE page_id=? AND play = 1 AND duration > 0 AND user_name !=''".$cond." ORDER BY id desc LIMIT " . $start_limit . "," . ROW_PER_PAGE;
				$sql3 = "SELECT *,CONVERT_TZ(start_datetime,'+00:00','".$coockie."') as start_datetime,CONVERT_TZ(end_datetime,'+00:00','".$coockie."') as end_datetime FROM visitors_info WHERE 1 AND duration > 0 AND user_name !=''".$cond." ORDER BY id desc LIMIT " . $start_limit . "," . ROW_PER_PAGE;
				try { //echo "<script>console.log('".$sql3."')</script>";
					$stmt3 = $dbcon->prepare($sql3, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					//$stmt3->execute(array($channelId));
					$stmt3->execute();
					$result3 = $stmt3->fetchall(PDO::FETCH_ASSOC);
			 		$stmt3 = null;
					
					foreach($result3 as $analytics){
						$username=$analytics["user_name"];
						$ipaddress=$analytics["ip_address"];
						$device=$analytics["device"];						
						$pagereferer=$analytics["page_referer"];
						$start=$analytics["start_datetime"];
						$end=$analytics["end_datetime"];

						$page_id=$analytics["page_id"];

						$duration = ($analytics["duration"] / 60);
						
						$duration=round($duration, 1, PHP_ROUND_HALF_DOWN); //added
					
					
						//$useremail = $analytics["user_email"];
						$useremail=get_var("SELECT user_email from wp_users where user_login='".$username."' ");

						$channel = get_var("SELECT post_title from wp_posts where ID=".$page_id." ");

						$deviceInfo = "<strong>OS Name: </strong>".$analytics["os_name"];
						$deviceInfo .= "<br><strong>OS Version: </strong>".$analytics["os_version"];
						$deviceInfo .= "<br><strong>Browser Name: </strong>".$analytics["browser_name"];
						$deviceInfo .= "<br><strong>Browser Version: </strong>".$analytics["browser_version"];

						$geoInfo = "<strong>Country: </strong>".$analytics["country"];
						$geoInfo .= "<br><strong>State: </strong>".$analytics["state"];
						$geoInfo .= "<br><strong>City: </strong>".$analytics["city"];
											
						if(count($result3) > 1){
							echo "<tr class='ui-sortable-handle'>			
									<td>".$username." (".$useremail.")</td>
									<td style='width:150px'>".$device."<a href='javascript:void(0)' class='tooltip'>  <i class='fa fa-info-circle' aria-hidden='true'></i> <span>".$deviceInfo."</span></a></td>
									<td style='width:120px'>".$ipaddress."<a href='javascript:void(0)' class='tooltip'>  <i class='fa fa-info-circle' aria-hidden='true'></i> <span>".$geoInfo."</span></a></td>											
									<td>".date("Y-m-d H:i:s",strtotime($start))."</td>
									<td>".date("Y-m-d H:i:s",strtotime($end))."</td>
									<td>".$duration."</td>
									<td>".$channel."</td>
								</tr>";
						}
					
					}	
	
				}catch (PDOException $e){
					print $e->getMessage();
				}
				
			}else{
				echo "<tr style='' class='ui-sortable-handle'><td colspan='7'><center>No analytics found</center></td></tr>";
				echo "<style>#gotop{display:none}</style>";			
			}
			?>		
			</tbody>
			
		</table></div>
 
	
		<?php

		//Display pagging
		if($count > 0){					
			//echo doPages(ROW_PER_PAGE, 'customer_channel_statistics.php', $searchstring, $count);
			echo doPages(ROW_PER_PAGE, 'admin-statistics-all.php', $searchstring, $count);
			echo '<div id="gotop" style="float:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="return checkGoto(<?php echo ceil($count/10);  ?>)" type="submit" name="goto" style="width:200px;" value="Go to Page" class="btn btn-primary" name="xoouserultra-login" id="goto">&nbsp;<input type="number" name="page" id="page1" style="width:120px;margin:0px 10px !important;padding:0px !important;text-align:center;"><span id="pageErr" style="color:red"></span><!-- /form --></div><br>
		';
		}
		?>
		
		</div></form>
		</section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


<script>

function submitForm(page)
{

var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "page1").val(page);

$('#frm2').append($(input));
 $("#frm2").submit();

}

jQuery(function() {
	jQuery("#startdate").datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		dateFormat: 'yy-mm-dd',
		numberOfMonths: 1,
		maxDate: '0',
		onSelect: function (selected) {
		    var dt = new Date(selected);
		    dt.setDate(dt.getDate() + 1);
		    jQuery("#enddate").datepicker("option", "minDate", dt);
		},
		onClose: function( selectedDate ) {
			jQuery("#enddate").datepicker("option", "minDate", selectedDate);				
		
		}
	});
	jQuery("#enddate").datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		dateFormat: 'yy-mm-dd',
		numberOfMonths: 1,
		maxDate: '0',
		onClose: function( selectedDate ) {
			jQuery("#startdate").datepicker("option", "maxDate", selectedDate);				
		}
	});
	
});

function getStates(countrycode){

	jQuery('#city').html("<option value=''>All</option>");
	jQuery('#state').html("<option value=''>All</option>");

	if(countrycode!=""){
		jQuery.ajax({  
			type: "POST",
			url : "ajax-info",
			data: jQuery.param({ 'action': "getState", 'country_code' : countrycode}) ,
			cache: false,
			success: function(data)
			{
				jQuery('#state').append(data);						
			}
		});	
	}

	return false;

}

function getCities(state){

	jQuery('#city').html("<option value=''>All</option>");

	if(state!=""){
		jQuery.ajax({  
			type: "POST",
			url : "ajax-info",
			data: jQuery.param({ 'action': "getCity", 'state' : state}) ,
			cache: false,
			success: function(data)
			{
				jQuery('#city').append(data);	
			}
		});	
	}

	return false;

}

jQuery("#page1").focus(function(){
jQuery("#pageErr").hide();
})
function checkGoto(maxP)
{

var page_no=jQuery("#page1").val();
jQuery("#pageErr").show();
if(page_no=="")
{
jQuery("#pageErr").html("Please enter a Page no to proceed");
return false;
}else if(page_no<1)
{
jQuery("#pageErr").html("Please enter valid Page no. Min no is 1");
return false;
}else if(page_no>maxP)
{
jQuery("#pageErr").html("Please enter valid Page no. Max no is "+maxP);
return false;
}
else{
jQuery("#pageErr").hide();
return true;
}
}
</script>
</article>
<?php
include('footer.php');
?>
