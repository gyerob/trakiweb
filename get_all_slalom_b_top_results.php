<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

$result = mysql_query("SELECT *FROM szberedmeny ORDER BY pid") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    $response["slalom"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        $slalom = array();
        $slalom["rajt"] = $row["rajt"];
        $slalom["nev"] = $row["nev"];
        $slalom["pid"] = $row["pid"];

        array_push($response["slalom"], $slalom);
    }
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Nem található versenyző";

    echo json_encode($response);
}
?>
