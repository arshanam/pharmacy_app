<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'classes/');
include 'PHPExcel/IOFactory.php';

if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):

// Upload the file temporary
	$uploadedStatus = 0;
	if(isset($_FILES["customers_file"])){
		//if there was an error uploading the file
		if ($_FILES["customers_file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["customers_file"]["error"] . "<br />";
		}
		else {
			if (file_exists($_FILES["customers_file"]["name"])) {
				unlink($_FILES["customers_file"]["name"]);
			}

			$fileFormat = $_FILES['customers_file']['name'];
			$tokens = explode('.', $fileFormat);
			$extension = $tokens[sizeof($tokens)-1];

			$storagename = "example.".$extension;
			move_uploaded_file($_FILES["customers_file"]["tmp_name"],  $storagename);
			$uploadedStatus = 1;
		}
	}

	try {
		$objPHPExcel = PHPExcel_IOFactory::load($storagename);
	} catch(Exception $e) {
		die('Error loading file "'.pathinfo($storagename,PATHINFO_BASENAME).'": '.$e->getMessage());
	}

	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

	for($i=1;$i<=$arrayCount;$i++){
		$card_code = trim($allDataInSheet[$i]["A"]);
		$card_name = trim($allDataInSheet[$i]["B"]);
	  $group_code = trim($allDataInSheet[$i]["C"]);
	  $region = trim($allDataInSheet[$i]["D"]);
	  $address = trim($allDataInSheet[$i]["E"]);
		$zip_code = trim($allDataInSheet[$i]["F"]);
	  $city = trim($allDataInSheet[$i]["G"]);
	  $mail_address = trim($allDataInSheet[$i]["H"]);
	  $mail_zip_code = trim($allDataInSheet[$i]["I"]);
		$phone1 = trim($allDataInSheet[$i]["J"]);
	  $phone2 = trim($allDataInSheet[$i]["K"]);
	  $cellular = trim($allDataInSheet[$i]["L"]);
	  $fax = trim($allDataInSheet[$i]["M"]);
		$contact_person = trim($allDataInSheet[$i]["N"]);
	  $country = trim($allDataInSheet[$i]["O"]);
	  $country_code = trim($allDataInSheet[$i]["P"]);
	  $email = trim($allDataInSheet[$i]["Q"]);
		$block = trim($allDataInSheet[$i]["R"]);
	  
	  $insert = array(
        "card_code" => $card_code,
        "card_name" => $card_name,
        "group_code" => $group_code,
        "region" => $region,
        "address" => $address,
        "zip_code" => $zip_code,
        "city" => $city,
        "mail_address" => $mail_address,
        "mail_zip_code" => $mail_zip_code,
        "phone1" => $phone1,
        "phone2" => $phone2,
        "cellular" => $cellular,
        "fax" => $fax,
        "contact_person" => $contact_person,
        "country" => $country,
        "country_code" => $country_code,
        "email" => $email,
        "block" => $block,
        "status" => "1",
        "date_created" => date("Y-m-d H:i:s")
		);
			
		$res = $db->insert("customer", $insert);			
	}
	$res ? $_SESSION['result']=array('res'=>'success','msg'=>'Customer List was successfully added!') : $_SESSION['msg']=array('res'=>'danger','msg'=>'There was an error! Please try again!');
	echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'customer/search">';

	unlink($storagename);
endif;
	
?>