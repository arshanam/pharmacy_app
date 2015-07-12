<?php

	class LogActivity {

		public function __construct()
		{
			$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
		}

		//create log action
		public function create_log($user_id, $action){
			
			$insert = array(
		    "user_id" => $user_id,
		    "action" => $action,
		    "date_created" => date("Y-m-d H:i:s")
			);
	    $res = $db->insert("log_action", $insert);
			
		}

	}


?>
