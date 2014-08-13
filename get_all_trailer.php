<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['type'])) {
	$type = $_GET['type'];
	
	if (isset($_GET['group'])) {
		$group = $_GET['group'];
		if ($group == 0) {
			if ($type == "veteran") {
				$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt > 99) ORDER BY vido") or die(mysql_error());
			} else if ($type == "modern") {
				$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt < 100) ORDER BY vido") or die(mysql_error());
			}
		} else if ($group == 1) {
			if ($type == "veteran") {
				$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt > 99 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			} else if ($type == "modern") {
				$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt < 100 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			}
		} else if ($group == 2) {
			if ($type == "veteran") {
				$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt > 99 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			} else if ($type == "modern") {
				$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt < 100 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			}
		}
	} else {
		if ($type == "veteran") {
			$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt > 99) ORDER BY vido") or die(mysql_error());
		} else if ($type == "modern") {
			$result = mysql_query("SELECT *FROM potkocsi WHERE (rajt < 100) ORDER BY vido") or die(mysql_error());
		}
	}
	
	
	
} else {
	if (isset($_GET['group'])) {
		$group = $_GET['group'];
		if ($group == 0) {
			$result = mysql_query("SELECT *FROM potkocsi ORDER BY vido") or die(mysql_error());
		} else if ($group == 1) {
			$result = mysql_query("SELECT *FROM potkocsi WHERE (csoport = '1') ORDER BY vido") or die(mysql_error());
		} else if ($group == 2) {
			$result = mysql_query("SELECT *FROM potkocsi WHERE (csoport = '2') ORDER BY vido") or die(mysql_error());
		}
	} else {
		$result = mysql_query("SELECT *FROM potkocsi ORDER BY vido") or die(mysql_error());
	}
}

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
