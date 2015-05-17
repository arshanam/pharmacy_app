<?php

	class User {

		public function __construct()
		{
			$this->db = new db("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8", DBUSER, DBPASS);
		}

		public function check_login($username, $password){
			
			$password = md5($password);

			$bind = array(
			    ":username" => "$username",
			    ":password" => "$password"
			);

			$results = $this->db->select("users", "username = :username AND password = :password", $bind);

			if ($results) {
				$_SESSION['login'] = true;
				$_SESSION['user_logged_in_name']=$results[0][name]." ".$results[0][lastname];
				return true;
			}else{
				return false;
			}
			
		}

		public function get_session(){
			return $_SESSION['login'];
		}


		public function user_logout() {
			$_SESSION['login'] = FALSE;
			session_destroy();
		}
	}
?>
