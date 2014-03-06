<?php
 
$base = $_REQUEST["image"];
// array for JSON response
$response = array();
 
if (isset($base)) { 

	// include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	
	$suffix = createRandomID();
	$image_name = "img_".$suffix."_".date("Y-m-d-H-m-s").".jpg";
	
	$result = mysql_query("INSERT INTO images (nev) VALUES ('$image_name')");
	
	// base64 encoded utf-8 string
	$binary = base64_decode($base);
	 
	// binary, utf-8 bytes
	header("Content-Type: bitmap; charset=utf-8");
	$file = fopen("pics/" . $image_name, "wb");
	fwrite($file, $binary);
	fclose($file);
	
	if($result){
		$response["success"] = 1;
		$response["message"] = "Sikeres.";
			
		// echoing JSON response
		echo json_encode($response);
	} else {
		$response["success"] = 0;
		$response["message"] = "Sikertelen.";
			
		// echoing JSON response
		echo json_encode($response);
	}
	
	die($image_name);
} else { 
	die("No POST");
}
 
function createRandomID() {
	$chars = "abcdefghijkmnopqrstuvwxyz0123456789?";
	$i = 0;
	$pass = "";
	 
	while ($i <= 5) {
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
?>