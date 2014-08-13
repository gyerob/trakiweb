<?php

$response = array();

if (isset($_POST['rajt']) && isset($_POST['nev']) && isset($_POST['nyert']) && isset($_POST['kor']) && isset($_POST['bump'])) {
    
    $rajt = $_POST['rajt'];
    $nev = $_POST['nev'];
    $nyert = $_POST['nyert'];
    $kor = $_POST['kor'];

    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();

	if ($kor == "1") {
		$result = mysql_query("UPDATE szakor1 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
		mysql_query("CALL rangsorolszar1()");
	} else if ($kor == "2") {
		$result = mysql_query("UPDATE szakor2 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
		mysql_query("CALL rangsorolszar2()");
	} else if ($kor == "3") {
		$result = mysql_query("UPDATE szakor3 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
	} else if ($kor == "4") {
		$result = mysql_query("UPDATE szakor4 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
		mysql_query("CALL rangsorolszar4()");
	} else {
		$result = mysql_query("UPDATE szaeredmeny SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
	}

    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Sikeres frissítés";
        
        echo json_encode($response);
    } else {
        
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Hiányzó mező(k)";

    echo json_encode($response);
}
?>
