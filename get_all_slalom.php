<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

if (isset($_GET['type'])) {
	$type = $_GET['type'];
	if ($type == "veteran") {
		$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 99) ORDER BY vido") or die(mysql_error());
	} else if ($type == "modern") {
		$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 100) ORDER BY vido") or die(mysql_error());
	} else if ($type == "150le+") {
		$result = mysql_query("SELECT *FROM szlalom WHERE (above150le = 'true') ORDER BY vido") or die(mysql_error());
	} else if ($type == "150le-") {
		$result = mysql_query("SELECT *FROM szlalom WHERE (above150le = 'false') ORDER BY vido") or die(mysql_error());
	} else if ($type == "women") {
		$result = mysql_query("SELECT *FROM szlalom WHERE (nem = 'true') ORDER BY vido") or die(mysql_error());
	} else if ($type == "men") {
		$result = mysql_query("SELECT *FROM szlalom WHERE (nem = 'false') ORDER BY vido") or die(mysql_error());
	}
} else {
	$result = mysql_query("SELECT *FROM szlalom ORDER BY vido") or die(mysql_error());
}

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
        $slalom["ido"] = $row["ido"];
        $slalom["hiba"] = $row["hiba"];
        $slalom["vido"] = $row["vido"];

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
