<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'classes/');
include 'PHPExcel/IOFactory.php';

if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):

// Upload the file temporary
	$uploadedStatus = 0;
	if(isset($_FILES["products_file"])){
		//if there was an error uploading the file
		if ($_FILES["products_file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["products_file"]["error"] . "<br />";
		}
		else {
			if (file_exists($_FILES["products_file"]["name"])) {
				unlink($_FILES["products_file"]["name"]);
			}

			$fileFormat = $_FILES['products_file']['name'];
			$tokens = explode('.', $fileFormat);
			$extension = $tokens[sizeof($tokens)-1];

			$storagename = "prod.".$extension;
			move_uploaded_file($_FILES["products_file"]["tmp_name"],  $storagename);
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
		$item_code = trim($allDataInSheet[$i]["A"]);
		$barcode = trim($allDataInSheet[$i]["B"]);
	  $description = trim($allDataInSheet[$i]["C"]);
	  $supplier = trim($allDataInSheet[$i]["D"]);
	  $category = trim($allDataInSheet[$i]["E"]);
		$wsale = trim($allDataInSheet[$i]["F"]);
	  $retail = trim($allDataInSheet[$i]["G"]);
	  $vat = trim($allDataInSheet[$i]["H"]);

	  $insert = array(
        "item_code" => $item_code,
        "barcode" => $barcode,
        "description" => $description,
        "supplier" => $supplier,
        "category" => $category,
        "wsale" => $wsale,
        "retail" => $retail,
        "vat" => $vat,
        "status" => "1",
        "date_created" => date("Y-m-d H:i:s")
		);
			
		$res = $db->insert("product", $insert);			
	}
	$res ? $_SESSION['result']=array('res'=>'success','msg'=>'Product List was successfully added!') : $_SESSION['msg']=array('res'=>'danger','msg'=>'There was an error! Please try again!');
	echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'product/search">';

	//unlink($storagename);
endif;
	
?>