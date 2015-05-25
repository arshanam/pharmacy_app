<?php

	if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):
		
		$insert = array(
		    "name" => post_text_variable($_POST['name']),
		    "lastname" => post_text_variable($_POST['lastname']),
		    "title" => post_text_variable($_POST['title']),
		    "address" => post_text_variable($_POST['address']),
		    "city" => (int) $_POST['city'],
		    "phone_number" => post_text_variable($_POST['phone_number']),
		    "alternative_phone_number" => post_text_variable($_POST['alternative_phone_number']),
		    "status" => '1',
		    "date_created" => date("Y-m-d H:i:s")
		);
		$res = $db->insert("pharmacy", $insert);
		$res ? $_SESSION['result']=array('res'=>'success','msg'=>'Pharmacy "'.($_POST['title']!='' ? $_POST['title'] : $_POST['name']).'" successfully added') : $_SESSION['msg']=array('res'=>'danger','msg'=>'Not added! Please try again!');
		echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'pharmacy/list">';
	endif;

?>