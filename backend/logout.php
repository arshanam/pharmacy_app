<?php
	session_start();
	setcookie('Login_cookie', '', time()-3600);
	session_destroy(); 
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";

?>