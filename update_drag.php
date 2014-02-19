<?php

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['rajt']) && isset($_POST['ido']) && isset($_POST['round'])) {
    
    $rajt = $_POST['rajt'];
    $ido = $_POST['ido'];
    $round = $_POST['round'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched rajt
	if ($round == 1) $result = mysql_query("UPDATE gyorsulas SET ido1 = '$ido', lido = IF(ido1>ido2, ido2, ido1) WHERE rajt = $rajt");
	else $result = mysql_query("UPDATE gyorsulas SET ido2 = '$ido', lido = IF(ido1>ido2, ido2, ido1) WHERE rajt = $rajt");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
