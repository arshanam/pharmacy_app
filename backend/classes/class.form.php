<?php

	class Form {

		public function __construct(){
			$this->db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
		}

		public function text_field($name, $title, $value){
			$return='';
			$return.='<div class="form-group">
								<label for="'.$name.'" class="col-lg-2 control-label">'.$title.':</label>
			        <div class="col-lg-10">
			            <input class="form-control" id="'.$name.'" name="'.$name.'" type="text" data-required="true" value="'.$value.'">
			        </div>
			    </div>';
			echo $return;   
		}

		public function submit_button($name){
			$return='<div class="form-group">
								<label class="col-lg-2 control-label"></label>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-success btn-sm">'.$name.'</button>
								</div>
							</div>';
			echo $return;
		}


	}
?>
