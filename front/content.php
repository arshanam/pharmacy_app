<?php

if(isset($_REQUEST['action'])):
	$function=$_REQUEST['action'];
endif;


if(isset($_REQUEST['module'])):
	$module=$_REQUEST['module'];
endif;

(!isset($module) || !isset($function)) ?  $url='modules/dashboard.php' : $url = 'modules/'.$module.'/'.$function.'.inc.php';
echo "url: " . $url . "<br />";

echo"</div>";

require_once($url);

?>