<?php

error_reporting(E_ALL);
session_start();

include_once 'classes/class.mysqli.php';
include_once 'includes/required.php';
include_once 'classes/class.user.php';

$user = new User();

if ($user->get_session()){
   echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'">';
}

if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'){   
    $login = $user->check_login(post_text_variable($_POST['username']), post_text_variable($_POST['password']));
    if ($login) {
        // Registration Success
   		echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'">';
       //echo"logged in";
    } else {
        // Registration Failed
        echo '<div align="center" style="color: red; font-size: 12px; position: relative; top: 80px;">Username or Password is Wrong</div>';
    }
}else{
?>
	<!DOCTYPE html>
	<html lang="en">
	  <head>
	    <meta charset="utf-8">
	    <title>Login</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <!-- Bootstrap core CSS -->
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Perfect -->
		<link href="css/app.min.css" rel="stylesheet">

	  </head>
	<body>
		<div class="login-wrapper">
			<div class="text-center">
				<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
					<span class="text-success">kira</span><span style="color:#ccc; text-shadow:0 1px #fff">CMS</span>
				</h2>
			</div>
			<div class="login-widget animation-delay1">	
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<div class="pull-left">	
							<i class="fa fa-lock fa-lg"></i> Login
						</div>

						<div class="pull-right">
							<span style="font-size:11px;">Don't have any account?</span>
							<a class="btn btn-default btn-xs login-link" href="register.html" style="margin-top:-2px;"><i class="fa fa-plus-circle"></i> Sign up</a>
						</div>
					</div>
					<div class="panel-body">
						<form class="form-login" method="POST" action="login.php">
							<div class="form-group">
								<label>Username</label>
								<input type="text" placeholder="Username" name="username" class="form-control input-sm bounceIn animation-delay2" >
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" placeholder="Password" name="password" class="form-control input-sm bounceIn animation-delay4">
							</div>
							<div class="form-group">
								<label class="label-checkbox inline">
									<input type="checkbox" class="regular-checkbox chk-delete" />
									<span class="custom-checkbox info bounceIn animation-delay4"></span>
								</label>
								Remember me		
							</div>
			
							<div class="seperator"></div>
							<div class="form-group">
								Forgot your password?<br/>
								Click <a href="#">here</a> to reset your password
							</div>

							<hr/>
								
							<button class="btn btn-success btn-sm bounceIn animation-delay5 pull-right" type="submit" class="ok">Login</button>
						</form>
					</div>
				</div><!-- /panel -->
			</div><!-- /login-widget -->
		</div><!-- /login-wrapper -->

	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    
	    <!-- Jquery -->
		<script src="js/jquery-1.10.2.min.js"></script>
	    
	    <!-- Bootstrap -->
	    <script src="bootstrap/js/bootstrap.min.js"></script>
	   
		<!-- Modernizr -->
		<script src='js/modernizr.min.js'></script>
	   
	    <!-- Pace -->
		<script src='js/pace.min.js'></script>
	   
		<!-- Popup Overlay -->
		<script src='js/jquery.popupoverlay.min.js'></script>
	   
	    <!-- Slimscroll -->
		<script src='js/jquery.slimscroll.min.js'></script>
	   
		<!-- Cookie -->
		<script src='js/jquery.cookie.min.js'></script>

		<!-- Perfect -->
		<script src="js/app/app.js"></script>
	  </body>
	</html>
<?php } ?>