<?php

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['rajt']) && isset($_POST['ido']) && isset($_POST['hiba']) && isset($_POST['vido'])) {
    
    $rajt = $_POST['rajt'];
    $ido = $_POST['ido'];
    $hiba = $_POST['hiba'];
    $vido = $_POST['vido'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched rajt
    $result = mysql_query("UPDATE szlalom SET ido = '$ido', hiba = '$hiba', vido = '$vido' WHERE rajt = $rajt");

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
