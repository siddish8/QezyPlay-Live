<?php

ob_start();
session_start(); 

//qp_gd for present godaddy server
//qp_aws_live for new AWS server LIVE/production
define("SERVER", "qp_aws_live");
//https://qezyplay.com
//http://34.195.236.248/qezyplay
$site=SERVER;

if($site=="qp_gd")
{

define("URL_SITE", "https://qezyplay.com");
define("DB_HOST", "192.169.213.239");
define("DB_USERNAME", "qezyplay_word");
define("DB_PASSWORD", "&(word_qezyplay)&");
define("DB_NAME", "qezyplay_wordpress");

define("ENV", "live");  //dev (or) live

}

if($site=="qp_aws_live")
{

define("URL_SITE", "http://admin.qezyplay.com");
define("DB_HOST", "ideabytesdb.c6hujshgwzfd.us-east-1.rds.amazonaws.com");
define("DB_USERNAME", "qezyplay_prod");
define("DB_PASSWORD", "&(prod_qezyplay)&");
define("DB_NAME", "qezyplay_wp");

define("ENV", "live");  //dev (or) live

}

if($site=="qp_aws_dev")
{

define("URL_SITE", "http://qezy.tv");
define("DB_HOST", "ideabytesdb.c6hujshgwzfd.us-east-1.rds.amazonaws.com");
define("DB_USERNAME", "qezyplay_prod");
define("DB_PASSWORD", "&(prod_qezyplay)&");
define("DB_NAME", "qezyplay_wp");

define("ENV", "live");  //dev (or) live

}

define("ADMIN_EMAIL", "siddish.gollapelli@ideabytes.com");
define("ADMIN_EMAIL1", "admin@qezyplay.com");

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: QezyPlay Analytics <admin@qezyplay.com>' . "\r\n";

define("HEADERS",$headers);

define("SITE_URL", URL_SITE);
define('ABSPATH', dirname(__DIR__));

date_default_timezone_set("UTC");

$media=ABSPATH."/wp-content/uploads/".date('Y')."/".date('m');
$media1=SITE_URL."/wp-content/uploads/".date('Y')."/".date('m');
$upload1=SITE_URL."/wp-content/uploads/";

define("UPLOAD_FOLDER","wp-content/uploads");
define("UPLOAD_FOLDER1",$upload1);
define("DATED_PATH",date('Y')."/".date('m'));
define("MEDIA_FOLDER", $media);
define("MEDIA_FOLDER_LINK", $media1);

 

define("ROW_PER_PAGE", "10");
$timezone_array = array("-12.0"=>"-12:00","-11.0"=>"-11:00","-10.0"=>"-10:00","-9.0"=>"-09:00",
		"-8.0"=>"-08:00","-7.0"=>"-07:00","-6.0"=>"-06:00","-5.0"=>"-05:00",
		"-4.0"=>"-04:00","-3.5"=>"-03:30","-3.0"=>"-03:00","-2.0"=>"-02:00",
		"-1.0"=>"-01:00","0.0"=>"+00:00","1.0"=>"+01:00","2.0"=>"+02:00",
		"3.0"=>"+03:00","3.5"=>"+03:30","4.0"=>"+04:00","4.5"=>"+04:30",
		"5.0"=>"+05:00","5.5"=>"+05:30","5.75"=>"+05:45","6.0"=>"+06:00",
		"7.0"=>"+07:00","8.0"=>"+08:00","9.0"=>"+09:00","9.5"=>"+09:30",
		"10.0"=>"+10:00","11.0"=>"+11:00","12.0"=>"+12:00");

//echo 'Time zone is :'.$_GET['timezone'];
//Settig the TimeZone Coocki
$coockie = ''; $visitorTimezone = '';
if (!isset($_COOKIE['timezone'])) {
    if (isset($_GET['timezone'])) {
        //$coockie = $_GET['timezone'];
		$coockie = $timezone_array[$_GET['timezone']];
        setcookie('timezone', $coockie);        
    } else {
		//$visitorTimezone = getVisitorTimezone();
		//echo " ip   ".$_SERVER['REMOTE_ADDR'];
		$visitorTimezone = ($visitorTimezone == "") ? "+00:00" : $visitorTimezone;
        setcookie('timezone', $visitorTimezone);
        $coockie = $visitorTimezone;
		
    }
     //echo ' Cocki not set , setting initially';
	 
} else {
    if (isset($_GET['timezone'])) {
        //$coockie = $_GET['timezone'];
		$coockie = $timezone_array[$_GET['timezone']];
        setcookie('timezone', $coockie);       
    } else {
        
        $coockie = $_COOKIE['timezone'];
    }
}



try{
    	
	$dbcon = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", "".DB_USERNAME."", "".DB_PASSWORD."");	 //LIVE

}
catch(PDOException $e){
    echo $e->getMessage();    
}

