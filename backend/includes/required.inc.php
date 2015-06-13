<?php

//database connection
define("DBUSER", "root");
define("DBNAME", "pharmacy_app");
getOS()=='Ubuntu' ? define("DBPASS", "athlonamd") : define("DBPASS", "");
define("DBHOST", "localhost");
define("BASEURL", "http://localhost/pharmacy_app/backend/");

/*
define("DBHOST", "localhost");
define("DBUSER", "a92619sb_pharm");
define("DBNAME", "a92619sb_pharm");
define("DBPASS", "and123ros");
define("BASEURL", "http://a92619.sb1.dev.codeanywhere.net/pharmacy_app/");
*/

//If the server is not supporting mysqli, echo a message
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')):
	echo 'We don\'t have mysqli!!!';
	exit;
endif;

//Database Connection	
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);


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

function post_text_variable($var){
	$var!='' ? $return_var=strip_tags(trim($var)) : $return_var='';
	return $return_var;
}

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}



function get_fullname($uid) {
    $result = mysql_query("SELECT name FROM users WHERE uid = $uid");
    $user_data = mysql_fetch_array($result);
    echo $user_data['name'];
}
	  

function get_session(){
	return $_SESSION['login'];
}
	
function user_logout() {
	$_SESSION['login'] = FALSE;
   	session_destroy();
}
function getMySQLSafe($value) {
	if (get_magic_quotes_gpc()) $value = stripslashes($value);
    return @mysql_real_escape_string($value);
}

/******************************************/

function UploadFile($TempName,$FileFolder,$Sec,$replace,$file_id,$table){

	$FileName = $_FILES["$TempName"]['name'];
				
	$uploadSuccess = (bool) @move_uploaded_file($_FILES["$TempName"]['tmp_name'],$FileFolder.''.$FileName);
	if($replace == 'replace'){
		$OldFile = @mysql_result(@mysql_query("SELECT file_name FROM ".$table." WHERE id='$file_id'"),0);
		unlink("../uploads/files/$OldFile");			
	}
	
	if($uploadSuccess) $fileFormat = $FileName;
	return $fileFormat;	
}


function UpdateImage($id,$action,$table_name,$ColName,$Image,$ImageType,$DirPath,$Sec){
	
	$Sec = rand(1, 100);
	if($action == 'delete'){
		$image_name = @mysql_result(@mysql_query("SELECT ".$ColName." FROM ".$table_name." WHERE id='".$id."'"),0);
		@unlink("../uploads/images/$image_name");
		$query = ",".$ColName."=''";
		return $query;				
	}elseif($action == 'replace'){
		$image_name = @mysql_result(@mysql_query("SELECT ".$ColName." FROM ".$table_name." WHERE id='".$id."'"),0);
		if($Image != ''){
			unlink("../uploads/images/$image_name"); // DEBUG will give a warning if unlink fails 
			$newFileName = date("dmgi$Sec");			
			
			if($ImageType == 'image/jpg') $ext = ".jpg";
			else if($ImageType == 'image/pjpeg')$ext = ".jpg";
			else if($ImageType == 'image/jpeg') $ext = ".jpeg";
			else if($ImageType == 'image/gif') $ext = ".gif";
			else if($ImageType == 'image/png') $ext = ".png";
			else if($ImageType == 'application/x-shockwave-flash') $ext = ".swf";
			$newFileName = $newFileName.$ext;
			$uploadSuccess = (bool) move_uploaded_file($_FILES["$ColName"]['tmp_name'],$DirPath.''.$newFileName);
			$query = ",".$ColName."='".$newFileName."'";
			return $query;
		}				
	}else{
		if($Image != '') {
			
			$newFileName = date("dmgi$Sec");
			if($ImageType == 'image/jpg') $ext = ".jpg";
			else if($ImageType == 'image/pjpeg')$ext = ".jpg";
			else if($ImageType == 'image/jpeg') $ext = ".jpeg";
			else if($ImageType == 'image/gif') $ext = ".gif";
			else if($ImageType == 'image/png') $ext = ".png";
			else if($ImageType == 'application/x-shockwave-flash') $ext = ".swf";
			$newFileName = $newFileName.$ext;
			$uploadSuccess = (bool) move_uploaded_file($_FILES["$ColName"]['tmp_name'],$DirPath.''.$newFileName);
			$query = ",".$ColName."='".$newFileName."'";
			return $query;
		}				
	}
}
function UploadImage($TempName,$Image,$ImageType,$DirPath,$Sec){
	$Sec = rand(1, 100);
	$newFileName = date("dmgi$Sec");
	if($ImageType == 'image/jpg') $ext = ".jpg";
	else if($ImageType == 'image/pjpeg')$ext = ".jpg";
	else if($ImageType == 'image/jpeg') $ext = ".jpeg";
	else if($ImageType == 'image/gif') $ext = ".gif";
	else if($ImageType == 'image/png') $ext = ".png";
	else if($ImageType == 'application/x-shockwave-flash') $ext = ".swf";
	$newFileName = $newFileName.$ext;
	/**************************************************************/		
	$uploadSuccess = (bool) move_uploaded_file($_FILES["$TempName"]['tmp_name'],$DirPath.''.$newFileName);
	if ($uploadSuccess) $Image = $newFileName;
	return $Image;	
}
function isempty($var){
	if($var != "") return $var;
	else return "--";
}
function CheckImage($ImageName,$PathName){
	if($ImageName == '') $ShowImage = "--";
	else $ShowImage = "$PathName";
	return $ShowImage;
}	
/****************/
function ThumbImage($TempName,$Image,$ImageType,$DirPath,$Sec){
	$newFileName = date("dmgis$Sec");
	if($ImageType == 'image/jpg') $ext = ".jpg";
	else if($ImageType == 'image/pjpeg')$ext = ".jpg";
	else if($ImageType == 'image/jpeg') $ext = ".jpeg";
	else if($ImageType == 'image/gif') $ext = ".gif";
	else if($ImageType == 'image/png') $ext = ".png";
	$filePic = $newFileName.$ext;
	/**************************************************************/		
	$uploadSuccess = (bool) move_uploaded_file($_FILES["$TempName"]['tmp_name'],$DirPath.''.$filePic);
	if ($uploadSuccess) $Image = $filePic;
	return $Image;	
}
function GenerateThumbFile($from_name, $to_name, $max_x, $max_y) {
	$save_to_file = true;
	// quality
	$image_quality = 100;
	// resulting image type (1 = GIF, 2 = JPG, 3 = PNG)
	// enter code of the image type if you want override it
	// or set it to -1 to determine automatically
	$image_type = -1;
	// maximum thumb side size
	// get source image size (width/height/type)
	// orig_img_type 1 = GIF, 2 = JPG, 3 = PNG
 	list($orig_x, $orig_y, $orig_img_type, $img_sizes) = GetImageSize($from_name);
  
	// should we override thumb image type?
	$image_type = $orig_img_type;
	// check for allowed image types
	if ($orig_img_type < 1 or $orig_img_type > 3) die("Image type not supported");
	if ($orig_x > $max_x or $orig_y > $max_y){
		// resize
		$per_x = $orig_x / $max_x;
		$per_y = $orig_y / $max_y;
		if ($per_y > $per_x){
		  $max_x = $orig_x / $per_y;
		}else{
		  $max_y = $orig_y / $per_x;
		}
	}
	else{
		// keep original sizes, i.e. just copy
		if (true) {
		  @copy($from_name, $to_name);
		}
		else {
		  switch ($image_type) {
		    case 1:
		        header("Content-type: image/gif");
		        include($from_name);
		      break;
		    case 2:
		        header("Content-type: image/jpeg");
		        include($from_name);
		      break;
		    case 3:
		        header("Content-type: image/png");
		        include($from_name);
		      break;
		  }
		}
		return;
	}
	if ($image_type == 1) {
	// should use this function for gifs (gifs are palette images)
	$ni = imagecreate($max_x, $max_y);
	}
	else {
	// Create a new true color image
	$ni = ImageCreateTrueColor($max_x,$max_y);
	}
	// Fill image with white background (255,255,255)
	$white = imagecolorallocate($ni, 255, 255, 255);
	imagefilledrectangle( $ni, 0, 0, $max_x, $max_y, $white);
	// Create a new image from source file
	$im = ImageCreateFromType($orig_img_type,$from_name); 
	// Copy the palette from one image to another
	imagepalettecopy($ni,$im);
	// Copy and resize part of an image with resampling
	imagecopyresampled(
	$ni, $im,             // destination, source
	0, 0, 0, 0,           // dstX, dstY, srcX, srcY
	$max_x, $max_y,       // dstW, dstH
	$orig_x, $orig_y);    // srcW, srcH
	/*************************************************************************/
	SaveImage($image_type, $ni, $to_name, $image_quality, true);
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
function checkMenuItem(){
	
	if($_REQUEST['select']==30 || $_REQUEST['select']==31 || $_REQUEST['select']==40 || $_REQUEST['select']==41 || $_REQUEST['select']==34 || $_REQUEST['select']==35 || $_REQUEST['select']==36){
		$current="id='home'";
	}else{
		$current="";
	}
	return $current;
}


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
