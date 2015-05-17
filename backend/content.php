<?php
//include_once("includes/functions.php");



if(isset($_REQUEST['action']))
	$function=$_REQUEST['action'];

if(isset($_REQUEST['module']))
	$module=$_REQUEST['module'];

(!isset($module) || !isset($function)) ?  $url='modules/dashboard.php' : $url = 'modules/'.$module.'/'.$function.'.inc.php';
echo "<div>url: " . $url . "</div>";
require_once($url);

/*
switch ($module.'/'.$action) {

	case 'list' : $user->ListCustomers();
		break;
	case 11 : $user->AddCustomer();
		break;
	case 12 : $user->SubmitCustomer();
		break;
	case 13 : $user->EditCustomer();
		break;
	case 14 : $user->UpdateCustomer();
		break;
	case 15 : $user->DeleteCustomer();
		break;
	case 16 : $user->CustomerProfile();
		break;

	case 40 : $user->ListCertificates();
		break;
	case 41 : $user->AddCertificate();
		break;
	case 42 : $user->SubmitCertificate();
		break;
	case 43 : $user->EditCertificate();
		break;
	case 44 : $user->UpdateCertificate();
		break;
	case 45 : $user->DeleteCertificate();

	case 50 : include_once("cal.php");
		break;

	case 100 : $user->ImportCustomers();
		break;
	case 101 : $user->ImportCustomersSave();
		break;

/*********** Categories ************/
	/*	
	case 20 : $user->ListCategories();
		break;		
	case 21 : $user->AddCategory();
		break;
	case 22 : $user->SubmitCategory();
		break;		
	case 23 : $user->EditCategory();
		break;		
	case 24 : $user->UpdateCategory();
		break;	
	case 25 : $user->DeleteCategory();
		break;
	case 26 : $user->CategoryProfile();
		break;	
	

	
	default : '';	
		break;
}
*/
?>