<?php

/*
 * Following code will list all the slalom
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all slalom from slalom table
$result = mysql_query("SELECT *FROM szeredmeny ORDER BY pid") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // slalom node
    $response["slalom"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $slalom = array();
        $slalom["rajt"] = $row["rajt"];
        $slalom["nev"] = $row["nev"];
        $slalom["pid"] = $row["pid"];

        // push single slalom into final response array
        array_push($response["slalom"], $slalom);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no slalom found
    $response["success"] = 0;
    $response["message"] = "No slalomracers found";

    // echo no users JSON
    echo json_encode($response);
}
?>
