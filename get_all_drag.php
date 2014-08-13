<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['group'])) {
	$group = $_GET['group'];
	
	if ($group == 0) {
		$result = mysql_query("SELECT *FROM gyorsulas ORDER BY lido") or die(mysql_error());
	} else if ($group == 1) {
		$result = mysql_query("SELECT *FROM gyorsulas WHERE csoport = '1' ORDER BY lido") or die(mysql_error());
	} else if ($group == 2)	{
		$result = mysql_query("SELECT *FROM gyorsulas WHERE csoport = '2' ORDER BY lido") or die(mysql_error());
	}
} else {
	$result = mysql_query("SELECT *FROM gyorsulas ORDER BY lido") or die(mysql_error());
}

if (mysql_num_rows($result) > 0) {
    $response["drag"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        $drag = array();
        $drag["rajt"] = $row["rajt"];
        $drag["nev"] = $row["nev"];
        $drag["ido1"] = $row["ido1"];
        $drag["ido2"] = $row["ido2"];
		$drag["lido"] = $row["lido"];

        array_push($response["drag"], $drag);
    }
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No dragracers found";

    echo json_encode($response);
}
?>
