<?php /* Template Name: CCDETAIL */ ?>
<?php
   global $wpdb;
get_header();

?>
<?php 

if(isset($_POST['skip']))
{

global $current_user;
get_currentuserinfo();

session_start();

$user_id=$_SESSION['id'];

//$user_info=get_userdata($user_id);
//$username=$user_info->user_login;
//$password=$user_info->user_pass;



$user = get_user_by( 'id', $user_id ); 
if( $user ) {
    wp_set_current_user( $user_id, $user->user_login );
    wp_set_auth_cookie( $user_id );
    do_action( 'wp_login', $user->user_login );
wp_redirect( '../' );
}
}


function validateCC($cc_num, $type) {

	if($type == "American") {
	$denum = "American Express";
	} elseif($type == "Dinners") {
	$denum = "Diner's Club";
	} elseif($type == "Discover") {
	$denum = "Discover";
	} elseif($type == "Master") {
	$denum = "Master Card";
	} elseif($type == "Visa") {
	$denum = "Visa";
	}

	if($type == "American") {
	$pattern = "/^([34|37]{2})([0-9]{13})$/";//American Express
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Dinners") {
	$pattern = "/^([30|36|38]{2})([0-9]{12})$/";//Diner's Club
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Discover") {
	$pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Master") {
	$pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Visa") {
	$pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}

	}

	if($verified == false) {
	//Do something here in case the validation fails
	
//$denum = trim($_POST['ctype']);
echo "<div class='ccErr_msg' align='center'><h2 style='color:#ea0000;'>Credit card invalid.<br />Please enter a valid <em>" . $denum . "</em> credit card </h2></div>";

/*global $wpdb;

$id = trim($_POST['id']);
$mail = trim($_POST['mail']);

$type = trim($_POST['ctype']);
$name = trim($_POST['uname']);
$ccno = trim($_POST['ccno']);
$cvvno = trim($_POST['cvvno']);
$validto = trim($_POST['validto']);
//$validto .= trim($_POST['validtoy']);
$validtoy = trim($_POST['validtoy']);
$wpdb->insert("wp_users", array(
   "cardtype" => $type,
   "cname" => $name,
   "ccnumber" => $ccno, 
"ccnumber" => $ccno,
"cvvno" => $cvvno,
"validdate" => $validto,
"validyear" => $validtoy
));

$wpdb->update( "wp_users", array("cardtype" => $type,
   "cname" => $name,
   "ccnumber" => $ccno, 
"ccnumber" => $ccno,
"cvvno" => $cvvno,
"validdate" => $validto,
"validyear" => $validtoy),array('ID'=>$id, 'user_email'=>$mail));*/


	} else { //if it will pass...do something
global $wpdb;

$id = trim($_POST['id']);
$mail = trim($_POST['mail']);

$type = trim($_POST['ctype']);
$name = trim($_POST['uname']);
$ccno = trim($_POST['ccno']);
$cvvno = trim($_POST['cvvno']);
$validto = trim($_POST['validto']);
//$validto .= trim($_POST['validtoy']);
$validtoy = trim($_POST['validtoy']);


/*$wpdb->insert("wp_users", array(
   "cardtype" => $type,
   "cname" => $name,
   "ccnumber" => $ccno, 
"ccnumber" => $ccno,
"cvvno" => $cvvno,
"validdate" => $validto,
"validyear" => $validtoy
));*/

$wpdb->update( "wp_users", array("cardtype" => $type,
   "cname" => $name,
   "ccnumber" => $ccno, 
"ccnumber" => $ccno,
"cvvno" => $cvvno,
"validdate" => $validto,
"validyear" => $validtoy),array('ID'=>$id, 'user_email'=>$mail));


	echo "<div align='center'><h2 style='color:#28d500;'>Your <em>" . $denum . "</em> credit card is valid</h2>
<br /> <h4>Thank you for registering with us. Please check your email for login details.</h4>
</div><div style='height:540px;'><div style='display:none;height:540px;'>";
	}


}
//echo validateCC("1738292928284637", "Dinners").'<br />';

//$ccno = "1738292928284637"; 
//$type = "Dinners";

//$ccno = '' ;
//$type = 'Visa';
//echo validateCC($ccno, $type).'<br />';

if(isset($_POST['Validate'])){

$type = trim($_POST['ctype']);
$name = trim($_POST['uname']);
$ccno = trim($_POST['ccno']);
$validto = trim($_POST['validto']);
$validtoy = trim($_POST['validtoy']);


echo validateCC($ccno, $type); //1738292928284637

//echo 'rtryr';

}
?>
<div id="body">
<div class="container">
            <div class="row">
            						<div id="content" class="col-md-12" role="main">
					<article class="post-1817 page type-page status-publish hentry">	

           
    <div class="content-single">
<div class="user_wel" style="float:left;padding-left: 13%; width:50%">
<h2>Just one more step to finish your registration.<br /> Please fill in the details:</h2><br />
<h4>Don't worry no charges will be applied, as the registration is completely FREE.</h4>
<h4>You can skip this step now and come back later to fill.</h4>
<form id="skip" method="post" ><input type="submit" name="skip" Value="Skip this step" /> 
</form>
</div>


<div class="cc_table" align="center" style="float:right;width: 50%;
margin-top: -20px;">
<form method="post">

<table><tr><td>
Card Type</td><td>
<?php 
global $wpdb;

 $active_rows = $wpdb->get_results(
        " SELECT *
          FROM wp_users
        "
    ); 

 foreach ($active_rows as $active_row){
        $id = $active_row->ID; 
$mail = $active_row->user_email; 
    }



?>
<input type="hidden" name="id" value="<?php echo $id;  ?>" style="width: 100%;" required/>
<input type="hidden" name="mail" value="<?php echo $mail; ?>" style="width: 100%;" required/>
<select name="ctype" style="width: 100%;" required>
<option value="">Select Type</option>
<option value="American"> American Express</option>
<option value="Discover">Discover</option>
<option value="Master">MasterCard</option>
<option value="Visa">Visa</option>
</select><td></tr>
<tr><td>Name on Card</td><td><input type="text" name="uname" style="width: 100%;" required/></td></tr>
<tr><td>Credit Card No</td><td><input type="text" name="ccno" style="width: 100%;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/></td></tr>
<tr><td>CVV</td><td><input type="password" name="cvvno" style="width:45px" required/></td></tr>
<tr><td>Valid upto Month</td><td><select name="validto" style="width:59px" required>
<option value="">Month</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select></td></tr>
<tr><td>Year</td><td> <select name="validtoy" style="width:59px" required>
<option value="">Year</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
<option value="2026">2026</option>
<option value="2027">2027</option>
<option value="2028">2028</option>
</select></td></tr>
</table><br><p style="text-align:center;"><input type="submit" name="Validate" Value="Finish Registration" /></p>
</form>
</div></div></div>
</div></article></div></div></div></div>
<?php 

get_footer(); ?>