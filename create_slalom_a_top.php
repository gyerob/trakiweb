<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

$result = mysql_query("CALL szatop10()");
		
if ($result) {
	$response["success"] = 1;
	$response["message"] = "Sikeres frissítés";
			
	echo json_encode($response);
} else {}
?>
