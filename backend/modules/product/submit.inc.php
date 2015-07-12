<?php
	if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):
		$insert = array(
		    "item_code" => post_text_variable($_POST['item_code']),
        "barcode" => post_text_variable($_POST['barcode']),
        "description" => post_text_variable($_POST['description']),
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
		    "status" => 1,
		    "date_created" => date("Y-m-d H:i:s")
		);

    if(isset($_GET['id'])){
      $db->where ('id', $_GET['id']);
      $res = $db->update ('product', $insert);
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>'Customer <b>'.$_POST['card_name'].'</b> Successfully Updated!') : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not updated! Please try again!');
    }else{
      $res = $db->insert("product", $insert);
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>'Customer <b>'.$_POST['card_name'].'</b> Successfully Added!') : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not added! Please try again!');
    }
		echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'product/search">';

  endif;

?>