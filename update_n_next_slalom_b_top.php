<?php

$response = array();

if (isset($_POST['rajt']) && isset($_POST['nev']) && isset($_POST['kor']) && isset($_POST['pid'])) {
    
    $rajt = $_POST['rajt'];
    $nev = $_POST['nev'];
    $kor = $_POST['kor'];
	$pid = $_POST['pid'];

    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();

	if ($kor == "1") {
		$result = mysql_query("UPDATE szbkor1 SET nev = '$nev', rajt = $rajt WHERE pid = '$pid'");
	} else if ($kor == "2") {
		$result = mysql_query("UPDATE szbkor2 SET nev = '$nev', rajt = $rajt WHERE pid = '$pid'");
	} else if ($kor == "3") {
		$result = mysql_query("UPDATE szbkor3 SET nev = '$nev', rajt = $rajt WHERE pid = '$pid'");
	} else if ($kor == "4") {
		$result = mysql_query("UPDATE szbkor4 SET nev = '$nev', rajt = $rajt WHERE pid = '$pid'");
	} else {
		$result = mysql_query("UPDATE szberedmeny SET nev = '$nev', rajt = $rajt WHERE pid = '$pid'");
	}

    if ($result) {
        $response["success"] = 1;
        $response["message"] = "név='$nev', rajt='$rajt', kör='$kor', pid='$pid'";//"Sikeres frissítés";
        
        echo json_encode($response);
    } else {
        
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Hiányzó mező(k)";

    echo json_encode($response);
}
?>
