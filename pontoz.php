<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// mysql update row with matched rajt
$result = mysql_query("CALL pontoz()");

// check if row inserted or not
if ($result) {
    // successfully updated
    $response["success"] = 1;
    $response["message"] = "Product successfully updated.";
        
    // echoing JSON response
    echo json_encode($response);
} else {
        
}
?>
