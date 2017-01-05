<?php


ini_set('max_execution_time', 0);
set_time_limit(0);

require_once("includes/header.inc.php");
require_once("service.php");

class APIService extends Service{
		
	public $db = null;	
	public $request = null;	
	public $resData = "";	
	
	public function __construct(){
		$this->dbConnect();// Initiate Database connection
	}

	public function __destruct(){
		$this->dbClose();// Close Database connection
	}	

	//Public method for access api.
	//This method dynmically call the method based on the query string
	public function processApi(){

		$this->request = @$_REQUEST['request'];
		$apiRequest = explode("/",$this->request);
		$func = $apiRequest[0];
				
		if((int)method_exists($this,$func) > 0){
			$this->$func(@$apiRequest[1]);
		}else{
			header('HTTP/1.1 404 Not found');
			exit;
		}
			
		// If the method not exist with in this class, response would be "Page not found".
	}

	public function register(){ $this->handleRegister(); }	
	public function login(){ $this->handleLogin(); }	
		
	//Encode array into JSON
	public function response($data){

		if(is_array($data)){
			header('Content-Type: application/json');
			echo json_encode($data,JSON_PRETTY_PRINT);
			exit;
		}else{
			header('error: '.htmlspecialchars($data), false);
			exit;
		}
	}
}


// Initiiate Library
$api = new APIService;
$api->processApi();
//echo "test";
exit;
?>
