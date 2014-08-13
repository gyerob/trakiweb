<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['group'])) {
	$group = $_GET['group'];
	
	if ($group == 0) {
		$result = mysql_query("SELECT *FROM adatok") or die(mysql_error());
	} else if ($group == 1) {
		$result = mysql_query("SELECT *FROM adatok WHERE csoport = '1'") or die(mysql_error());
	} else if ($group == 2)	{
		$result = mysql_query("SELECT *FROM adatok WHERE csoport = '2'") or die(mysql_error());
	}
} else {
	$result = mysql_query("SELECT *FROM adatok") or die(mysql_error());
}


// check for empty result
if (mysql_num_rows($result) > 0) {
    $response["racers"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        $racers = array();
        $racers["rajt"] = $row["rajt"];
        $racers["nev"] = $row["nev"];
        $racers["varos"] = $row["varos"];
		$racers["potkocsi"] = $row["potkocsi"];
		$racers["szlalom"] = $row["szlalom"];
		$racers["gyorsulas"] = $row["gyorsulas"];
		$racers["csoport"] = $row["csoport"];
		$racers["pont"] = $row["abszolut"];

        array_push($response["racers"], $racers);
    }
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No racers found";

    echo json_encode($response);
}
?>
