<div style="background-color: #ffffff; color: red; margin-left: 300px;">

<?php 
 
	error_reporting(E_ALL);
	session_start();
	require_once 'classes/class.mysqli.php';
	require_once 'includes/required.inc.php';
	require_once 'classes/class.encryption.php';
	require_once 'classes/class.user.php';
	require_once 'classes/class.log.php';
	include_once('classes/class.form.php');
  $form = new Form();
  $log = new LogActivity();
	 
	$user = new User();
	if (!$user->get_session()){
	   header("location:".BASEURL."login.php");

	}
	if (isset($_GET['q']) == 'logout'){
	    $user->user_logout();
	    header("location:".BASEURL."login.php");
	}
?>
</div>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>kiraCMS</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href='<?=BASEURL;?>'>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet">

		<!-- Pace -->
		<link href="css/pace.css" rel="stylesheet">

		<!-- Perfect -->
		<link href="css/app.min.css" rel="stylesheet">
		<link href="css/app-skin.css" rel="stylesheet">

		<!-- Jquery -->
		<script src="js/jquery-1.10.2.min.js"></script>

		<link rel="shortcut icon" href="http://faviconist.com/icons/340bb379c9fcfd9985b1f4a793e94493/favicon.ico" />
  </head>

  <body class="overflow-hidden">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>
	
	<div id="wrapper" class="preload">
		<div id="top-nav" class="skin-6 fixed">
			<div class="brand">
				<span>kiraCMS</span>
			</div><!-- /brand -->
			<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<ul class="nav-notification clearfix">
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php isset($_SESSION['user_logged_in_name']) ? $name=$_SESSION['user_logged_in_name'] : $name='No Name'; echo $name; ?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /top-nav-->
		
		<aside class="fixed skin-6">	
			<div class="sidebar-inner scrollable-sidebars">
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->	
				<div class="user-block clearfix">
					<div class="detail">
						<strong><?php isset($_SESSION['user_logged_in_name']) ? $name=$_SESSION['user_logged_in_name'] : $name='No Name'; echo $name; ?></strong>	
					</div>
				</div><!-- /user-block -->
				<div class="search-block">
					<div class="input-group">
						<input type="text" class="form-control input-sm" placeholder="search here...">
						<span class="input-group-btn">
							<button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /search-block -->
				
				<?php include("includes/menu.inc.php"); ?>

			</div><!-- /sidebar-inner -->
		</aside>

		<div id="main-container">
			<div class="padding-md">
				<div class="row">
					<div class="col-md-11">
						<?php include("content.php"); ?>
					</div>
				</div>
			</div>
		</div><!-- /main-container -->

  </div><!-- /wrapper -->

	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	
	<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" href="logout.php">Logout</a>
			<a class="btn btn-danger logoutConfirm_close">Cancel</a>
		</div>
	</div>

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
