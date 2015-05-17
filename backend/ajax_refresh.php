<?php
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=hcacom_admin', 'hcacom_admin', 'dnafnv8uinv3ebvyu3!@', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
 
$sql = "SELECT * FROM customers WHERE title LIKE (:keyword) ORDER BY id";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
if(strlen($keyword)>2){
	echo"<ul class='autosuggest_ul'>";
	foreach ($list as $rs) {
		// put in bold the written text
		$customer = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['title']);
		// add new option
	    echo '<li class="autosuggest_li"><a href="index.php?select=16&id='.$rs['id'].'">'.$customer.'</a></li>';
	}
	echo"</ul>";
}
?>