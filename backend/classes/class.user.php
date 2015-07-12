<?php

	class User {

		public function __construct()
		{
			$this->db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
		}

		public function check_login($username, $password){
			
			$encryption = new Encryption();
			$password = $encryption->encode($password);
			
			$this->db->where ('username', $username);
			$this->db->where ('password', $password);
			$results = $this->db->getOne("users");
			
			if ($results) {
				$_SESSION['login'] = true;
				$_SESSION['user_logged_in_name']=$results['name']." ".$results['lastname'];
				$_SESSION['user_id']=$results['id'];
				return true;
			}else{
				return false;
			}
			
		}

		public function get_session(){
			isset($_SESSION['login']) ? $login_return=true : $login_return=false;
			return $login_return;
		}


		public function user_logout() {
			$_SESSION['login'] = FALSE;
			session_destroy();
		}
	}
?>
