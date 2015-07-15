<?php
	if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):
    !isset($_POST['status']) ? $status = 1 : $status = $_POST['status'];
    $encryption = new Encryption();
    if(isset($_GET['id'])){
      $insert = array(
        "name" => post_text_variable($_POST['name']),
        "lastname" => post_text_variable($_POST['lastname']),
        "email" => post_text_variable($_POST['email']),
        "username" => post_text_variable($_POST['username']),
        "backend_login" => $_POST['backend_login'],
        "status" => $status,
        "date_created" => date("Y-m-d H:i:s")
      );

      $db->where ('id', $_GET['id']);
      $res = $db->update ('users', $insert);
      $action_msg='User <b>'.$_POST['name'].'</b>  Updated!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not updated! Please try again!');
    }else{
      $password = $encryption->encode($_POST['password']);
      $insert = array(
        "name" => post_text_variable($_POST['name']),
        "lastname" => post_text_variable($_POST['lastname']),
        "email" => post_text_variable($_POST['email']),
        "username" => post_text_variable($_POST['username']),
        "password" => $password,
        "backend_login" => $_POST['backend_login'],
        "status" => '1',
        "date_created" => date("Y-m-d H:i:s")
      );

      $res = $db->insert("users", $insert);
      $action_msg='User <b>'.$_POST['name'].'</b>  Added!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not added! Please try again!');
    }

    create_log_action($_SESSION['user_id'], $action_msg); 
   
		echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'user/search">';

  endif;

?>