<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

$result = mysql_query("SELECT * FROM szbkor1") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    $response["racers"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        $racers = array();
        $racers["rajt"] = $row["rajt"];
        $racers["nev"] = $row["nev"];
        $racers["nyert"] = $row["nyert"];
		$racers["pid"] = $row["pid"];

        array_push($response["racers"], $racers);
    }
	
	$result = mysql_query("SELECT * FROM szbkor2") or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
        $racers = array();
        $racers["rajt"] = $row["rajt"];
        $racers["nev"] = $row["nev"];
        $racers["nyert"] = $row["nyert"];
		$racers["pid"] = $row["pid"];

        array_push($response["racers"], $racers);
    }
	
	$result = mysql_query("SELECT * FROM szbkor3") or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
        $racers = array();
        $racers["rajt"] = $row["rajt"];
        $racers["nev"] = $row["nev"];
        $racers["nyert"] = $row["nyert"];
		$racers["pid"] = $row["pid"];

        array_push($response["racers"], $racers);
    }
	
	$result = mysql_query("SELECT * FROM szbkor4") or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
        $racers = array();
        $racers["rajt"] = $row["rajt"];
        $racers["nev"] = $row["nev"];
        $racers["nyert"] = $row["nyert"];
		$racers["pid"] = $row["pid"];

        array_push($response["racers"], $racers);
    }
	
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Nem található versenyző";

    echo json_encode($response);
}
?>
