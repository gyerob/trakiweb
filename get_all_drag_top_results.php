<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

$result = mysql_query("SELECT *FROM gyeredmeny ORDER BY pid") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    $response["drag"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        $drag = array();
        $drag["rajt"] = $row["rajt"];
        $drag["nev"] = $row["nev"];
        $drag["pid"] = $row["pid"];

        array_push($response["drag"], $drag);
    }
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Nem található versenyző";

    echo json_encode($response);
}
?>
