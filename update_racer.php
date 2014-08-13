<?php

$response = array();

if (isset($_POST['name']) && isset($_POST['number']) && isset($_POST['town']) && isset($_POST['trailer']) && isset($_POST['slalom']) && isset($_POST['drag']) && isset($_POST['group'])) {
    
    $name = $_POST['name'];
    $number = $_POST['number'];
	$town = $_POST['town'];
    $group = $_POST['group'];
	$trailer = $_POST['trailer'];
	$slalom = $_POST['slalom'];
	$drag = $_POST['drag'];

    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();

    $result = mysql_query("UPDATE adatok SET nev = '$name', varos = '$town', potkocsi = '$trailer', szlalom = '$slalom', gyorsulas = '$drag', csoport = '$group' WHERE rajt = $number");
	
	if($trailer == "true") {
		mysql_query("INSERT INTO potkocsi(rajt, nev, ido, hiba, vido) VALUES('$number', '$name', '9:99:999', '99', '9:99:999') ON DUPLICATE KEY UPDATE nev = '$name'");
	} else {
		mysql_query("DELETE FROM potkocsi WHERE rajt = $number");
	}
		
	if($slalom == "true") {
		mysql_query("INSERT INTO szlalom(rajt, nev, ido, hiba, vido) VALUES('$number', '$name', '9:99:999', '99', '9:99:999') ON DUPLICATE KEY UPDATE nev = '$name'");
	} else {
		mysql_query("DELETE FROM szlalom WHERE rajt = $number");
	}
		
	if($drag == "true") {
		mysql_query("INSERT INTO gyorsulas(rajt, nev, ido1, ido2, lido) VALUES('$number', '$name', '9:99:999', '9:99:999', '9:99:999') ON DUPLICATE KEY UPDATE nev = '$name'");
	} else {
		mysql_query("DELETE FROM gyorsulas WHERE rajt = $number");
	}
	
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
        echo json_encode($response);
    } else {
        
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    echo json_encode($response);
}
?>
