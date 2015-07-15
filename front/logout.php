<?php
	session_start();
	setcookie('Login_cookie', '', time()-3600);
	session_destroy();
	require_once 'classes/class.mysqli.php';
	require_once 'includes/required.inc.php';

	$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
   $insert_log = array(
        'user_id'=>$_SESSION['user_id'],
        'action'=>'User Logged out!',
        "date_time" => date("Y-m-d H:i:s")
      );
  $log = $db->insert ('log_activity', $insert_log);

	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";

?>