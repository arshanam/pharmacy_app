<?php

	class LogActivity {

		public function __construct(){
			$this->db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
		}

		public function create_log($name, $title, $value){			
			$return='';
			$return.='<div class="form-group">
								<label for="'.$name.'" class="col-lg-2 control-label">'.$title.':</label>
			        <div class="col-lg-10">
			            <input class="form-control" id="'.$name.'" name="'.$name.'" type="text" value="'.$value.'">
			        </div>
			    </div>';
			echo $return;   
		}


	}
?>
