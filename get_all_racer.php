<?php

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all racers from racers table
$result = mysql_query("SELECT *FROM adatok") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // racers node
    $response["racers"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $racers = array();
        $racers["rajt"] = $row["rajt"];
        $racers["nev"] = $row["nev"];
        $racers["varos"] = $row["varos"];
        $racers["nem"] = $row["nem"];
		$racers["potkocsi"] = $row["potkocsi"];
		$racers["szlalom"] = $row["szlalom"];
		$racers["gyorsulas"] = $row["gyorsulas"];

        // push single racers into final response array
        array_push($response["racers"], $racers);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no racers found
    $response["success"] = 0;
    $response["message"] = "No racers found";

    // echo no users JSON
    echo json_encode($response);
}
?>
