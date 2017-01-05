<?php 
include('header.php');
?>
<article class="content items-list-page">
<?php


function get_option($a)
{
	
	$sql="SELECT option_value from wp_options where option_name='".$a."'";
	$result = get_var($sql);
	return $result;

}

function update_option($a,$b)
{

$sql = 'UPDATE wp_options SET option_value = "'.$b.'" WHERE option_name= "'.$a.'"';
execute($sql);

}

if(isset($_POST['params_submit']))
{

$update_duration=$_POST['update_duration'];
$android_version=$_POST['android_version'];
$ios_version=$_POST['ios_version'];
$force_update=$_POST['force_update'];
$shutdown_waittime=$_POST['shutdown_waittime'];


update_option('app_analytics_update_duration',$update_duration);
update_option('app_android_version',$android_version);
update_option('app_ios_version',$ios_version);
update_option('app_force_update_status',$force_update);
update_option('app_shutdown_wait_timeout',$shutdown_waittime);


$msg='<span class="alert alert-success">Updated...</span>';
}


?>

<section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
												App-Parameter Settings
						</h3> <div id="msg" align="center" style="margin:0 auto" ><?php echo $msg ?></div>
						</div>
                                        <section class="example">	
										
		<form id="frm2" method="post">
		<!-- <table class="widefat membership-levels" style="width:100% !important;max-width:100% !important;">-->
		<div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
			<tbody>
				<tr><td>APP Anaytics Update Duration</td>
					<td><input type="text" id="update_duration" name="update_duration" value="<?php echo get_option('app_analytics_update_duration');?>" required/>(in sec)</td>
				</tr>
				<tr><td>Android App Version</td>
					<td><input type="text" id="android_version" name="android_version" value="<?php echo get_option('app_android_version');?>" required/></td>
				</tr>
				<tr><td>IoS App Version</td>
					<td><input type="text" id="ios_version" name="ios_version" value="<?php echo get_option('app_ios_version');?>" required/></td>
				</tr>
				<tr><td>App Force Update Status</td>
					<td><input type="text" id="force_update" value="<?php echo get_option('app_force_update_status');?>" name="force_update" required/>(0: Alert for update No Force; 1: Alert and Force Update)</td>
				</tr>
				<tr><td>App WaitTime for Shutdown</td>
					<td><input type="text" id="shutdown_waittime" value="<?php echo get_option('app_shutdown_wait_timeout');?>" name="shutdown_waittime" required/>(in min)</td>
				</tr>
				<tr><td></td>
					<td></td>
				</tr>
				<tr><td></td>
					<td><input class="btn-primary btn" type="submit" name="params_submit" id="params_submit" value="Update" /></td>
				</tr>

			</tbody>
		</table>
		</div>
		</form>
		</section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

<script>
setTimeout(function(){

	jQuery("#msg").hide();
},2000);

jQuery(function(){
	jQuery("input").click(function(){
		jQuery("#msg").hide();
	});
});
</script>
</article>
<?php
include('footer.php');
?>
