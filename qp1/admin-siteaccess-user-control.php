<?php 
	include('header.php');
?>
<style>
.disabled{cursor:not-allowed !important;pointer-events:none;opacity:0.4}

</style>

<article class="content items-list-page">

    <?php

	$msg = ""; $action = "Add";

	if(isset($_REQUEST['delAsauc'])){

		$id = $_REQUEST['delAsaucid'];

             

       $sql1="DELETE FROM user_video_accesslist where id=".$id."";

		$stmt11 = $dbcon->prepare($sql1, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt11->execute();
		$stmt11=null;

             $msg1="";
			$msg1.= "Deleted Successfully<br>";
			$msg = "<span id='msg' style='color:green'>".$msg1."</span>";
	
		
	}

    if(isset($_POST['get_uname'])){
        $usrid=$_POST['uid'];
         if($usrid==""){
             $msg1="";
			$msg1.= "Please enter User-id<br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
         
        }else{
             $usname=get_var("SELECT user_login from wp_users WHERE ID='".$usrid."'");
             if($usname==""){
                  $msg1="";
			$msg1.= "No User Found<br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
           
         }
        }
               
       
        
        $add=1;
    }

    if(isset($_POST['get_uid'])){

            $usname=$_POST['uname'];
             if($usname==""){
                  $msg1="";
			$msg1.= "Please enter User-name<br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
            
        }else{            	
            $usrid=get_var("SELECT ID from wp_users WHERE user_login='".$usname."'");
             if($usrid==""){
             $msg1="";
			$msg1.= "No User Found<br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
            }
        }
           
            $add=1;
            
    }


	if(isset($_POST['Add_Submit'])){
		
		$uname=$unam=trim($_POST['user_name']);
        $unam=strtolower(preg_replace('/\s+/', '', $unam));
		$uid=trim($_POST['user_id']);
		        
				
		$stmt21 = $dbcon->prepare('SELECT * FROM user_video_accesslist WHERE user_id = '.$uid.'  ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt21->execute();
		$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
		$asaucexist1 = count($result21);	
		$stmt21=null;

        //$sql='SELECT * FROM promocodes_vs_shows WHERE LOWER(REPLACE(assigned_to," ","")) = "'.$assign.'" ';
        $sql='SELECT * FROM user_video_accesslist WHERE LOWER(REPLACE(user_name," ","")) = "'.$unam.'"  ';
       // echo $sql; exit;
		$stmt21 = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt21->execute();
		$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
		$asaucexist2 = count($result21);	
		$stmt21=null;

		if((int)$asaucexist1 > 0){

			$msg1="";
			$msg1.= "This user id already exist <br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
			
		}elseif((int)$asaucexist2 > 0){

			$msg1="";
			$msg1.= "This user name already exist <br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";

		}
		
		else{	
						
			
            //echo 'INSERT INTO user_video_accesslist(user_id,user_name) VALUES('.$uid.',"'.$uname.'")';
			$stmt22 = $dbcon->prepare('INSERT INTO user_video_accesslist(user_id,user_name) VALUES('.$uid.',"'.$uname.'")', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt22->execute();
			echo $asauc_id = $dbcon->lastInsertId();

			

			$msg = "<span style='color:green'>User granted access sucessfully</span>";
						
		
		}
	}


	


    if($x==1){
        $action = "Add";
        $asaucid1 = "";
        $name1 = $email1 = "";
        $password1 = $admin_level1 = "";


    }
?>

        <style>
            .xoouserultra-field-value,
            .xoouserultra-field-type {
                width: unset !important;
                padding: 5px;
            }
            
            form[name="f_timezone"] {
                display: none;
            }
            
            #search_shpc>input[type="text"] {
                max-width: 250px;
            }
            
            .link_btn:hover {
                background: #000;
                color: #fff;
                border: solid 1px #000;
            }
            
            .link_btn:visited {
                color: white !important
            }
            
            .link_btn {
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
                text-decoration: none;
                border-radius: 5px;
            }
        </style>

        <h2 style="text-align:center"></h2>

        <?php		

	//if($_SESSION['adminlevel']<=1){
		if ($action=="Edit"){ 
			echo "<style>#add_asauc_btn{display:none} #asauc-form-section{display:block !important;}</style>";
		}
        

?>
            <section class="section"><h2></h2>
                <span style="float:"></span>
                <div class="msg" align="center" style="display:inline-block">
                    <h4>
                        <?php echo $msg;?>
                    </h4>
                </div>
                <div class="row sameheight-container">
                    <div class="col-md-3">
                        <button id="add_asauc_btn" class="btn btn-primary" onclick="return asauc_form()">Add User</button>
                    </div>
                    <div class="col-md-6">
                        <div id="asauc-form-section" class="card card-block sameheight-item" style="display:none;height:auto;/*height: 721px;*/">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="header-block">
                                        <p class="title">
                                            <?php echo $action; ?> User </p>
                                    </div>
                                </div>
                                <div class="xoouserultra-field-value" style="">
                                    <div id='error' style='color:red;'></div>
					</div>
					<div class="card-block ">
                                    <div id="content">
										<section class="last">
											<h2>First Get User Info </h2>

											<p>
                                                <form method="post">
                                                Enter Username : 
                                                <input type="text" name="uname" id="uname" /> 
                                                <input type="submit" name="get_uid" value="Get UserId" />  
                                                
                                                <br>or<br>

                                                Enter UserId: <input type="text" name="uid" id="uid" /> 
                                                <input type="submit" name="get_uname" value="Get Username" />  
                                                
                                              
                                                </form>

 										</p>

											<!-- a href="#" class="button icon fa-arrow-circle-right">Continue Reading</a -->
										</section>
									</div>

                                    <form role="form" method='post' enctype="multipart/form-data">
				
                                        <div class="form-group"> <label class="control-label">UserId</label> <input readonly style="" onclick="clearError()" onkeypress="return event.charCode !=32" type="text" value="<?php echo @$usrid;?>" id="user_id" name="user_id" class="form-control underlined"> </div>
                                        <div class="form-group"> <label class="control-label">UserName</label> <input readonly style="" onclick="clearError()" onkeypress="return event.charCode !=32" type="text" value="<?php echo @$usname;?>" id="user_name" name="user_name" class="form-control underlined"> </div>
                                        																		
                                       
                                        <div class="xoouserultra-field-value" style="padding-left: 10px;">
                                         									
                                            <input class="btn btn-primary" type="submit" onclick="return callsubmit();" name="<?php echo $action;?>_Submit" value="Check and Submit" />
                                           									
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
            <?php //}

if($_SESSION['adminlevel']<=1){
?>


          <!--  <section class="section" style="margin:100px auto">
 <div class="col-md-3">
                             
                            </div>
<div id="search_sub_list" align="center" style="margin:15px auto;" class="col-md-6">

        Search using any criteria: <br />
	<div class="form-group"> 
		<input placeholder="Enter PromoCode" id="searchPC" type="text" name="searchPC" class="form-control boxed"><span class="_or"> </span> 
	</div>	
	<div class="form-group"> 
		<input placeholder="Enter Creator" id="searchCr" type="text" name="searchCr" class="form-control boxed"><span class="_or"> </span> 
	</div>	
	<div class="form-group"> 
		<input placeholder="Enter Assigned group" id="searchAs" type="text" name="searchAs" class="form-control boxed"><span class="_or"> </span> 
	</div>	
	<div class="form-group"> 
		<input placeholder="Enter Promocode Status-active/deactivated" id="searchSt" type="text" name="searchSt" class="form-control boxed"><span class="_or"> </span> 
	</div>	
	

	</div>
 <div class="col-md-3">
                             
                            </div>
   </section> -->

<?php

}

?>

            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-title-block">
                                    <h3 class="title">
                                        QP video-access USERS
                                    </h3>
                                </div>
                                <section class="example">
                                    <form id="frm2" method="post">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">

                                                <thead>
                                                 <?php //}

if($_SESSION['adminlevel']<=1){
?>
                                                  <!--  <tr>
                                                        <th><input placeholder="Search PromoCode" id="searchPC" type="text" name="searchPC" class="form-control boxed"><span class="_or"> </span></th>
                                                        <th><input placeholder="Search Creator" id="searchCr" type="text" name="searchCr" class="form-control boxed"><span class="_or"> </span></th>
                                                        <th><input placeholder="Search Assigned group" id="searchAs" type="text" name="searchAs" class="form-control boxed"><span class="_or"> </span></th>
                                                        <th><input placeholder="Search Status-active/deactivated" id="searchSt" type="text" name="searchSt" class="form-control boxed"><span class="_or"> </span></th>
                                                        <th colspan='3' style='text-align:center;font-size:large'><i class='fa fa-arrow-left' aria-hidden='true'></i> Search</th>
                                                    </tr> -->
<?php
}
?>
                                                    <tr>
                                                        <th><i>User Id</i></th>
                                                         <th>User Name</th>
                                                        <th> Action <i class="fa fa-cog"></i></th>
                                                        <?php		
					
						if($_SESSION['adminlevel']<=0){ 
							
					?>

                                                            

                                                            <?php 
                                                            $sql="SELECT * FROM user_video_accesslist order by user_id desc";
					
						} else
                        {
                                    $sql="SELECT * FROM user_video_accesslist order by user_id desc";
                        }
					?>
                                                    </tr>
                                                </thead>
                                                <tbody id="asauc_list" class="ui-sortable">
                                                    <?php

				$stmt4 = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
				$stmt4->execute();
				
				$result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
				$stmt4=null;
               if(count($result4)>0){

               
				foreach($result4 as $row){

					$id=$row['id'];
					$user_name=$row['user_name'];
					$user_id=$row['user_id'];
					
					
            ?>
                                                        <tr style="" class="ui-sortable-handle">
                                                            <td class="level_name">
                                                                <?php echo $user_id;?>
                                                            </td>
                                                            <td style="" class="level_name">
                                                                <?php echo $user_name;?>
                                                            </td>
                                                                                                                       
                                                           <td style="width: 200px;">
                                                                <a style="cursor:pointer;" id="removeAsauc" name="removeAsauc" onclick="return confirmDelAsauc(<?php echo $id;?>)"><i class="fa fa-trash" aria-hidden="true">Delete</i></a>
                                                                </td>


                                                        </tr>
                                                        <?php 
	} 
    }//if
    else{
        echo "<tr style='text-align:center'><td colspan='4'>No Results</td></tr>";
    }
?>
                                                </tbody>
                                                <tr id="no_res_div" align="center" style="margin: 5px auto; border-bottom: 1px solid #999;  max-width: 80%;
    font-size: 15px;">
                                                    <td colspan="4" id="no_res" style="margin:0 auto;text-align:center"></td>
                                                </tr>
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

                
               
                 function validateEmail(email) {
                    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                }

               
                
                function callsubmit() {

                    $("#asauc-form-section").css("height", "auto");


                    //var x=document.getElementById('user_id').value;
                  //  alert(x);
                    var username = $("#user_name").val();
                    var userid = $("#user_id").val();
                                       

                    if (userid == "") {
                        $("#error").html("Please get user id");
                        return false;
                    }
                    if (username == "") {
                        $("#error").html("Please get a username");
                        return false;
                    }

                                     



                    if (userid != "" && username != "" ) {
                        return true;
                    }

                    return false;

                }


                
                function clearError() {

                    $("#error").html("");
                    $(".msg h4").html("");
                }


                function confirmDelAsauc(Delid) {

                    swal({
                        title: ' ',
                        text: 'Do you really want to delete this user-access ?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        cancelButtonText: "Cancel",
                        closeOnCancel: true
                    }, function() {
                        var input1 = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "delAsaucid").val(Delid);
                        var input2 = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "delAsauc").val(true);
                        $('#frm2').append($(input1));
                        $('#frm2').append($(input2));
                        $("#frm2").submit();

                    });

                }

                function confirmEditAuc(Editid) {

                    swal({
                        title: ' ',
                        text: 'Do you want to edit this info?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Edit",
                        cancelButtonText: "Cancel",
                        closeOnCancel: true
                    }, function() {
                        var input1 = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "editAsaucid").val(Editid);
                        var input2 = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "editAsauc").val(true);
                        $('#frm2').append($(input1));
                        $('#frm2').append($(input2));
                        $("#frm2").submit();

                    });

                }

        

                $("#asauc-form-section").css("height", "auto");

                function asauc_form() {

                  //  $("#name").val("");
                 //   $("#email").val("");
                   // $("#password").val("");
                     // $("#admin_level").val("");
//
                    var s = document.getElementById("asauc-form-section");

                    if (s.style.display == "none") {
                        jQuery("#asauc-form-section").show();
                    } else {
                        jQuery("#asauc-form-section").hide();
                    }
                }


                if ($("tr#no_res_div td").html() == "") {
                    $("tr#no_res_div").hide();
                }

                <?php

                    if($add==1){

                            ?>
                            asauc_form();
                        <?php
                    }

                ?>

            </script>

</article>

<?php

include('footer.php');
?>