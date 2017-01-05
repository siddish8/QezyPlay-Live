<?php 
	include('header.php');
?>
<style>
.disabled{cursor:not-allowed !important;pointer-events:none;opacity:0.4}

</style>

<article class="content items-list-page">

    <?php

	$msg = ""; $action = "Add";

	if(isset($_REQUEST['delAuc'])){

		$id = $_REQUEST['delAucid'];

             

       $sql1="DELETE FROM admin_portal_users where id=".$id."";

		$stmt11 = $dbcon->prepare($sql1, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt11->execute();
		$stmt11=null;

		$msg = "<span id='msg' style='color:green'>Deleted Successfully</span>";
		
	}


	if(isset($_POST['Add_Submit'])){
		
		$name=$nam=trim($_POST['name1']);
        $nam=strtolower(preg_replace('/\s+/', '', $nam));
		$email=$mail=trim($_POST['email']);
		$mail=strtolower(preg_replace('/\s+/', '', $mail));
        $admin_level=$_POST['admin_level'];
        $password=$_POST['password'];
		//$date = gmdate("Y-m-d H:i:s");
		
		$stmt21 = $dbcon->prepare('SELECT * FROM admin_portal_users WHERE LOWER(REPLACE(name," ","")) = "'.$nam.'"  ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt21->execute();
		$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
		$aucexist1 = count($result21);	
		$stmt21=null;

        //$sql='SELECT * FROM promocodes_vs_shows WHERE LOWER(REPLACE(assigned_to," ","")) = "'.$assign.'" ';
        $sql='SELECT * FROM admin_portal_users WHERE LOWER(REPLACE(email," ","")) = "'.$mail.'"  ';
       // echo $sql; exit;
		$stmt21 = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt21->execute();
		$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
		$aucexist2 = count($result21);	
		$stmt21=null;

		if((int)$aucexist1 > 0){

			$msg1="";
			$msg1.= "This admin name already exist <br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
			
		}elseif((int)$aucexist2 > 0){

			$msg1="";
			$msg1.= "This admin email already exist <br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";

		}
		
		else{	
						
			
			$stmt22 = $dbcon->prepare('INSERT INTO admin_portal_users(name,email,password,admin_level) VALUES("'.$name.'","'.$email.'","'.$password.'",'.$admin_level.')', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
			$stmt22->execute();
			$auc_id = $dbcon->lastInsertId();

			

			$msg = "<span style='color:green'>Admin created sucessfully</span>";
						
		
		}
	}


	if(isset($_POST['Edit_Submit'])){
		
		$aucid=trim($_POST['aucid']);
		$name=$nam=trim($_POST['name1']);        
		$nam=strtolower(preg_replace('/\s+/', '', $nam));
		$email=$mail=trim($_POST['email']);
		$mail=strtolower(preg_replace('/\s+/', '', $mail));
        $admin_level=$_POST['admin_level'];
        $password=$_POST['password'];

        $stmt21 = $dbcon->prepare('SELECT * FROM admin_portal_users WHERE LOWER(REPLACE(name," ","")) = "'.$nam.'"  AND id != "'.$aucid.'" ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt21->execute();
		$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
		$aucexist1 = count($result21);	
		$stmt21=null;

        //$sql='SELECT * FROM promocodes_vs_shows WHERE LOWER(REPLACE(assigned_to," ","")) = "'.$assign.'" ';
        $sql='SELECT * FROM admin_portal_users WHERE LOWER(REPLACE(email," ","")) = "'.$mail.'"  AND id != "'.$aucid.'" ';
       // echo $sql; exit;
		$stmt21 = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
		$stmt21->execute();
		$result21 = $stmt21->fetchAll(PDO::FETCH_ASSOC);
		$aucexist2 = count($result21);	
		$stmt21=null;

			
		if((int)$aucexist1 > 0){

			$msg1="";
			$msg1.= "This admin name already exist <br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";
			
		}elseif((int)$aucexist2 > 0){

			$msg1="";
			$msg1.= "This admin email already exist <br>";
			$msg = "<span id='msg' style='color:red'>".$msg1."</span>";

		}
		
		else{	
										
			//update query
	
			$stmt22 = $dbcon->prepare('UPDATE admin_portal_users SET name = "'.$name.'", email = "'.$email.'", password = "'.$password.'", admin_level='.$admin_level.' WHERE id = '.$aucid.' ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	 
			$stmt22->execute();

			$stmt22=null;
		
			$msg = '<span style="color:green;">Info updated Successfully</span>';

            $x=1;
									
		
	}

	}

	if(isset($_REQUEST['editAuc'])){

		$id = $_REQUEST['editAucid'];		

		$stmt1 = $dbcon->prepare("SELECT * FROM admin_portal_users where id='".$id."'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt1->execute();
		$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $stmt1 = null;
		foreach($result1 as $row1){
			$aucid1=$id;
			$name1=$row1['name1'];
			$email1=$row1['email'];
            $password1=$row1['password'];
			$admin_level1=$row1['admin_level'];
			
		}
		
		$action = "Edit";

	}	


    if($x==1){
        $action = "Add";
        $aucid1 = "";
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
			echo "<style>#add_auc_btn{display:none} #auc-form-section{display:block !important;}</style>";
		}
        

?>
            <section class="section">
                <span style="float:"></span>
                <div class="msg" align="center" style="display:inline-block">
                    <h4>
                        <?php echo $msg;?>
                    </h4>
                </div>
                <div class="row sameheight-container">
                    <div class="col-md-3">
                        <button id="add_auc_btn" class="btn btn-primary" onclick="return auc_form()">Add Admin</button>
                    </div>
                    <div class="col-md-6">
                        <div id="auc-form-section" class="card card-block sameheight-item" style="display:none;height:auto;/*height: 721px;*/">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="header-block">
                                        <p class="title">
                                            <?php echo $action; ?> Admin </p>
                                    </div>
                                </div>
                                <div class="xoouserultra-field-value" style="">
                                    <div id='error' style='color:red;'></div>
					</div>
					<div class="card-block ">
                                    <form role="form" method='post' enctype="multipart/form-data">
					<input type="hidden" id="aucid" name="aucid" value="<?php echo $id; ?>"/>

                                        <div class="form-group"> <label class="control-label">Name</label> <input style="" onclick="clearError()" onkeypress="return event.charCode !=32" type="text" value="<?php echo @$name1;?>" id="name" name="name1" class="form-control underlined"> </div>
                                        <div class="form-group"> <label class="control-label">Email</label> <input style="" onclick="clearError()" onkeypress="return event.charCode !=32" type="text" value="<?php echo @$email1;?>" id="email" name="email" class="form-control underlined"> </div>
                                        <div class="form-group"> <label class="control-label">Password</label> <input style="" onclick="clearError()" onkeypress="return event.charCode !=32" type="password" value="<?php echo @$password1;?>" id="password" name="password" class="form-control underlined"> </div>
                                        <div class="form-group"> <label class="control-label">Admin-Level</label> <input style="" onclick="clearError()" onkeypress="return event.charCode !=32" type="text" value="<?php echo @$admin_level1;?>" id="admin_level" name="admin_level" class="form-control underlined"> </div>
																		
                                       
                                        <div class="xoouserultra-field-value" style="padding-left: 10px;">
                                            <?php 
									if($action=="Edit"){
								?>
                                            <input type="hidden" name="editAuc" value="true" />
                                            <input type="hidden" name="editAucid" value="<?php echo @$aucid1;?>" />
                                            <?php 
									} 
								?>
                                            <input class="btn btn-primary" type="submit" onclick="return callsubmit();" name="<?php echo $action;?>_Submit" value="Submit" />
                                            <?php
									if($action=="Edit"){
								?>
                                                <a class="btn btn-primary" href="<?php echo SITE_URL.'/qp1/admin-user-control.php'?>">Back</a>
                                                <?php
								   } 
								?>
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
                                        Admin-Portal Users
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
                                                        <th><i>Name</i></th>
                                                        <th>Email</th>
                                                        <th>Admin-Level</th>
                                                        <th>Password</th>
                                                        <th> Action <i class="fa fa-cog"></i></th>
                                                        <?php		
					
						if($_SESSION['adminlevel']<=0){ 
							
					?>

                                                            

                                                            <?php 
                                                            $sql="SELECT * FROM admin_portal_users";
					
						} else
                        {
                                    $sql="SELECT * FROM admin_portal_users";
                        }
					?>
                                                    </tr>
                                                </thead>
                                                <tbody id="auc_list" class="ui-sortable">
                                                    <?php

				$stmt4 = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));	
				$stmt4->execute();
				
				$result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
				$stmt4=null;
               if(count($result4)>0){

               
				foreach($result4 as $row){

					$id=$row['id'];
					$name=$row['name'];
					$email=$row['email'];
                    $pwd=$row['password'];
					$admin_level=$row['admin_level'];
					
					
            ?>
                                                        <tr style="" class="ui-sortable-handle">
                                                            <td class="level_name">
                                                                <?php echo $name;?>
                                                            </td>
                                                            <td style="" class="level_name">
                                                                <?php echo $email;?>
                                                            </td>
                                                            <td style="" class="level_name">
                                                                <?php echo $admin_level;?>
                                                            </td>

                                                            <td style="" class="level_name">
                                                                <span id="a<?php echo $id;?>" onclick="showhideAB(<?php echo $id ?>)">********</span>
                                                                <span id="b<?php echo $id;?>" onclick="showhideAB(<?php echo $id ?>)" style="display:none"><?php echo $pwd;?></span>
                                                            </td>
                                                            
                                                           <td style="width: 200px;">
                                                                    <a style="cursor:pointer;" id="editAuc" name="editAuc" onclick="return confirmEditAuc(<?php echo $id;?>)"><em title="Edit" class="fa fa-pencil"> Edit</em></a> &nbsp;
                                                                    <a style="cursor:pointer;" id="removeAuc" name="removeAuc" onclick="return confirmDelAuc(<?php echo $id;?>)"><i class="fa fa-trash" aria-hidden="true">Delete</i></a>
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
               
                function showhideAB(id){

                   //var str = id;
                    //var res = str.substring(0, 1);

                    var a=jQuery("#a"+id).css("display");
                    var b=jQuery("#b"+id).css("display");

                    if(a=="none"){
                        jQuery("#a"+id).show();
                        jQuery("#b"+id).hide();
                    }else{
                         jQuery("#b"+id).show();
                        jQuery("#a"+id).hide();
                    }


                }

                function validateEmail(email) {
                    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                }

                function validatePhone(phone) {
                    var re = /^([0|\+[0-9]{1,5})?([1-9][0-9]{9})$/;
                    return re.test(phone);
                }

                function validatePromo(pc){
                    var re=/^(?!Q)(?!0)[A-Z0-9]{6,12}$/;
                    return re.test(pc);
                }

                function callsubmit() {

                    $("#auc-form-section").css("height", "auto");

                    var name = $("#name").val();
                    var email = jQuery("#email").val();
                    var password = $("#password").val();
                    var admin_level = jQuery("#admin_level").val();

                       
                    var check=validateEmail(email);
                    

                    if (name == "") {
                        $("#error").html("Please enter a name");
                        return false;
                    }

                    

                    if (email == "") {
                        $("#error").html("Please enter email");
                        return false;
                    }else if (!check) {
                            $("#error").html("Please Enter valid email");
                        return false;
                    }

                    if (password == "") {
                        $("#error").html("Please enter a password");
                        return false;
                    }

                    if (admin_level == "") {
                        $("#error").html("Please enter admin-level");
                        return false;
                    }



                    if (email != "" && email != "" && password != "" && admin_level != "") {
                        return true;
                    }

                    return false;

                }


                
                function clearError() {

                    $("#error").html("");
                    $(".msg h4").html("");
                }


                function confirmDelAuc(Delid) {

                    swal({
                        title: ' ',
                        text: 'Do you really want to delete this Admin ?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        cancelButtonText: "Cancel",
                        closeOnCancel: true
                    }, function() {
                        var input1 = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "delAucid").val(Delid);
                        var input2 = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "delAuc").val(true);
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
                            .attr("name", "editAucid").val(Editid);
                        var input2 = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "editAuc").val(true);
                        $('#frm2').append($(input1));
                        $('#frm2').append($(input2));
                        $("#frm2").submit();

                    });

                }

        

                $("#auc-form-section").css("height", "auto");

                function auc_form() {

                    $("#name").val("");
                    $("#email").val("");
                    $("#password").val("");
                      $("#admin_level").val("");

                    var s = document.getElementById("auc-form-section");

                    if (s.style.display == "none") {
                        jQuery("#auc-form-section").show();
                    } else {
                        jQuery("#auc-form-section").hide();
                    }
                }


                if ($("tr#no_res_div td").html() == "") {
                    $("tr#no_res_div").hide();
                }

            </script>

</article>

<?php

include('footer.php');
?>