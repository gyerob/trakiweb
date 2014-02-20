<?php

/*
 * Following code will list all the trailer
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all trailer from trailer table
$result = mysql_query("SELECT *FROM potkocsi ORDER BY vido") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // trailer node
    $response["trailer"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $trailer = array();
        $trailer["rajt"] = $row["rajt"];
        $trailer["nev"] = $row["nev"];
        $trailer["ido"] = $row["ido"];
        $trailer["hiba"] = $row["hiba"];
		$trailer["vido"] = $row["vido"];

        // push single trailer into final response array
        array_push($response["trailer"], $trailer);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no trailer found
    $response["success"] = 0;
    $response["message"] = "No trailerracers found";

    // echo no users JSON
    echo json_encode($response);
}
?>
