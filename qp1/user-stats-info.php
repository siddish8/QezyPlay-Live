<?php 
include('header.php');
?>
<article class="content items-list-page">
<?php

$page_url=$_SERVER['PHP_SELF'];

$searchstring = "";


$start_limit = $start_limitUS = $start_limitUR = $start_limitQT =0;
@$page = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];
@$pageUS = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];
@$pageUR = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];
@$pageQT = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];

if(isset($_POST['pageUS'])){
	@$pageUS =	$_POST['pageUS'];
}else{
 	$pageUS = 1;
}

if(isset($_POST['pageUR'])){
	@$pageUR =	$_POST['pageUR'];
}else{
	 $pageUR = 1;
}

if(isset($_POST['pageQT'])){
	@$pageQT =	$_POST['pageQT'];
}else{
	 $pageQT = 1;
}

if (!isset($page))
    $page = 1;
if ($page > 1)
    $start_limit = (($page * ROW_PER_PAGE) - ROW_PER_PAGE);

if ($pageUS > 1)
    $start_limitUS = (($pageUS * ROW_PER_PAGE) - ROW_PER_PAGE);

if ($pageUR > 1)
    $start_limitUR = (($pageUR * ROW_PER_PAGE) - ROW_PER_PAGE);

if ($pageQT > 1)
    $start_limitQT = (($pageQT * ROW_PER_PAGE) - ROW_PER_PAGE);

$num_rec_per_page=10;


if (isset($_GET["page"])) 
{ $page  = $_GET["page"];

$sno= $_GET["last"]-1;


	if (isset($_REQUEST["tab"])) {
			if($_REQUEST["tab"]=="UR"){
				$userUR=1;
			}
			elseif($_REQUEST["tab"]=="US"){
				$userUS=1;
				}
		}
} 
else { $page=1;

 }; 
$start_from = ($page-1) * $num_rec_per_page; 

$filterUR = $filterUS = "";

if( (isset($_REQUEST['this_dateIntUR']) or isset($_REQUEST['date_submitIntUR'])) and  $_REQUEST['this_dateIntUR']!=""){
	$date_intUR=$_REQUEST['this_dateIntUR'];
	$_SESSION['dateUR']="";
	$_SESSION['daysUR']=$date_intUR;

	$filterUR .= "From last ".$date_intUR." days";

	$sql2 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,a.user_registered FROM wp_users a where  a.user_registered>=CURDATE() - INTERVAL $date_intUR DAY order by id desc LIMIT $start_limitUR, $num_rec_per_page";	
	$res2 = get_all($sql2);

	$sqlT2 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,a.user_registered FROM wp_users a where  a.user_registered>=CURDATE() - INTERVAL $date_intUR DAY order by id desc";	
	$resT2 = get_all($sqlT2);
}else if( (isset($_REQUEST['this_dateUR']) or isset($_REQUEST['date_submitUR'])) and $_REQUEST['this_dateUR']!=""){
	$dateUR=$_REQUEST['this_dateUR'];
	$_SESSION['daysUR']="";
	$_SESSION['dateUR']=$dateUR;

	$filterUR .= "From date- ".$dateUR;

	$sql2 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,a.user_registered FROM wp_users a where (a.user_registered between '".$dateUR."' and CURDATE()) order by a.ID desc LIMIT $start_limitUR, $num_rec_per_page";	
	$res2 = get_all($sql2);

	$sqlT2 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,a.user_registered FROM wp_users a where (a.user_registered between '".$dateUR."' and CURDATE()) order by a.ID desc";	
	$resT2 = get_all($sqlT2);

}else{

	$sql2 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,a.user_registered FROM wp_users a where a.user_registered>=CURDATE() - INTERVAL 10 DAY order by a.ID desc LIMIT $start_limitUR, $num_rec_per_page";	
	$res2 = get_all($sql2);

	$sqlT2 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,a.user_registered FROM wp_users a where a.user_registered>=CURDATE() - INTERVAL 10 DAY order by a.ID desc";	
	$resT2 = get_all($sqlT2);

	$filterUR .= "From last 10 days";

}

//if(isset($_REQUEST['date_submitInt']))
if( (isset($_REQUEST['this_dateIntUS']) or isset($_REQUEST['date_submitIntUS'])) and  $_REQUEST['this_dateIntUS']!=""){

	$date_intUS=$_REQUEST['this_dateIntUS'];
	$_SESSION['dateUS']="";
	$_SESSION['daysUS']=$date_intUS;

	$filterUS .= "From last ".$date_intUS." days";

	$sql1 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,b.membership_id as plan,b.billing_amount as amt,b.startdate as my_date,b.enddate as endD FROM wp_users a inner join wp_pmpro_memberships_users b on a.id=b.user_id where (b.startdate >=CURDATE() - INTERVAL $date_intUS DAY) UNION SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,c.plan_id as plan,c.amount as amt,c.credited_datetime as my_date,c.subscription_end_on as endD FROM wp_users a inner join agent_vs_subscription_credit_info c on a.id=c.subscriber_id where (c.credited_datetime >=CURDATE() - INTERVAL $date_intUS DAY) order by my_date desc LIMIT $start_limitUS, $num_rec_per_page";
	$res1 = get_all($sql1);

	$sqlT1 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,b.membership_id as plan,b.billing_amount as amt,b.startdate as my_date,b.enddate as endD FROM wp_users a inner join wp_pmpro_memberships_users b on a.id=b.user_id where (b.startdate >=CURDATE() - INTERVAL $date_intUS DAY) UNION SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,c.plan_id as plan,c.amount as amt,c.credited_datetime as my_date,c.subscription_end_on as endD FROM wp_users a inner join agent_vs_subscription_credit_info c on a.id=c.subscriber_id where (c.credited_datetime >=CURDATE() - INTERVAL $date_intUS DAY) order by my_date desc";
	$resT1 = get_all($sqlT1);

}else if( (isset($_REQUEST['this_dateUS']) or isset($_REQUEST['date_submitUS'])) and $_REQUEST['this_dateUS']!=""){

	$dateUS=$_REQUEST['this_dateUS'];
	$_SESSION['daysUS']="";
	$_SESSION['dateUS']=$dateUS;

	$filterUS .= "From date- ".$dateUS;

	$sql1 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,b.membership_id as plan,b.billing_amount as amt,b.startdate as my_date,b.enddate as endD FROM wp_users a inner join wp_pmpro_memberships_users b on a.id=b.user_id where (b.startdate between '".$dateUS."' and CURDATE()) UNION SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,c.plan_id as plan,c.amount as amt,c.credited_datetime as my_date,c.subscription_end_on as endD FROM wp_users a inner join agent_vs_subscription_credit_info c on a.id=c.subscriber_id where (c.credited_datetime between '".$dateUS."' and CURDATE()) order by my_date desc LIMIT $start_limitUS, $num_rec_per_page";	
	$res1 = get_all($sql1);

	$sqlT1 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,b.membership_id as plan,b.billing_amount as amt,b.startdate as my_date,b.enddate as endD FROM wp_users a inner join wp_pmpro_memberships_users b on a.id=b.user_id where (b.startdate between '".$dateUS."' and CURDATE()) UNION SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,c.plan_id as plan,c.amount as amt,c.credited_datetime as my_date,c.subscription_end_on as endD FROM wp_users a inner join agent_vs_subscription_credit_info c on a.id=c.subscriber_id where (c.credited_datetime between '".$dateUS."' and CURDATE()) order by my_date desc";
	$resT1 = get_all($sqlT1);
}
 else
{
$date_intUS=10;

$filterUS .= "From last ".$date_intUS." days";

$sql1 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,b.membership_id as plan,b.billing_amount as amt,b.startdate as my_date,b.enddate as endD FROM wp_users a inner join wp_pmpro_memberships_users b on a.id=b.user_id where (b.startdate >=CURDATE() - INTERVAL $date_intUS DAY) UNION SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,c.plan_id as plan,c.amount as amt,c.credited_datetime as my_date,c.subscription_end_on as endD FROM wp_users a inner join agent_vs_subscription_credit_info c on a.id=c.subscriber_id where (c.credited_datetime >=CURDATE() - INTERVAL $date_intUS DAY) order by my_date desc LIMIT $start_limitUS, $num_rec_per_page";	
$res1 =  get_all($sql1);

$sqlT1 = "SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,b.membership_id as plan,b.billing_amount as amt,b.startdate as my_date,b.enddate as endD FROM wp_users a inner join wp_pmpro_memberships_users b on a.id=b.user_id where (b.startdate >=CURDATE() - INTERVAL $date_intUS DAY) UNION SELECT a.ID,a.user_login,a.user_email,a.phone,a.user_url,c.plan_id as plan,c.amount as amt,c.credited_datetime as my_date,c.subscription_end_on as endD FROM wp_users a inner join agent_vs_subscription_credit_info c on a.id=c.subscriber_id where (c.credited_datetime >=CURDATE() - INTERVAL $date_intUS DAY) order by my_date desc";	
$resT1 = get_all($sqlT1);

}


echo '<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-ui.js"></script>';

?>

<ul class="nav nav-tabs nav-tabs-bordered">
        <li class="nav-item"> <a id="UR" href="#UserRegs" class="nav-link" data-target="#UserRegs" data-toggle="tab" role="tab" >Registrations</a> </li>
        <li class="nav-item"> <a id="US" href="#UserSubs" class="nav-link" data-target="#UserSubs" data-toggle="tab" role="tab" >Subscriptions</a> </li>
		<li class="nav-item"> <a id="QT" href="#QezyTable" class="nav-link  active" data-target="#QezyTable" data-toggle="tab" role="tab" >Qezy Statistics Table</a> </li>
        
</ul>

<div class="tab-content">


<div id="UserSubs" class="tab-pane fade in">
		<section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">	
											<?php echo $filterUS ?>						
						</h3> 
						</div>
                                        <section class="example">	
<form id="frm2US" method="post">
		<!--<table class="widefat membership-levels" style="width:100% !important;max-width:100% !important;">-->
		<input type="hidden" name="this_dateUS" value="<?php echo $_REQUEST['this_dateUS']; ?>">
		<input type="hidden" name="this_dateIntUS" value="<?php echo $_REQUEST['this_dateIntUS']; ?>">
		
		<div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>S.No</th>				
					<th>User</th>
					<!--<th>User ID</th>
					<th>User Name(E-mail)</th>-->
					<th>Phone</th>
					<th>Plan Details</th>
					<!--<th>Plan Name(Plan ID)</th>
					<th>Paid Amount</th>-->
					<th>Paid Date</th>
					<th>End Date</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">
			<?php

			$count=$total_records = count($resT1);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 

			$id=$start_limitUS+1;
			foreach($res1 as $row){
			
				
				$user_id=$row['ID'];
				$user_name=$row['user_login'];
				$user_email=$row['user_email'];

				$userInfo = "<strong>ID: </strong>".$user_id;
				$userInfo .= "<br><strong>Email: </strong>".$user_email;

				$phone_no=$row['phone'];
				$fb=$row['user_url'];
				if($phone_no!="xxxxxxxxxxx")
				{
				$contact=$phone_no;
				}				
			        else
				{
				$contact=$fb;
				}
				
				//$plan_id=$row['membership_id'];
				$plan_id=$row['plan'];

				$plan_name=get_var("SELECT name from wp_pmpro_membership_levels where id=$plan_id ");
				
				//$paid_amnt=$row['billing_amount'];
				$paid_amnt=$row['amt'];

				$planInfo = "<strong>Name: </strong>".$plan_name;
				$planInfo .= "<br><strong>ID: </strong>".$plan_id;
				$planInfo .= "<br><strong>Amount Paid: </strong>".$paid_amnt;
				//$paid_date=$row['startdate'];
				$paid_date=$row['my_date'];
				//$end_date=$row['enddate'];
				$end_date=$row['endD'];							
		

		//$phone_no=$wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key='phone' and user_id=$user_id ");

			echo 	'<tr style="" class="ui-sortable-handle">	
				<td style="width: 192px;" class="level_name">'.$id.'</td>						
				<td style="width:400px">'.$user_name.'<a href="javascript:void(0)" class="tooltip">  <i class="fa fa-info-circle" aria-hidden="true"></i> <span>'.$userInfo.'</span></a></td>
				<!--<td style="width: 192px;" class="level_name">'.$user_id.'</td>
				<td style="width: 342px;" class="level_name">'.$user_name.'('.$user_email.')</td>-->
				<td style="width: 192px;" class="level_name">'.$contact.'</td>
				<td style="width:350px">'.$plan_name.'<a href="javascript:void(0)" class="tooltip">  <i class="fa fa-info-circle" aria-hidden="true"></i> <span>'.$planInfo.'</span></a></td>
				<!--<td style="width: 192px;">'.$plan_name.'('.$plan_id.')</td>
				<td style="width: 342px;">'.$paid_amnt.'</td>-->
				<td style="width: 342px;">'.$paid_date.'</td>
				<td style="width: 342px;">'.$end_date.'</td>
				
				</tr>';
			$id=$id+1;
			 } 
			 ?>
			 </tbody>
		</table>
		</div>
		<?php

			//Display pagging
		if($count > 0){					
			//echo doPages(ROW_PER_PAGE, 'customer_channel_statistics.php', $searchstring, $count);
			echo doPages(ROW_PER_PAGE, 'user-stats-info.php', $searchstring, $count,$tab="US");
			echo '<div id="gotop" style="display:inline-block;float:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input onclick="return checkGotoUS('.ceil($count/10).')" type="submit" name="goto" style="width:200px;" value="Go to Page" class="btn btn-primary" name="xoouserultra-login" id="goto">&nbsp;
			<input type="number" name="pageUS" id="page1US" style="width:120px;margin:0px 10px !important;padding:0px !important;text-align:center;">
			<span id="pageErrUS" style="color:red"></span><!-- /form --></div>
		';
			echo '<input type="hidden" name="tab" value="US">';
		}
		?>
		
		
		</form>
		</section>

		<div id="other_tabs" align="center" style="margin:0 auto;max-width:50%;text-align:center">
			<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">
				<form method="post" id="dateformUS">
				<label>Select Date</label>
				<input required type="text" placeholder="YYYY-mm-dd" id="this_dateUS" name="this_dateUS" />(shows all results from this date to TODAY)
				<br />
				<input type="submit" name="date_submitUS" id="date_submit" value="Submit"/>
				<input type="hidden" name="tab" value="US">
				</form></div>

				<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">---- OR -----</div>

				<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">
				<form method="post" id="dateIntformUS">
				<label>Enter Days</label>
				<input required type="number" min="1" max="30" placeholder="10" id="this_dateInt" name="this_dateIntUS" />(shows all results from last no. of days)
				<br />
				<input type="submit" name="date_submitIntUS" id="date_submitInt" value="Submit"/>
				<input type="hidden" name="tab" value="US">
				</form>
			</div>
		</div>                      </div>
                                </div>
                            </div>
                        </div>
                   </section>
				</div><!-- US -->


<div id="UserRegs" class="tab-pane fade in">
		<section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">	

											<?php echo $filterUR ?>							
						</h3> 
						</div>
                                        <section class="example">	
<form id="frm2UR" method="post">

		<input type="hidden" name="this_dateUR" value="<?php echo $_REQUEST['this_dateUR']; ?>">
		<input type="hidden" name="this_dateIntUR" value="<?php echo $_REQUEST['this_dateIntUR']; ?>">
		<!--<table class="widefat membership-levels" style="width:100% !important;max-width:100% !important;">-->
		<div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>		
					<th>S.No</th>
					<th>User</th>			
					<!--<th>User ID</th>
					<th>User Name</th>
					<th>User E-mail</th>-->
					<th>Phone</th>
					<th>Location</th>
					<!--<th>IP Address</th>
					<th>City(State,Country)</th>-->
					<th>Regd. Date</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">

			<?php

				//$res=$wpdb->get_results("SELECT * FROM user_feedback"); 

			//$res=$wpdb->get_results("SELECT a.ID,a.user_login,a.user_email,b.meta_value,a.user_registered FROM qezyplay_newshonar.wp_users a inner join qezyplay_newshonar.wp_usermeta b on a.ID=b.user_id where a.user_registered>=CURDATE() - INTERVAL $date_int DAY and b.meta_key='phone' order by id desc");

			$count=$total_records = count($resT2);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 

			$id=$start_limitUR+1;
			foreach($res2 as $row){

				
				$user_id=$row['ID'];
				$user_name=$row['user_login'];
				$user_mail=$row['user_email'];

				$userInfo = "<strong>ID: </strong>".$user_id;
				$userInfo .= "<br><strong>Email: </strong>".$user_mail;
				

				//$phone=$row['meta_value'];
				$phone=$row['phone'];
				$fb=$row['user_url'];

				if($phone!="xxxxxxxxxxx")
				{
				$contact=$phone;
				}				
			        else
				{
				$contact=$fb;
				}
				$reg_date=$row['user_registered'];

				

				$user_ip=get_var('SELECT meta_value FROM wp_usermeta where meta_key="uultra_user_registered_ip" and user_id='.$user_id.' ');
				
				//$user_ip = $user_ip_arr['meta_value'];

				$user_city=get_var('SELECT city FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_city=$user_city_arr['city'];
				$user_state=get_var('SELECT state FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_state=$user_state_arr['state'];
				$user_country=get_var('SELECT country FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_country=$user_country_arr['country'];

						$geoInfo = "<strong>IP: </strong>".$user_ip;
						$geoInfo .= "<br><strong>Country: </strong>".$user_country;
						$geoInfo .= "<br><strong>State: </strong>".$user_state;
						$geoInfo .= "<br><strong>City: </strong>".$user_city;
								
		
			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">'.$id.'</td>
				<td style="width:250px">'.$user_name.'<a href="javascript:void(0)" class="tooltip">  <i class="fa fa-info-circle" aria-hidden="true"></i> <span>'.$userInfo.'</span></a></td>								
				<!-- <td style="width: 192px;" class="level_name">'.$user_id.'</td>
				<td style="width: 192px;" class="level_name">'.$user_name.'</td>
				<td style="width: 192px;" class="level_name">'.$user_mail.'</td> -->
				<td style="width: 184px;">'.$contact.'</td>
				<td style="width:192px">'.$user_country.' <a href="javascript:void(0)" class="tooltip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <span>'.$geoInfo.'</span></a></td>
				<!-- <td style="width: 184px;">'.$user_ip.'</td>				
				<td style="width: 342px;">'.$user_city.'('.$user_state.','.$user_country.')</td> -->
				<td style="width: 342px;">'.$reg_date.'</td>
				
				</tr>';
			$id=$id+1;
			 } 

			?>

			 </tbody>
		</table>
		</div>
		<?php

			//Display pagging
		if($count > 0){					
			//echo doPages(ROW_PER_PAGE, 'customer_channel_statistics.php', $searchstring, $count);
			echo doPages(ROW_PER_PAGE, 'user-stats-info.php', $searchstring, $count,$tab="UR");
			echo '<div id="gotop" style="display:inline-block;float:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input onclick="return checkGotoUR('.ceil($count/10).')" type="submit" name="goto" style="width:200px;" value="Go to Page" class="btn btn-primary" name="xoouserultra-login" id="goto">&nbsp;
			<input type="number" name="pageUR" id="page1UR" style="width:120px;margin:0px 10px !important;padding:0px !important;text-align:center;">
			<span id="pageErrUR" style="color:red"></span><!-- /form --></div>
		';
			echo '<input type="hidden" name="tab" value="UR">';
		}
		?>
		
		
		</form>
		</section>

		<div id="other_tabs" align="center" style="margin:0 auto;max-width:50%;text-align:center">
			<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">
				<form method="post" id="dateformUR">
				<label>Select Date</label>
				<input required type="text" placeholder="YYYY-mm-dd" id="this_dateUR" name="this_dateUR" />(shows all results from this date to TODAY)
				<br />
				<input type="submit" name="date_submitUR" id="date_submit" value="Submit"/>
				<input type="hidden" name="tab" value="UR">
				</form></div>

				<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">---- OR -----</div>

				<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">
				<form method="post" id="dateIntformUR">
				<label>Enter Days</label>
				<input required type="number" min="1" max="30" placeholder="10" id="this_dateInt" name="this_dateIntUR" />(shows all results from last no. of days)
				<br />
				<input type="submit" name="date_submitIntUR" id="date_submitInt" value="Submit"/>
				<input type="hidden" name="tab" value="UR">
				</form>
			</div>
		</div>        

                                    </div>
                                </div>
                            </div>
                        </div>
                   </section>
				</div><!-- UR -->

<?php
if(isset($_POST['specific_date_submit']))
{
$sp_date=$_POST['specific_date'];
if($sp_date!="")
{
$QT=1;
$sp_dateText=$sp_date;
}
}
else
{
$sp_date=new DateTime("now");
$sp_date=$sp_date->format("Y-m-d");
$sp_dateText=$sp_date."<br />"."(Today by Default)";
}

?>
<div id="QezyTable" class="tab-pane fade in active">
		<section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">							
						</h3> 
						</div>
                                        <section class="example">	
<form id="frm2QT" method="post">
		<!--<table class="widefat membership-levels" style="width:100% !important;max-width:100% !important;">-->
		<div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>	
					<th></th>		
					<th>DATE</th>
					<th>No. of REGISTRATIONS</th>
					<th>Free Trails</th>
					<th>Half-Yearly*</th>
					<th>Yearly*</th>
					<th>Quarterly</th>
					<th>Half-Yearly</th>
					<th>Yearly</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">

			<?php
			
			//$res=$wpdb->get_results("SELECT * FROM user_contact"); 

			$date=get_var("SELECT date(curdate()-1)");
			//$date=$date_arr['dateS'];
			
			$reg_count=get_var("SELECT count(ID) from wp_users where user_registered between '$date' and curdate()");		
			//$reg_count=$reg_count_arr['counterR'];
			
			$freetrail_count=get_var("SELECT count(membership_id) from wp_pmpro_memberships_users where membership_id=4 and startdate between '$date' and curdate()");
			//$freetrail_count=$freetrail_count_arr['counterF'];

			$halfyearly_countFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$halfyearly_starFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");

			$yearly_countFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$yearly_starFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");



			$quarterly_count=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate()) ");
			$quarterly_star=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");



			$halfyearly_count=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$halfyearly_star=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");
			
			$yearly_count=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$yearly_star=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");

				

			$q=	$quarterly_count + 	$quarterly_star;
			$h=	$halfyearly_count + 	$halfyearly_star;
			$y=	$yearly_count + 	$yearly_star;	
			$hFO=	$halfyearly_countFO + 	$halfyearly_starFO;
			$yFO=	$yearly_countFO + 	$yearly_starFO;						
		
			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">Yesterday: </td>		
				<td style="width: 192px;" class="level_name">'.$date.'</td>						
				<td style="width: 192px;" class="level_name">'.$reg_count.'</td>
				<td style="width: 192px;" class="level_name">'.$freetrail_count.'</td>
				<td style="width: 342px;">'.$hFO.' ('.$halfyearly_countFO.'+'.$halfyearly_starFO.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$yFO.' ('.$yearly_countFO.'+'.$yearly_starFO.'<sup>*</sup>)</td>
				<td style="width: 192px;">'.$q.' ('.$quarterly_count.'+'.$quarterly_star.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$h.' ('.$halfyearly_count.'+'.$halfyearly_star.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$y.' ('.$yearly_count.'+'.$yearly_star.'<sup>*</sup>)</td>
				
				</tr>';




//echo $sp_date; //SPECIFIC DATE
			$reg_countS=get_var("SELECT count(ID) from wp_users where date(user_registered)='$sp_date'");
			
			$freetrail_countS=get_var("SELECT count(membership_id) from wp_pmpro_memberships_users where membership_id=4 and date(startdate)='$sp_date'");

			$halfyearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$halfyearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$yearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$yearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$quarterly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$quarterly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$halfyearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$halfyearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$yearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$yearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$qS=	$quarterly_countS + 	$quarterly_starS;
			$hS=	$halfyearly_countS + 	$halfyearly_starS;
			$yS=	$yearly_countS + 	$yearly_starS;	
			$hSFO=	$halfyearly_countSFO + 	$halfyearly_starSFO;
			$ySFO=	$yearly_countSFO + 	$yearly_starSFO;	

			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">Specific</td>	
				<td style="width: 192px;" class="level_name">'.$sp_dateText.'</td>						
				<td style="width: 192px;" class="level_name">'.$reg_countS.'</td>
				<td style="width: 192px;" class="level_name">'.$freetrail_countS.'</td>
				<td style="width: 342px;">'.$hSFO.' ('.$halfyearly_countSFO.'+'.$halfyearly_starSFO.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$ySFO.' ('.$yearly_countSFO.'+'.$yearly_starSFO.'<sup>*</sup>)</td>
				<td style="width: 192px;">'.$qS.' ('.$quarterly_countS.'+'.$quarterly_starS.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$hS.' ('.$halfyearly_countS.'+'.$halfyearly_starS.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$yS.' ('.$yearly_countS.'+'.$yearly_starS.'<sup>*</sup>)</td>
				
				</tr>';


			//TOTAL from 15th jul,2016

			$st_date="2016-07-15";
			$reg_countS=get_var("SELECT count(ID) from wp_users where date(user_registered)>='$st_date'");
			
			$freetrail_countS=get_var("SELECT count(membership_id) from wp_pmpro_memberships_users where membership_id=4 and date(startdate)>='$st_date'");

			$halfyearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_AgentSFO=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=6 and (DATE(credited_datetime)>='$st_date')");

			$yearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$yearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$yearly_AgentSFO=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=7 and (DATE(credited_datetime)>='$st_date')");


			$quarterly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$quarterly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$quarterly_AgentS=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=3 and (DATE(credited_datetime)>='$st_date')");

			$halfyearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_AgentS=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=2 and (DATE(credited_datetime)>='$st_date')");

			$yearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$yearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$yearly_AgentS=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=1 and (DATE(credited_datetime)>='$st_date')");

			$qS=	$quarterly_countS + 	$quarterly_starS + $quarterly_AgentS;
			$hS=	$halfyearly_countS + 	$halfyearly_starS + $halfyearly_AgentS;
			$yS=	$yearly_countS + 	$yearly_starS + $yearly_AgentS;	
			$hSFO=	$halfyearly_countSFO + 	$halfyearly_starSFO + $halfyearly_AgentSFO;
			$ySFO=	$yearly_countSFO + 	$yearly_starSFO + $quarterly_AgentSFO;	

			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">Total(from Jul-15,2016): </td>	
				<td style="width: 192px;" class="level_name"></td>						
				<td style="width: 192px;" class="level_name">'.$reg_countS.'</td>
				<td style="width: 192px;" class="level_name">'.$freetrail_countS.'</td>
				<td style="width: 342px;">'.$hSFO.' ('.$halfyearly_countSFO.'+'.$halfyearly_starSFO.'<sup>*</sup>+'.$halfyearly_AgentSFO.'<sup>A</sup>)</td>
				<td style="width: 342px;">'.$ySFO.' ('.$yearly_countSFO.'+'.$yearly_starSFO.'<sup>*</sup>+'.$yearly_AgentSFO.'<sup>A</sup>)</td>
				<td style="width: 192px;">'.$qS.' ('.$quarterly_countS.'+'.$quarterly_starS.'<sup>*</sup>+'.$quarterly_AgentS.'<sup>A</sup>)</td>
				<td style="width: 342px;">'.$hS.' ('.$halfyearly_countS.'+'.$halfyearly_starS.'<sup>*</sup>+'.$halfyearly_AgentS.'<sup>A</sup>)</td>
				<td style="width: 342px;">'.$yS.' ('.$yearly_countS.'+'.$yearly_starS.'<sup>*</sup>+'.$yearly_AgentS.'<sup>A</sup>)</td>
				
				</tr>';
				?>

					 </tbody>
		</table>
		</div>
		</form>
		</section>
		<div style="float: right;display: inline-block;"><p>*: Paid Revenue</p><p>A: Paid by Agent</p></div>
		<div align="center" style="max-width:200px;margin:0 auto;">
		<form method="post">
		<label>Select a Specific Date</label>
		<input required type="text" placeholder="YYYY-mm-dd" id="specific_date" name="specific_date" />
			<br />
		<input type="submit" name="specific_date_submit" id="specific_date_submit" value="Submit"/></form>
		</div>

		
                                    </div>
                                </div>
                            </div>
                        </div>
                   </section>
				</div><!-- QT -->




</div>




<?php
/*
echo '<div id="other_tabs" align="center" style="margin:0 auto;max-width:50%;text-align:center">';
echo '<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">
<form method="post" id="dateform">
<label>Select Date</label><input required type="text" placeholder="YYYY-mm-dd" id="this_date" name="this_date" />(shows all results from this date to TODAY)
<br />
<input type="submit" name="date_submit" id="date_submit" value="Submit"/></form></div>

<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">---- OR -----</div>

<div align="center" style="margin:0 auto;max-width:200px;display:inline-block">
<form method="post" id="dateIntform">
<label>Enter Days</label><input required type="number" min="1" max="30" placeholder="10" id="this_dateInt" name="this_dateInt" />(shows all results from last no. of days)
<br />
<input type="submit" name="date_submitInt" id="date_submitInt" value="Submit"/></form></div>
</div>

<br />
<br />';

echo '<ul class="tab mx">

<li><a id="UR" href="#" class="tablinks" onclick="userStats(event, \'UserRegs\')">User Registartions List</a></li>
  <li><a id="US" href="#" class="tablinks" onclick="userStats(event, \'UserSubs\')">User Subscriptions List</a></li>
<li><a id="QT" href="#" class="tablinks" onclick="userStats(event, \'QezyTable\')">QezyPlay Daily Table</a></li>
<!-- <li><a id="QT" href="'.$page_url.'#" class="tablinks" onclick="userStats(event, \'QezyTable\')">QezyPlay Daily Table</a></li>-->
  
 </ul>';

echo '<div id="UserSubs" class="tabcontent mx">
		<!-- <table class="widefat membership-levels" style="width:100% !important;"> -->
		<table style="overflow-x:auto;min-width:50%;max-width:100% !important;word-break: break-all;
    max-width: 100%;margin-bottom: 25px;" width="100%;" border="0" cellspacing="0" cellpadding="0";>
			<thead>
				<tr>	
					<th>S.No</th>				
					<th>User ID</th>
					<th>User Name(E-mail)</th>
					<th>Phone</th>
					<th>Plan Name(Plan ID)</th>
					<th>Paid Amount</th>
					<th>Paid Date</th>
					<th>End Date</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">';
			
			//$res=$wpdb->get_results("SELECT * FROM user_contact"); 

			//$res=$wpdb->get_results("SELECT a.ID,a.user_login,b.membership_id,b.billing_amount,b.startdate FROM qezyplay_newshonar.wp_users a inner join qezyplay_newshonar.wp_pmpro_memberships_users b on a.id=b.user_id where b.startdate >=CURDATE() - INTERVAL $date_int DAY");
			//$id=1+$sno;
			$id=$start_from+1;
			foreach($res1 as $row){
			
				
				$user_id=$row['ID'];
				$user_name=$row['user_login'];
				$user_email=$row['user_email'];
				$phone_no=$row['phone'];
				$fb=$row['user_url'];
				if($phone_no!="xxxxxxxxxxx")
				{
				$contact=$phone_no;
				}				
			        else
				{
				$contact=$fb;
				}
				
				//$plan_id=$row['membership_id'];
				$plan_id=$row['plan'];

				$plan_name=get_var("SELECT name from wp_pmpro_membership_levels where id=$plan_id ");

				//$paid_amnt=$row['billing_amount'];
				$paid_amnt=$row['amt'];
				//$paid_date=$row['startdate'];
				$paid_date=$row['my_date'];
				//$end_date=$row['enddate'];
				$end_date=$row['endD'];
								
		

		//$phone_no=$wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key='phone' and user_id=$user_id ");

			echo 	'<tr style="" class="ui-sortable-handle">	
				<td style="width: 192px;" class="level_name">'.$id.'</td>						
				<td style="width: 192px;" class="level_name">'.$user_id.'</td>
				<td style="width: 342px;" class="level_name">'.$user_name.'('.$user_email.')</td>
				<td style="width: 192px;" class="level_name">'.$contact.'</td>
				<td style="width: 192px;">'.$plan_name.'('.$plan_id.')</td>
				<td style="width: 342px;">'.$paid_amnt.'</td>
				<td style="width: 342px;">'.$paid_date.'</td>
				<td style="width: 342px;">'.$end_date.'</td>
				
				</tr>';
			$id=$id+1;
			 } 
			
			echo '</tbody>
		</table>';

$total_records = count($resT1);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
echo "<span style='color:black;font-size:16px'>Total:$total_records </span> <a class='link_btn' href='?page=1&tb=S'>".'<'."</a> "; // Goto 1st page  
for ($i=1; $i<=$total_pages; $i++) { 
		if(isset($_SESSION['date']) and $_SESSION['date']!="")
		 echo "<a class='link_btn' href='?page=".$i."&tb=S&this_date=".$_SESSION['date']."'>".$i."</a> ";
		elseif(isset($_SESSION['days']) and $_SESSION['days']!="")
		 echo "<a class='link_btn' href='?page=".$i."&tb=S&this_dateInt=".$_SESSION['days']."'>".$i."</a> ";  
		else
            echo "<a class='link_btn' href='?page=".$i."&tb=S'>".$i."</a> "; 
}; 

echo "<a class='link_btn' href='?page=$total_pages&tb=S'>".'>'."</a> "; // Goto last page
echo	'</div>
<div class="clear"></div>
	 <div id="UserRegs" class="tabcontent mx">
		<table class="widefat membership-levels" style="width:100% !important;word-break: break-all;
    max-width: 100%;   margin-bottom: 25px;">
			<thead>
				<tr>		
					<th>S.No</th>			
					<th>User ID</th>
					<th>User Name</th>
					<th>User E-mail</th>
					<th>Phone</th>
					<th>IP Address</th>
					<th>City(State,Country)</th>
					<th>Regd. Date</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">';
			
			//$res=$wpdb->get_results("SELECT * FROM user_feedback"); 

			//$res=$wpdb->get_results("SELECT a.ID,a.user_login,a.user_email,b.meta_value,a.user_registered FROM qezyplay_newshonar.wp_users a inner join qezyplay_newshonar.wp_usermeta b on a.ID=b.user_id where a.user_registered>=CURDATE() - INTERVAL $date_int DAY and b.meta_key='phone' order by id desc");
			$id=$start_from+1;
			foreach($res2 as $row){

				
				$user_id=$row['ID'];
				$user_name=$row['user_login'];
				$user_mail=$row['user_email'];
				//$phone=$row['meta_value'];
				$phone=$row['phone'];
				$fb=$row['user_url'];

				if($phone!="xxxxxxxxxxx")
				{
				$contact=$phone;
				}				
			        else
				{
				$contact=$fb;
				}
				$reg_date=$row['user_registered'];

				

				$user_ip=get_var('SELECT meta_value FROM wp_usermeta where meta_key="uultra_user_registered_ip" and user_id='.$user_id.' ');
				
				//$user_ip = $user_ip_arr['meta_value'];

				$user_city=get_var('SELECT city FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_city=$user_city_arr['city'];
				$user_state=get_var('SELECT state FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_state=$user_state_arr['state'];
				$user_country=get_var('SELECT country FROM visitors_info where ip_address="'.$user_ip.'" ');
				//$user_country=$user_country_arr['country'];
								
		
			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">'.$id.'</td>								
				<td style="width: 192px;" class="level_name">'.$user_id.'</td>
				<td style="width: 192px;" class="level_name">'.$user_name.'</td>
				<td style="width: 192px;" class="level_name">'.$user_mail.'</td>
				<td style="width: 184px;">'.$contact.'</td>
				<td style="width: 184px;">'.$user_ip.'</td>
				<td style="width: 342px;">'.$user_city.'('.$user_state.','.$user_country.')</td>
				<td style="width: 342px;">'.$reg_date.'</td>
				
				</tr>';
			$id=$id+1;
			 } 
			
			echo '</tbody>
		</table>';

$total_records = count($resT2);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
echo "<span style='color:black;font-size:16px'>Total:$total_records </span> <a class='link_btn' href='?page=1&tb=R'>".'<'."</a> "; // Goto 1st page  
for ($i=1; $i<=$total_pages; $i++) { 

		if(isset($_SESSION['date']) and $_SESSION['date']!="")
		 echo "<a class='link_btn' href='?page=".$i."&tb=R&this_date=".$_SESSION['date']."'>".$i."</a> ";
		elseif(isset($_SESSION['days']) and $_SESSION['days']!="")
		 echo "<a class='link_btn' href='?page=".$i."&tb=R&this_dateInt=".$_SESSION['days']."'>".$i."</a> "; 
		else
            echo "<a class='link_btn' href='?page=".$i."&tb=R'>".$i."</a> "; 
}; 

echo "<a class='link_btn' href='?page=$total_pages&tb=R'>".'>'."</a> "; // Goto last page
echo	'</div>';

if(isset($_POST['specific_date_submit']))
{
$sp_date=$_POST['specific_date'];
if($sp_date!="")
{
$QT=1;
}
}
else
{
$sp_date=new DateTime("now");
$sp_date=$sp_date->format("Y-m-d");
}

echo '<div id="QezyTable" class="tabcontent mx" align="center" style="display:block">
		<table class="table table-striped" style="text-align:center;width:100% !important;word-break: break-all;
    max-width: 100%;     margin-bottom: 25px;">
			<thead>
				<tr>	
					<th></th>		
					<th>DATE</th>
					<th>No. of REGISTRATIONS</th>
					<th>Free Trails</th>
					<th>Half-Yearly*</th>
					<th>Yearly*</th>
					<th>Quarterly</th>
					<th>Half-Yearly</th>
					<th>Yearly</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">';
			
			//$res=$wpdb->get_results("SELECT * FROM user_contact"); 

			$date=get_var("SELECT date(curdate()-1)");
			//$date=$date_arr['dateS'];
			
			$reg_count=get_var("SELECT count(ID) from wp_users where user_registered between '$date' and curdate()");		
			//$reg_count=$reg_count_arr['counterR'];
			
			$freetrail_count=get_var("SELECT count(membership_id) from wp_pmpro_memberships_users where membership_id=4 and startdate between '$date' and curdate()");
			//$freetrail_count=$freetrail_count_arr['counterF'];

			$halfyearly_countFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$halfyearly_starFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");

			$yearly_countFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$yearly_starFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");



			$quarterly_count=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate()) ");
			$quarterly_star=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");



			$halfyearly_count=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$halfyearly_star=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");
			
			$yearly_count=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total=0 and (DATE(timestamp) between '$date' and curdate())");
			$yearly_star=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total>0 and (DATE(timestamp) between '$date' and curdate())");

				

$q=	$quarterly_count + 	$quarterly_star;
$h=	$halfyearly_count + 	$halfyearly_star;
$y=	$yearly_count + 	$yearly_star;	
$hFO=	$halfyearly_countFO + 	$halfyearly_starFO;
$yFO=	$yearly_countFO + 	$yearly_starFO;						
		
			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">Yesterday: </td>		
				<td style="width: 192px;" class="level_name">'.$date.'</td>						
				<td style="width: 192px;" class="level_name">'.$reg_count.'</td>
				<td style="width: 192px;" class="level_name">'.$freetrail_count.'</td>
				<td style="width: 342px;">'.$hFO.' ('.$halfyearly_countFO.'+'.$halfyearly_starFO.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$yFO.' ('.$yearly_countFO.'+'.$yearly_starFO.'<sup>*</sup>)</td>
				<td style="width: 192px;">'.$q.' ('.$quarterly_count.'+'.$quarterly_star.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$h.' ('.$halfyearly_count.'+'.$halfyearly_star.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$y.' ('.$yearly_count.'+'.$yearly_star.'<sup>*</sup>)</td>
				
				</tr>';




//echo $sp_date; //SPECIFIC DATE
			$reg_countS=get_var("SELECT count(ID) from wp_users where date(user_registered)='$sp_date'");
			
			$freetrail_countS=get_var("SELECT count(membership_id) from wp_pmpro_memberships_users where membership_id=4 and date(startdate)='$sp_date'");

			$halfyearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$halfyearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$yearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$yearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$quarterly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$quarterly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$halfyearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$halfyearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

			$yearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total=0 and (DATE(timestamp)='$sp_date')");
			$yearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total>0 and (DATE(timestamp)='$sp_date')");

$qS=	$quarterly_countS + 	$quarterly_starS;
$hS=	$halfyearly_countS + 	$halfyearly_starS;
$yS=	$yearly_countS + 	$yearly_starS;	
$hSFO=	$halfyearly_countSFO + 	$halfyearly_starSFO;
$ySFO=	$yearly_countSFO + 	$yearly_starSFO;	

			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">Specific(default:Today): </td>	
				<td style="width: 192px;" class="level_name">'.$sp_date.'</td>						
				<td style="width: 192px;" class="level_name">'.$reg_countS.'</td>
				<td style="width: 192px;" class="level_name">'.$freetrail_countS.'</td>
				<td style="width: 342px;">'.$hSFO.' ('.$halfyearly_countSFO.'+'.$halfyearly_starSFO.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$ySFO.' ('.$yearly_countSFO.'+'.$yearly_starSFO.'<sup>*</sup>)</td>
				<td style="width: 192px;">'.$qS.' ('.$quarterly_countS.'+'.$quarterly_starS.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$hS.' ('.$halfyearly_countS.'+'.$halfyearly_starS.'<sup>*</sup>)</td>
				<td style="width: 342px;">'.$yS.' ('.$yearly_countS.'+'.$yearly_starS.'<sup>*</sup>)</td>
				
				</tr>';


			//TOTAL from 15th jul,2016

	$st_date="2016-07-15";
			$reg_countS=get_var("SELECT count(ID) from wp_users where date(user_registered)>='$st_date'");
			
			$freetrail_countS=get_var("SELECT count(membership_id) from wp_pmpro_memberships_users where membership_id=4 and date(startdate)>='$st_date'");

			$halfyearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=6 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_AgentSFO=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=6 and (DATE(credited_datetime)>='$st_date')");

			$yearly_countSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$yearly_starSFO=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=7 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$yearly_AgentSFO=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=7 and (DATE(credited_datetime)>='$st_date')");


			$quarterly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$quarterly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=3 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$quarterly_AgentS=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=3 and (DATE(credited_datetime)>='$st_date')");

			$halfyearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=2 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$halfyearly_AgentS=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=2 and (DATE(credited_datetime)>='$st_date')");

			$yearly_countS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total=0 and (DATE(timestamp)>='$st_date')");
			$yearly_starS=get_var("SELECT count(membership_id) FROM wp_pmpro_membership_orders where membership_id=1 and status='success' and total>0 and (DATE(timestamp)>='$st_date')");
			$yearly_AgentS=get_var("SELECT count(plan_id) FROM agent_vs_subscription_credit_info where plan_id=1 and (DATE(credited_datetime)>='$st_date')");

$qS=	$quarterly_countS + 	$quarterly_starS + $quarterly_AgentS;
$hS=	$halfyearly_countS + 	$halfyearly_starS + $halfyearly_AgentS;
$yS=	$yearly_countS + 	$yearly_starS + $yearly_AgentS;	
$hSFO=	$halfyearly_countSFO + 	$halfyearly_starSFO + $halfyearly_AgentSFO;
$ySFO=	$yearly_countSFO + 	$yearly_starSFO + $quarterly_AgentSFO;	

			echo 	'<tr style="" class="ui-sortable-handle">
				<td style="width: 192px;" class="level_name">Total(from Jul-15,2016): </td>	
				<td style="width: 192px;" class="level_name"></td>						
				<td style="width: 192px;" class="level_name">'.$reg_countS.'</td>
				<td style="width: 192px;" class="level_name">'.$freetrail_countS.'</td>
				<td style="width: 342px;">'.$hSFO.' ('.$halfyearly_countSFO.'+'.$halfyearly_starSFO.'<sup>*</sup>+'.$halfyearly_AgentSFO.'<sup>A</sup>)</td>
				<td style="width: 342px;">'.$ySFO.' ('.$yearly_countSFO.'+'.$yearly_starSFO.'<sup>*</sup>+'.$yearly_AgentSFO.'<sup>A</sup>)</td>
				<td style="width: 192px;">'.$qS.' ('.$quarterly_countS.'+'.$quarterly_starS.'<sup>*</sup>+'.$quarterly_AgentS.'<sup>A</sup>)</td>
				<td style="width: 342px;">'.$hS.' ('.$halfyearly_countS.'+'.$halfyearly_starS.'<sup>*</sup>+'.$halfyearly_AgentS.'<sup>A</sup>)</td>
				<td style="width: 342px;">'.$yS.' ('.$yearly_countS.'+'.$yearly_starS.'<sup>*</sup>+'.$yearly_AgentS.'<sup>A</sup>)</td>
				
				</tr>';
						
			echo '</tbody>
		</table><div style="float: right;
    display: inline-block;"><p>*: Paid Revenue</p><p>A: Paid by Agent</p></div>
<div align="center" style="max-width:200px;margin:0 auto;">
<form method="post"><label>Select a Specific Date</label><input required type="text" placeholder="YYYY-mm-dd" id="specific_date" name="specific_date" />
<br />
<input type="submit" name="specific_date_submit" id="specific_date_submit" value="Submit"/></form>
</div>

	</div>
	<div class="clear"></div><br /><br />';
	*/
	?>

<script>

function tabActive(tab){

		if(tab=="UR"){
			jQuery('#UR').attr('class','nav-link active');
			jQuery('#UserRegs').attr('class','tab-pane fade in active');

			jQuery('#US').attr('class','nav-link');
			jQuery('#UserSubs').attr('class','tab-pane fade in');

			jQuery('#QT').attr('class','nav-link');
			jQuery('#QezyTable').attr('class','tab-pane fade in');

		}else if(tab=="US"){

			jQuery('#UR').attr('class','nav-link');
			jQuery('#UserRegs').attr('class','tab-pane fade in');

			jQuery('#US').attr('class','nav-link  active');
			jQuery('#UserSubs').attr('class','tab-pane fade in active');

			jQuery('#QT').attr('class','nav-link');
			jQuery('#QezyTable').attr('class','tab-pane fade in');

		}else if(tab=="QT"){

			jQuery('#UR').attr('class','nav-link');
			jQuery('#UserRegs').attr('class','tab-pane fade in');

			jQuery('#US').attr('class','nav-link');
			jQuery('#UserSubs').attr('class','tab-pane fade in');

			jQuery('#QT').attr('class','nav-link active');
			jQuery('#QezyTable').attr('class','tab-pane fade in active');

		}
		
	}

</script>


<?php
if($userPR==1)
{
echo '<script>
		document.getElementById("UR").setAttribute("class","tablinks");
		document.getElementById("US").setAttribute("class","tablinks");
		document.getElementById("QT").setAttribute("class","tablinks active");
		document.getElementById("UserSubs").setAttribute("class","tabcontent mx hide");
		document.getElementById("UserRegs").setAttribute("class","tabcontent mx hide");
		document.getElementById("QezyTable").setAttribute("class","tabcontent mx show");
</script>';}



echo '<script>

var otherhide=document.getElementById("QezyTable").style.display;
if(otherhide=="block")
{
document.getElementById("other_tabs").style.display="none";
}


jQuery( function() {
    jQuery( "#specific_date" ).datepicker({changeMonth: true,changeYear: true,
		 minDate: new Date(2016, 10-4, 15),maxDate: "0",dateFormat: "yy-mm-dd"});
jQuery( "#specific_date" ).keyup(function()  { this.value = this.value.substring(0,this.value.length -1); });
  } );

jQuery( function() {
    jQuery( "#this_dateUR" ).datepicker({changeMonth: true,changeYear: true,
		 maxDate: "0",dateFormat: "yy-mm-dd"});
 jQuery( "#this_dateUR" ).keyup(function()  { this.value = this.value.substring(0,this.value.length -1); });
  } );

  jQuery( function() {
    jQuery( "#this_dateUS" ).datepicker({changeMonth: true,changeYear: true,
		 maxDate: "0",dateFormat: "yy-mm-dd"});
 jQuery( "#this_dateUS" ).keyup(function()  { this.value = this.value.substring(0,this.value.length -1); });
  } );

function userStats(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks,US,UR;

	if(cityName=="QezyTable")
	{
	jQuery("#other_tabs").hide();
	}
	else
	{
	jQuery("#other_tabs").show();
	}

	/*if(cityName="UserSubs")
	{
	US=1;
	}
	if(cityName="UserRegs")
	{
	UR=1;
	}*/

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
	 
    }

	ele=document.getElementsByClassName("tabcontent mx show");
	 for (i = 0; i < ele.length; i++) {
        ele[i].setAttribute("class","tabcontent mx hide");;
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
	document.getElementById(cityName).setAttribute("class","tabcontent mx show");
    evt.currentTarget.className += " active";

}


</script>';

if($userUR==1)
{
echo '<script>
		tabActive("UR");
</script>';

	
}

if($userUS==1)
{
echo '<script>
tabActive("US");
		
</script>';

	
}
?>

</script>

<?php

if(isset($_POST['tab'])){
	if($_POST['tab']=="UR"){
		echo "<script>
		
				tabActive('UR');

				</script>";
	}elseif($_POST['tab']=="US"){
		echo "<script>
				tabActive('US');
				</script>";
	}elseif($_POST['tab']=="QT"){
		echo "<script>
				tabActive('QT');
				</script>";
	}
}


?>

<script>
	function submitFormUR(page){
		var input = $("<input>")
				.attr("type", "hidden")
				.attr("name", "pageUR").val(page);

		$('#frm2UR').append($(input));
		$("#frm2UR").submit();

	}
		
	function submitFormUS(page){
		var input = $("<input>")
				.attr("type", "hidden")
				.attr("name", "pageUS").val(page);

		$('#frm2US').append($(input));
		$("#frm2US").submit();

	}
	function submitFormQT(page){
		var input = $("<input>")
				.attr("type", "hidden")
				.attr("name", "pageQT").val(page);

		$('#frm2QT').append($(input));
		$("#frm2QT").submit();

	}



	jQuery("#page1").focus(function(){
		jQuery("#pageErr").hide();
	});

	function checkGotoUR(maxP){
		var page_no=jQuery("#page1UR").val();
		jQuery("#pageErrUR").show();
		if(page_no==""){
			jQuery("#pageErrUR").html("Please enter a Page no to proceed");
			return false;
		}else if(page_no<1){
			jQuery("#pageErrUR").html("Please enter valid Page no. Min no is 1");
			return false;
		}else if(page_no>maxP){
			jQuery("#pageErrUR").html("Please enter valid Page no. Max no is "+maxP);
			return false;
		}else{
			jQuery("#pageErrUR").hide();
			return true;
		}
	}

	function checkGotoUS(maxP){
		var page_no=jQuery("#page1US").val();
		jQuery("#pageErrUS").show();
		if(page_no==""){
			jQuery("#pageErrUS").html("Please enter a Page no to proceed");
			return false;
		}else if(page_no<1){
			jQuery("#pageErrUS").html("Please enter valid Page no. Min no is 1");
			return false;
		}else if(page_no>maxP){
			jQuery("#pageErrUS").html("Please enter valid Page no. Max no is "+maxP);
			return false;
		}else{
			jQuery("#pageErrUS").hide();
			return true;
		}
	}


</script>
</article>
<?php
include('footer.php');
?>
