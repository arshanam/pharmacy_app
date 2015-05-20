<?php

if(isset($_REQUEST['action']))
	$function=$_REQUEST['action'];

if(isset($_REQUEST['module']))
	$module=$_REQUEST['module'];

(!isset($module) || !isset($function)) ?  $url='modules/dashboard.php' : $url = 'modules/'.$module.'/'.$function.'.inc.php';
echo "<div>url: " . $url . "</div>";
require_once($url);

?>