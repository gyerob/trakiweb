<?php

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['rajt'])) {
    $rajt = $_POST['rajt'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched rajt
    $result = mysql_query("DELETE FROM adatok WHERE rajt = $rajt");
	mysql_query("DELETE FROM potkocsi WHERE rajt = $rajt");
	mysql_query("DELETE FROM szlalom WHERE rajt = $rajt");
	mysql_query("DELETE FROM gyorsulas WHERE rajt = $rajt");
    
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully deleted";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>