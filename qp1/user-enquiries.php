<?php 
include('header.php');
?>
<article class="content items-list-page">
<?php

$msg = ""; $action = "Add";

$searchstring = "";


$start_limit = $start_limitC = $start_limitF = 0;
@$page = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];
@$pageC = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];
@$pageF = isset($_POST['page']) ? $_POST['page'] : $_GET['page'];

if(isset($_POST['pageC']))
{

@$pageC =	$_POST['pageC'];
}
else
{

 $pageC = 1;

}

if(isset($_POST['pageF']))
{

@$pageF =	$_POST['pageF'];
}
else{
	 $pageF = 1;
}


if (!isset($page))
    $page = 1;
if ($page > 1)
    $start_limit = (($page * ROW_PER_PAGE) - ROW_PER_PAGE);

if ($pageC > 1)
    $start_limitC = (($pageC * ROW_PER_PAGE) - ROW_PER_PAGE);

if ($pageF > 1)
    $start_limitF = (($pageF * ROW_PER_PAGE) - ROW_PER_PAGE);



/*$num_rec_per_page=10;
if (isset($_GET["page"])) { 
	$page  = $_GET["page"];
	$sno= $_GET["last"]-1;

	if (isset($_GET["tb"])) {
		if($_GET["tb"]=="C"){
			$userC=1;
			}
		elseif($_GET["tb"]=="F"){
			$userF=1;
			}
		}
	} 
else{ 
	$page=1;
 }; 

$start_from = ($page-1) * $num_rec_per_page; 
$start_fromC = ($pageC-1) * $num_rec_per_page; 
$start_fromF = ($pageF-1) * $num_rec_per_page;/*/


if(isset($_GET['delF'])){

	$id = $_GET['id'];

	$stmt11 = $dbcon->prepare("DELETE FROM user_feedback WHERE id = ".$id."", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt11->execute();
	
	
	$msg = "<span style='color:green'>Feedback Info deleted Successfully</span>";

		$userF=1;
//echo '<script>window.location.href="http://ideabytestraining.com/newqezyplay/qp/user_forms.php";</script>';
	
}

if(isset($_GET['delC'])){

	$id = $_GET['id'];

	$stmt11 = $dbcon->prepare("DELETE FROM user_contact WHERE id = ".$id."", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt11->execute();
	


	$msg = "<span style='color:green'>Contact Info deleted Successfully</span>";
		
	$userC=1;

	//echo '<script>window.location.href="http://ideabytestraining.com/newqezyplay/qp/user_forms.php";</script>';
}

if(isset($_GET['readF'])){

		$id = $_GET['id'];


		$stmt22 = $dbcon->prepare('UPDATE user_feedback SET status = "read" WHERE id = '.$id, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	 
		$stmt22->execute();

			$userF=1;	
	}	


if(isset($_GET['readC'])){

		$id = $_GET['id'];

		$stmt22 = $dbcon->prepare('UPDATE user_contact SET status = "read" WHERE id = '.$id, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	 
		$stmt22->execute();


				
		$userC=1;
	
	}	


?>

<ul class="nav nav-tabs nav-tabs-bordered">
        <li class="nav-item"> <a id="UC" href="#UserContact" class="nav-link active" data-target="#UserContact" data-toggle="tab" role="tab" >User Contacts</a> </li>
        <li class="nav-item"> <a id="UF" href="#UserFeedback" class="nav-link" data-target="#UserFeedback" data-toggle="tab" role="tab" >User Feedbacks</a> </li>
        
</ul>

<div class="tab-content">
<div id="UserContact"  class="tab-pane fade in active">
<div class="msg" align="center" style="display:block">
	<h4><?php echo $msg;?></h4>
</div> 	
	
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
<form id="frm2C" method="post">
		<!--<table class="widefat membership-levels" style="width:100% !important;max-width:100% !important;">-->
		<div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>	
					<th>Read Status</th>				
					<th>First Name</th>
					<th>Last Name</th>
					<th>E-mail</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Message</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">
			
<?php

			$sqlT1 = "SELECT * FROM user_contact";
			$resT1 = get_all($sqlT1);	
			$sql1 = "SELECT * FROM user_contact LIMIT " . $start_limitC . "," . ROW_PER_PAGE."";	
			$result1 = get_all($sql1);

			$count=$total_records = count($resT1);  //count number of records
$total_pages = ceil($total_records / ROW_PER_PAGE);

			foreach($result1 as $row1){

				$id=$row1['id'];
				$fisrtname=$row1['first_name'];
				$lastname=$row1['last_name'];
				$email=$row1['email'];
				$phone=$row1['phone'];
				$address=$row1['address'];
				$message=$row1['message'];

				$status=$row1['status'];

				if($status=="read")
				{
				//echo "<style>#C-".$id."{background-color:green !important;color:black !important;}</style>";
				//echo "<style>#readContact-".$id."{display:none !important}</style>";
				echo "<style>#readContact-".$id."{  pointer-events: none;  cursor: default;opacity:0.65}#gr_imgC-".$id."{display:block !important}</style>";
				
				}
				else
				{
				//echo "<style>#C-".$id."{background-color:yellow !important;color:red !important;}</style>";
				}
				
		
			echo 	'<tr id="C-'.$id.'" style="" class="ui-sortable-handle">			
				<td style="" ><span id="gr_imgC-'.$id.'" src="'.SITE_URL.'/qp/images/green_tick.png" style="display:none;width:30px;"><em class="fa fa-check"></em></span></td>			
				<td style="" class="level_name">'.$fisrtname.'</td>
				<td style="" class="level_name">'.$lastname.'</td>
				<td style="">'.$email.'</td>
				<td style="">'.$phone.'</td>
				<td style="">'.$address.'</td>
				<td style="">'.$message.'</td>
				<td style=""><a class="" style="cursor: pointer;color:#2a85e8 !important" id="readContact-'.$id.'" href="user_forms.php?readC=true&id='.$id.'" title="read" name="Read-'.$id.'" class="button-primary"><!-- img src="'.SITE_URL.'/qp/images/book2.jpg" width="50px" title="Read" --> <em class="fa fa-eye-slash" title="Read"></em> </a>				<a title="Reply" href="mailto:'.$email.'?subject=QezyPlay%20Contact%20Reply&amp;">
<!-- img src="'.SITE_URL.'/qp/images/email-logo.png" width="50px" title="Reply"--> <em class="fa fa-envelope" title="Reply"></em></a>
				<a class="" style="cursor: pointer;color:#2a85e8 !important;" title="delete" name="removeContact-'.$id.'" id="removeContact-'.$id.'" onclick="callConfirmationC(\'user_forms.php?delC=true&id='.$id.'\');" class="button-secondary"><!-- img src="'.SITE_URL.'/qp/images/remove.jpg" width="37px" title="Remove" --><em class="fa fa-trash-o" title="Remove"></em></a></td>
				</tr>';
			 } 
			
			echo '</tbody>
		</table></div>';
		
		 
/*echo "<span style='color:black;font-size:16px'>Total:$total_records </span> <a class='link_btn' href='?page=1&tb=C'>".'<'."</a> "; // Goto 1st page  
for ($i=1; $i<=$total_pages; $i++) { 
		if(isset($_SESSION['date']) and $_SESSION['date']!="")
		 echo "<a class='link_btn' href='?page=".$i."&tb=C&this_date=".$_SESSION['date']."'>".$i."</a> ";
		elseif(isset($_SESSION['days']) and $_SESSION['days']!="")
		 echo "<a class='link_btn' href='?page=".$i."&tb=C&this_dateInt=".$_SESSION['days']."'>".$i."</a> ";  
		else
            echo "<a class='link_btn' href='?page=".$i."&tb=C'>".$i."</a> "; 
}; 

echo "<a class='link_btn' href='?page=$total_pages&tb=C'>".'>'."</a> "; // Goto last page*/


		//Display pagging
		if($count > 0){					
			//echo doPages(ROW_PER_PAGE, 'customer_channel_statistics.php', $searchstring, $count);
			echo doPages(ROW_PER_PAGE, 'user-enquiries.php', $searchstring, $count, $tab="C");
			echo '<div id="gotop" style="float:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input onclick="return checkGotoC('.ceil($count/10).')" type="submit" name="goto" style="width:200px;" value="Go to Page" class="btn btn-primary" name="xoouserultra-login" id="goto">&nbsp;
			<input type="number" name="pageC" id="page1C" style="width:120px;margin:0px 10px !important;padding:0px !important;text-align:center;">
			<span id="pageErrC" style="color:red"></span><!-- /form --></div>
		';
			echo '<input type="hidden" name="tab" value="C">';
		}
		?>
		
		</form>
		</section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section></div>
		
		
	
	 <div id="UserFeedback"  class="tab-pane fade in">
		<div class="msg" align="center" style="display:block"><h4><?php echo $msg ?></h4></div> 	
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
		<form id="frm2F" method="post">
		<!-- <table class="widefat membership-levels" style="width:100% !important;max-width:100% !important;">-->
		<div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>	<th>Read Status</th>					
					<th>Name</th>
					<th>Gender</th>
					<th>Country</th>
					<th>E-mail</th>
					<th>Phone</th>
					<th>Qezy Platform</th>
					<th>Channel</th>
					<th>Message</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody class="ui-sortable">

			<?php

			$sqlT2 = "SELECT * FROM user_feedback";
			$resT2 = get_all($sqlT2);	
			$sql2 = "SELECT * FROM user_feedback LIMIT " . $start_limitF . "," . ROW_PER_PAGE."";	
			$result2 = get_all($sql2);	

			$count=$total_records = count($resT2);  //count number of records
			$total_pages = ceil($total_records / ROW_PER_PAGE); 		
			

			foreach($result2 as $row2){

			
				$id=$row2['id'];
				$name=$row2['name'];
				$gender=$row2['gender'];
				$country=$row2['country'];
				$email=$row2['email'];
				$phone=$row2['phone'];
				$qezy_platform=$row2['qezy_platform'];
				$channel=$row2['channel'];
				$message=$row2['message'];
				$status=$row2['status'];

				if($status=="read")
				{
				echo "<style>#F-".$id."{background-color:green !important;color:black !important;}</style>";
				//echo "<style>#readFeedback-".$id."{display:none !important}</style>";
				echo "<style>#readFeedback-".$id."{  pointer-events: none;  cursor: default;opacity:0.65}#gr_imgF-".$id."{display:block !important}</style>";
				}
				else
				{
				//echo "<style>#F-".$id."{background-color:yellow !important;color:red !important;}</style>";
				}
				
		
			echo 	'<tr id="F-'.$id.'" style="" class="ui-sortable-handle">			
				<td style="" ><span id="gr_imgF-'.$id.'" src="'.SITE_URL.'/qp/images/green_tick.png" style="display:none;width:30px;"><em class="fa fa-check"></em></span></td>			
				<td style="" class="level_name">'.$name.'</td>
				<td style="" class="level_name">'.$gender.'</td>
				<td style="" class="level_name">'.$country.'</td>
				<td style="">'.$email.'</td>
				<td style="">'.$phone.'</td>
				<td style="">'.$qezy_platform.'</td>
				<td style="">'.$channel.'</td>
				<td style="">'.$message.'</td>
				<td style="width: 350px;"><a class="" style="cursor: pointer;color:#2a85e8 !important" id="readFeedback-'.$id.'" href="user_forms.php?readF=true&id='.$id.'" title="read" name="Read-'.$id.'" class="button-primary"><em title="Read" class="fa fa-eye-slash"></em></a>
				<a href="mailto:'.$email.'?subject=QezyPlay%20Contact%20Reply&amp;">
<em class="fa fa-envelope" title="Reply"></em></a>
				<a class="" style="cursor: pointer;color:#2a85e8 !important" title="delete" name="removeFeedback-'.$id.'" id="removeFeedback-'.$id.'" onclick="callConfirmationF(\'user_forms.php?delF=true&id='.$id.'\');" class="button-secondary"><em class="fa fa-trash-o" title="Remove"></em></a></td>
				
				</tr>';
			 } 
			
			echo '</tbody>
		</table></div>';

		
		
	//Display pagging
		if($count > 0){					
			//echo doPages(ROW_PER_PAGE, 'customer_channel_statistics.php', $searchstring, $count);
			echo doPages(ROW_PER_PAGE, 'user-enquiries.php', $searchstring, $count,$tab="F");
			echo '<div id="gotop" style="float:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input onclick="return checkGotoF('.ceil($count/10).')" type="submit" name="goto" style="width:200px;" value="Go to Page" class="btn btn-primary" name="xoouserultra-login" id="goto">&nbsp;
			<input type="number" name="pageF" id="page1F" style="width:120px;margin:0px 10px !important;padding:0px !important;text-align:center;">
			<span id="pageErrF" style="color:red"></span><!-- /form --></div>
		';
			echo '<input type="hidden" name="tab" value="F">';
		}
		?>
		
		</form>
		
		
		</form>
		</section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
		
		</div></div>

<script>

function tabActive(tab){

		if(tab=="C"){
			jQuery('#UC').attr('class','nav-link active');
			jQuery('#UserContact').attr('class','tab-pane fade in active');

			jQuery('#UF').attr('class','nav-link');
			jQuery('#UserFeedback').attr('class','tab-pane fade in');

		}else if(tab=="F"){
			jQuery('#UF').attr('class','nav-link active');
			jQuery('#UserFeedback').attr('class','tab-pane fade in active');

			jQuery('#UC').attr('class','nav-link');
			jQuery('#UserContact').attr('class','tab-pane fade in');

		}
		
	}

</script>

<?php

if(isset($_POST['tab'])){
	if($_POST['tab']=="C"){
		echo "<script>
		
				tabActive('C');

				</script>";
	}elseif($_POST['tab']=="F"){
		echo "<script>
				tabActive('F');
				</script>";
	}
}

if($userC==1){
	echo "<script>
				tabActive('C');
				
				</script>";
}

if($userF==1){
	echo "<script>
				tabActive('F');
					
				</script>";
}		


?>

<script>

	

	function callConfirmationF(url){

		var ans = confirm("Sure, do you want to delete this feedback info?");
		if(ans){
			window.location.href = url;
		}
	}


	function callConfirmationC(url){

		var ans = confirm("Sure, do you want to delete this contact info?");
		if(ans){
			window.location.href = url;
		}
	}

	setTimeout(function(){
	jQuery(".msg").slideUp();
	},3000);

	function submitFormC(page){
		var input = $("<input>")
				.attr("type", "hidden")
				.attr("name", "pageC").val(page);

		$('#frm2C').append($(input));
		$("#frm2C").submit();

	}
		
	function submitFormF(page){
		var input = $("<input>")
				.attr("type", "hidden")
				.attr("name", "pageF").val(page);

		$('#frm2F').append($(input));
		$("#frm2F").submit();

	}



	jQuery("#page1").focus(function(){
		jQuery("#pageErr").hide();
	});

	function checkGotoC(maxP){
		var page_no=jQuery("#page1C").val();
		jQuery("#pageErrC").show();
		if(page_no==""){
			jQuery("#pageErrC").html("Please enter a Page no to proceed");
			return false;
		}else if(page_no<1){
			jQuery("#pageErrC").html("Please enter valid Page no. Min no is 1");
			return false;
		}else if(page_no>maxP){
			jQuery("#pageErrC").html("Please enter valid Page no. Max no is "+maxP);
			return false;
		}else{
			jQuery("#pageErrC").hide();
			return true;
		}
	}

	function checkGotoF(maxP){
		var page_no=jQuery("#page1F").val();
		jQuery("#pageErrF").show();
		if(page_no==""){
			jQuery("#pageErrF").html("Please enter a Page no to proceed");
			return false;
		}else if(page_no<1){
			jQuery("#pageErrF").html("Please enter valid Page no. Min no is 1");
			return false;
		}else if(page_no>maxP){
			jQuery("#pageErrF").html("Please enter valid Page no. Max no is "+maxP);
			return false;
		}else{
			jQuery("#pageErrF").hide();
			return true;
		}
	}
</script>


</article>
<?php
include('footer.php');
?>
