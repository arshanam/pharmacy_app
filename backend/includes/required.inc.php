<?php

//database connection
define("DBUSER", "root");
define("DBNAME", "pharmacy_app");
getOS()=='Ubuntu' ? define("DBPASS", "athlonamd") : define("DBPASS", "");
define("DBHOST", "localhost");
define("BASEURL", "http://localhost/pharmacy_app/backend/");
//define("BASEURL", "http://$_SERVER[HTTP_HOST]/backend/");

/*
define("DBHOST", "localhost");
define("DBUSER", "a92619sb_pharm");
define("DBNAME", "a92619sb_pharm");
define("DBPASS", "and123ros");
define("BASEURL", "http://a92619.sb1.dev.codeanywhere.net/pharmacy_app/");
*/

/**************************************************************************************/

//If the server is not supporting mysqli, echo a message
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')):
	echo 'We don\'t have mysqli!!!';
	exit;
endif;
/**************************************************************************************/

//Database Connection	
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

/**************************************************************************************/
function check_for_notifications($msg, $res){
	if(isset($_SESSION['result']) && $_SESSION['result']!=''): ?>
		<script type="text/javascript">
			$(function()	{
				//Gritter notification
					$.gritter.add({
						title: '<i class="fa fa-check-circle"></i> <?=$msg;?>',
						//text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						sticky: false,
						time: '',
						class_name: '<?=$res;?>'
					});
					return false;
			});
	</script>
<?php
		unset($_SESSION['result']);
	endif;
}

function create_log_action($user_id, $action_msg){
    $db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
     $insert_log = array(
          'user_id'=>$user_id,
          'action'=>$action_msg,
          "date_time" => date("Y-m-d H:i:s")
        );
    $log = $db->insert ('log_activity', $insert_log);
}

/**************************************************************************************/
function post_text_variable($var){
	$var!='' ? $return_var=strip_tags(trim($var)) : $return_var='';
	return $return_var;
}


/**************************************************************************************/
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}


/**************************************************************************************/
function get_fullname($uid) {
    $result = mysql_query("SELECT name FROM users WHERE uid = $uid");
    $user_data = mysql_fetch_array($result);
    echo $user_data['name'];
}
	  

/**************************************************************************************/
function get_session(){
	return $_SESSION['login'];
}
	
/**************************************************************************************/
function user_logout() {
	$_SESSION['login'] = FALSE;
   	session_destroy();
}


/**************************************************************************************/
function getMySQLSafe($value) {
	if (get_magic_quotes_gpc()) $value = stripslashes($value);
    return @mysql_real_escape_string($value);
}

/**************************************************************************************/
function isempty($var){
	if($var != "") return $var;
	else return "--";
}


/*************************************************************************/
function dateEUtoUS($date) {
	if($date == '' || $date == '00-00-0000' || $date == '0000-00-00') $date = '--';
	else $date = date("Y-m-d", strtotime($date));
	return $date;
}
/************************************************/
function dateUStoEU($date) {
	if($date == '' || $date == '00-00-0000' || $date == '0000-00-00') $date = '--';
	else $date = date("d-m-Y", strtotime($date));
	return $date;	
}

function dateTimeUStoEU($date) {
    if($date == '' || $date == '00-00-0000' || $date == '0000-00-00') $date = '--';
    else $date = date("d-m-Y - H:i:s", strtotime($date));
    return $date;   
}



function checkMenuItem(){
	
	if($_REQUEST['select']==30 || $_REQUEST['select']==31 || $_REQUEST['select']==40 || $_REQUEST['select']==41 || $_REQUEST['select']==34 || $_REQUEST['select']==35 || $_REQUEST['select']==36){
		$current="id='home'";
	}else{
		$current="";
	}
	return $current;
}


//get os
function getOS() { 
    $user_agent=$_SERVER['HTTP_USER_AGENT'];
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }   
    return $os_platform;
}

//get the browser
function getBrowser() {
    $user_agent=$_SERVER['HTTP_USER_AGENT'];
    $browser        =   "Unknown Browser";
    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
    }
    return $browser;
}


function display_all($var){
	$return = '';
	$return .= '<pre>';
	$return .= $var;
	$return .= '</pre>';

	return $return;
}


?>
