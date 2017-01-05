<?php

/* Includes config,db and table definitions and common functions files */	


define("DB_SERVER","192.169.213.239");	
define("DB_USER","qezyplay_word");
define("DB_PASSWORD","&(word_qezyplay)&");
define("DB_NAME","qezyplay_wordpress");

define("TOKEN_SECRET_KEY", "QezyplayIB");

define("ADMIN_EMAIL1", "admin@qezyplay.com");
define("ADMIN_EMAIL", "siddish.gollapelli@ideabytes.com");

define("SITE_URL", "https://qezyplay.com");
define("SITE_NAME", "https://qezyplay.com");


/* Include db & data files */
require_once("common_functions.php");
require_once("classes/dbconfig.class.php");  //DB connection
require_once("classes/servicedata.class.php");


?>
