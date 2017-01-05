<?php

ob_start();

session_start(); 

$site="live"; //dev change this only

echo $site;
if($site=="live")
{
try{
	//$dbcon = new PDO("mysql:host=localhost;dbname=qezyplay_shonarbangla", "qezyplay_shonarb", "&(qezy@word)&"); //QP SB
	$dbcon = new PDO("mysql:host=45.40.160.28;dbname=qezyplay_newshonar", "qezyplay_shonarb", "&(qezy@word)&");	 //QP newShonar
	
}
catch(PDOException $e){
    echo $e->getMessage();    
}

define("SITE_URL", "http://shonarbangla.qezyplay.com/");
define("ENV", "live");  //dev (or) live paypal

define("ADMIN_EMAIL", "admin@qezyplay.com");

}

