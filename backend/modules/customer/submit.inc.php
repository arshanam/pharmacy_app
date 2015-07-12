<?php

	if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):
		$_POST['status']==null ? $status = 1 : $status = $_POST['status'];
		$insert = array(
		    "card_name" => post_text_variable($_POST['card_name']),
        "card_code" => post_text_variable($_POST['card_code']),
        "group_code" => post_text_variable($_POST['group_code']),
        "region" => (int) $_POST['region'],
        "address" => post_text_variable($_POST['address']),
        "zip_code" => post_text_variable($_POST['zip_code']),
        "city" => post_text_variable($_POST['city']),
        "mail_address" => post_text_variable($_POST['mail_address']),
        "mail_zip_code" => post_text_variable($_POST['mail_zip_code']),
        "phone1" => post_text_variable($_POST['phone1']),
        "phone2" => post_text_variable($_POST['phone2']),
        "cellular" => post_text_variable($_POST['cellular']),
        "fax" => post_text_variable($_POST['fax']),
        "contact_person" => post_text_variable($_POST['contact_person']),
        "country" => post_text_variable($_POST['country']),
        "country_code" => post_text_variable($_POST['country_code']),
        "email" => post_text_variable($_POST['email']),
		    "block" => post_text_variable($_POST['block']),
		    "status" => $status,
		    "date_created" => date("Y-m-d H:i:s")
		);

    if(isset($_GET['id'])){
      $db->where ('id', $_GET['id']);
      $res = $db->update ('customer', $insert);
      $action_msg='Customer <b>'.$_POST['card_name'].'</b> Updated!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not updated! Please try again!');
    }else{
      $res = $db->insert("customer", $insert);
      $action_msg='Customer <b>'.$_POST['card_name'].'</b> Added!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not added! Please try again!');
    }
    create_log_action($_SESSION['user_id'], $action_msg);
		echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'customer/search">';

  endif;

?>