<?php


if(isset($_GET['logout'])){

	unset($_SESSION['adminid']);

	header('Location:http://admin.qezyplay.com/qp1/login.php');
	exit;
}



if($_SESSION['adminid'] == ""){
	$page=urlencode($_SERVER["SERVER_NAME"].$_SERVER["REDIRECT_URL"]);
	header('Location:login.php?redirect='.$page);
	exit;
	
}
	

?>
