<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php


function remove_sympols($var){
	$var = str_replace("'","`",$var);
	return $var;
}


//session_start();
//$_SESSION['which'] = '';

//a table in intranet to check if the script is working online.
require_once('../includes/config.inc.php');
require_once('reader.php');

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('utf-8');


$data1->read('stoixeia.xls');//test file with code and name only

$col = 1;
$row = 1;

while($row <= 395){

	$am = remove_sympols($data->sheets[0]['cells'][$row][$col]);
	
	if($am != ''){

		$eponumo = $data->sheets[0]['cells'][$row][$col+1];
		$onoma_patros = $data->sheets[0]['cells'][$row][$col+2];
		$onoma = $data->sheets[0]['cells'][$row][$col+3];
		$klados = $data->sheets[0]['cells'][$row][$col+4];
		$odos = $data->sheets[0]['cells'][$row][$col+5];
		$arithmos = $data->sheets[0]['cells'][$row][$col+6];
		$perioxi = $data->sheets[0]['cells'][$row][$col+7];
		$poli = $data->sheets[0]['cells'][$row][$col+8];
		$tilefono_grafeiou = $data->sheets[0]['cells'][$row][$col+9];
		$fax_grafeiou = $data->sheets[0]['cells'][$row][$col+10];
		$tilefono = $data->sheets[0]['cells'][$row][$col+11];
		$fax = $data->sheets[0]['cells'][$row][$col+12];
		$kinito = $data->sheets[0]['cells'][$row][$col+13];
		$email = $data->sheets[0]['cells'][$row][$col+14];

	

		//for the rest of the fields in excel

		
		mysql_query("SET NAMES 'utf8'");
		$success = @mysql_query("INSERT INTO  stoixeia_epikoinonias (am_etek, eponymo, onoma_patros, onoma, klados, odos, arithmos, perioxi, poli, tilefono_grafeiou, fax_grafeiou, tilefono_oikias, fax_oikias, kinito, email)
		VALUES ('$am', '$eponumo', '$onoma_patros', '$onoma', '$klados', '$odos', '$arithmos', '$perioxi', '$poli', '$tilefono_grafeiou', '$fax_grafeiou', '$tilefono', '$fax', '$kinito', '$email')");

		//if(!$success) $_SESSION['which'] .= $tel.",";
	}
	$row++;
}
//print_r($_SESSION['which']);
?>

<body>
</body>
</html>