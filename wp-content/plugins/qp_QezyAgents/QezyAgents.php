<?php 
    /*
    Plugin Name: QezyAgents
    Plugin URI: 
    Description: Stores Qezy Agents details to the database
    Author: IB
    Version: 1.0
    Author URI: ib
    */

add_shortcode('Qagent','agent_to_db');

function agent_to_db(){
global $current_user;
global $wpdb;

get_currentuserinfo();
$user_id = get_current_user_id();
$dispName=$current_user->display_name;


if(isset($_POST['a_submit']))
{

$agentid=$_POST['a_agentid'];
$agentname=$_POST['a_agentname'];
$phone=$_POST['a_phone'];
$city=$_POST['a_city'];
$address=$_POST['a_address'];


echo "1.".$agentid;
echo "2.".$agentname;
echo "3.".$phone;
echo "4.".$city;
echo "5.".$address;

/*$wpdb->insert("agents1", array(
   "agentid" => $agentid,
   "agentname" => $agentname,
   "phone" => $phone, 
"city" => $city,
"address" => $address));
*/


}

?>
<form method="post">
<table>
<tr><td>Agent Id</td><td><input type="text" id="a_agentid" name="a_agentid" required/></td></tr>
<tr><td>AgentName</td><td><input type="text" id="a_agentname" name="a_agentname" required/></td></tr>
<tr><td>Contact No.</td><td><input type="text" id="a_phone" name="a_phone" required/></td></tr>
<tr><td>Address</td><td><input type="textarea" id="a_address" name="a_address" /></td></tr>
<tr><td>City/Region</td><td><select name="a_city" id="a_city" style="width: 100%;" required>
<option value="">Select City</option>
<option value="Hyd">Hyderabad</option>
<option value="Kol">Kolkata</option>
<option value="Dha">Dhaka</option>
<option value="Ott">Ottowa</option></td></tr>
<tr><td><input type="submit" name="a_submit" id="a_submit" value="Submit" /></td></tr>
</table>
</form>
<?php } ?>

<?php
