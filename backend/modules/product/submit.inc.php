<?php
	if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):
    $_POST['status']==null ? $status = 1 : $status = $_POST['status'];
    $insert = array(
		    "item_code" => post_text_variable($_POST['item_code']),
        "barcode" => post_text_variable($_POST['barcode']),
        "description" => post_text_variable($_POST['description']),
        "supplier" => (int) $_POST['supplier'],
        "category" => (int) $_POST['category'],
        "wsale" => post_text_variable($_POST['wsale']),
        "retail" => post_text_variable($_POST['retail']),
        "vat" => post_text_variable($_POST['vat']),
		    "status" => $status,
		    "date_created" => date("Y-m-d H:i:s")
		);

    if(isset($_GET['id'])){
      $db->where ('id', $_GET['id']);
      $res = $db->update ('product', $insert);
      $action_msg='Product '.$_POST['description'].' Updated!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not updated! Please try again!');
    }else{
      $res = $db->insert("product", $insert);
      $action_msg='Product '.$_POST['description'].' Added!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not added! Please try again!');
    }
    
    create_log_action($_SESSION['user_id'], $action_msg); 
   
		echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'product/search">';

  endif;

?>