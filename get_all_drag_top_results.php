<?php

/*
 * Following code will list all the drag
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all drag from gyeredmeny table
$result = mysql_query("SELECT *FROM gyeredmeny ORDER BY pid") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // drag node
    $response["drag"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $drag = array();
        $drag["rajt"] = $row["rajt"];
        $drag["nev"] = $row["nev"];
        $drag["pid"] = $row["pid"];

        // push single drag into final response array
        array_push($response["drag"], $drag);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no drag found
    $response["success"] = 0;
    $response["message"] = "No dragracers found";

    // echo no users JSON
    echo json_encode($response);
}
?>
