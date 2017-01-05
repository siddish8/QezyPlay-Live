<?php

/* * ****************************************************************
 * Ideabytes Software India Pvt Ltd.                              *
 * 50 Jayabheri Enclave, Gachibowli, HYD                          *
 * Created Date : 22/01/2014                                      *
 * Created By : Pradeep G                                         *
 * Vision : Project Sparkle                                       *  
 * Modified by : Pradeep G     Date : 05/02/2014    Version : V1  *
 * Description : Common functions                                 *
 * *************************************************************** */

function doPages($page_size, $thepage, $query_string, $total = 0, $tab="") {
    //per page count
    $index_limit = 5;


    //set the query string to blank, then later attach it with $query_string
    $query = '';

    if (strlen($query_string) > 0) {
        $query = "&" . $query_string;
    }

    //get the current page number example: 3, 4 etc: see above method description
  $current = get_current_page($tab);

    $total_pages = ceil($total / $page_size);
    $start = max($current - intval($index_limit / 2), 1);
    $end = $start + $index_limit - 1;

    $pagging = '<div class="paging btn-group btn-group-sm">';

    if ($current == 1) {
        $pagging .= '<span class="prn btn btn-primary">< Previous</span> ';
    } else {
        $i = $current - 1;
        $pagging .= '<button onclick="return submitForm'.$tab.'(this.id)" class="prn btn btn-primary" title="go to page ' . $i . '" id="'.$i.'">< Previous</button> ';
      //  $pagging .= '<a class="prn btn btn-primary" title="go to page ' . $i . '" rel="nofollow" href="' . $thepage . '?page=' . $i . $query . '">< Previous</a> ';
               $pagging .= '<span class="prn btn btn-link">...</span> ';
    }

    if ($start > 1) {
        $i = 1;
        $pagging .= '<button onclick="return submitForm'.$tab.'(this.id)" class="prn btn btn-primary" title="go to page ' . $i . '" id="'.$i.'">'.$i.'</button> ';
        //$pagging .= '<a class="btn btn-primary" title="go to page ' . $i . '" href="' . $thepage . '?page=' . $i . $query . '">' . $i . '</a> ';
    }

    for ($i = $start; $i <= $end && $i <= $total_pages; $i++) {
        if ($i == $current) {
            $pagging .= '<span class="btn btn-secondary" >' . $i . '</span> ';
        } else {
            $pagging .= '<button onclick="return submitForm'.$tab.'(this.id)" class="prn btn btn-primary" title="go to page ' . $i . '" id="'.$i.'">'.$i.'</button> ';
            //$pagging .= '<a class="btn btn-primary" title="go to page ' . $i . '" href="' . $thepage . '?page=' . $i . $query . '">' . $i . '</a> ';
              
        }
        
    }

    if ($total_pages > $end) {
        $i = $total_pages;
        $pagging .= '<button onclick="return submitForm'.$tab.'(this.id)" class="prn btn btn-primary" title="go to page ' . $i . '" id="'.$i.'">'.$i.'</button> ';
        //$pagging .= '<a class="btn btn-primary" title="go to page ' . $i . '" href="' . $thepage . '?page=' . $i . $query . '">' . $i . '</a> ';
    }

    if ($current < $total_pages) {
        $i = $current + 1;
        $pagging .= '<span class="prn btn btn-link">...</span> ';
        $pagging .= '<button onclick="return submitForm'.$tab.'(this.id)" class="prn btn btn-primary" title="go to page ' . $i . '" id="'.$i.'">Next ></button> ';
       // $pagging .= '<a class="prn btn btn-primary" title="go to page ' . $i . '" rel="nofollow" href="' . $thepage . '?page=' . $i . $query . '">Next ></a> ';
    } else {
        $pagging .= '<span class="prn btn btn-primary">Next ></span> ';
    }

    //if nothing passed to method or zero, then dont print result, else print the total count below:
    if ($total != 0) {
        //prints the total result count just below the paging
        $pagging .= '(' . $total . ' Records)';
    }
    $pagging .= '</div>';

    return $pagging;
}

//end of method doPages()
//Both of the functions below required

function check_integer($which,$tab) {

    if($tab=="")
       $which1=$which."1";
    else
        $which1=$which.$tab;

    //echo "<script>alert('".$which1."')</script>";

    if (isset($_REQUEST[$which1])) {
        if (intval($_REQUEST[$which1]) > 0) {
            //check the paging variable was set or not,
            //if yes then return its number:
            //for example: ?page=5, then it will return 5 (integer)
            return intval($_REQUEST[$which1]);
        } else {
            return false;
        }
    }
    elseif (isset($_REQUEST[$which])) {
        if (intval($_REQUEST[$which]) > 0) {
            //check the paging variable was set or not,
            //if yes then return its number:
            //for example: ?page=5, then it will return 5 (integer)
            return intval($_REQUEST[$which]);
        } else {
            return false;
        }
    }
    return false;
}

//end of check_integer()

function get_current_page($tab) {
    //echo "tab:".$tab;
    if (($var = check_integer('page',$tab))) {
        //return value of 'page', in support to above method
        return $var;
    } else {
        //return 1, if it wasnt set before, page=1
        return 1;
    }
}

//end of method get_current_page()


function getStartAndEndDate($week, $year) {
    $time = strtotime("1 January $year", time());
    $day = date('w', $time);
    $time += ((7 * $week) - $day) * 24 * 3600;
    $return[0] = date('Y-n-j', $time);
    $time += 6 * 24 * 3600;
    $return[1] = date('Y-n-j', $time);
    return $return;
}


function yearMonth2digitCode() {
    $two_digit_year = gmdate("y");
    $two_digit_month = gmdate("m");
    return $two_digit_year . $two_digit_month;
}

function yearMonthStartEndDateCode($startDate, $endDate) {
    $time1 = strtotime($startDate);
    $month1 = date("m", $time1);
    $year1 = date("y", $time1);
    $time2 = strtotime($endDate);
    $month2 = date("m", $time2);
    $year2 = date("y", $time2);
    $yearMonthStartEndDateCode = $year1 . $month1 . $year2 . $month2;
    return $yearMonthStartEndDateCode;
}

function getCountries() {
	global $dbcon;
	$sql2 = "SELECT country_code,country FROM visitors_info WHERE country_code != '' GROUP BY country_code";	
	$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt2->execute();
	$countries = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	$stmt2 = null;
	return $countries;
}

function getStates($countryCode) {
	global $dbcon;
	$sql2 = "SELECT state FROM visitors_info WHERE country_code = '".$countryCode."' GROUP BY state";	
	$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt2->execute();
	$states = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	$stmt2 = null;
	return $states;
}

function getCities($state) {
	global $dbcon;
	$sql2 = "SELECT city FROM visitors_info WHERE state = '".$state."' GROUP BY city";	
	$stmt2 = $dbcon->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt2->execute();
	$cities = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	$stmt2 = null;
	return $cities;
}


function ConvertLocalTimezoneToGMT($gmttime,$diffVal){
    
    global $timezoneArray;

    $timezoneRequired = $timezoneArray[$diffVal];

    $system_timezone = date_default_timezone_get();
 
    $local_timezone = $timezoneRequired;
    date_default_timezone_set($local_timezone);
    $local = date("Y-m-d h:i:s A");
 
    date_default_timezone_set("GMT");
    $gmt = date("Y-m-d h:i:s A");
 
    date_default_timezone_set($system_timezone);
    $diff = (strtotime($gmt) - strtotime($local));
 
    $date = new DateTime($gmttime);
    $date->modify("+$diff seconds");
    $timestamp = $date->format("Y-m-d H:i:s");
    return $timestamp;
}

function ConvertGMTToLocalTimezone($gmttime,$diffVal)
{

    global $timezoneArray;

    $timezoneRequired = $timezoneArray[$diffVal];

    $system_timezone = date_default_timezone_get();

    date_default_timezone_set("GMT");
    $gmt = date("Y-m-d h:i:s A");

    $local_timezone = $timezoneRequired;
    date_default_timezone_set($local_timezone);
    $local = date("Y-m-d h:i:s A");

    date_default_timezone_set($system_timezone);
    $diff = (strtotime($local) - strtotime($gmt));

    $date = new DateTime($gmttime);
    $date->modify("+$diff seconds");
    $timestamp = $date->format("Y-m-d H:i:s");
    return $timestamp;
}

function get_var($sql){
	
	global $dbcon;
	
	try {
		$stmt = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		$result = $stmt->fetchColumn();		
		//return $result[0];
		$stmt=null;
		//$dbcon=null;
		return $result;
		
	}catch (PDOException $e){
		print $e->getMessage();
	}
}


function get_all($sql){
	global $dbcon;

	try{
		$stmt = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		//$dbcon=null;
		return $result;
	}

	catch (PDOException $e){
		print $e->getMessage();
	}
}

function execute($sql){
	global $dbcon;

	try{
		$stmt = $dbcon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		//$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		//$dbcon=null;
		return $result;
	}

	catch (PDOException $e){
		print $e->getMessage();
	}

}

function insert_sql_params($sql,$params){

}


function min_hr($time){

	$time=$time/60;
	$notation="min";
	if($time>60){
		$time=$time/60;
		$notation="hr";
		}

	$time=round($time, 1, PHP_ROUND_HALF_DOWN);
	
	return array($time,$notation);
}

?>
