<?php

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['name']) && isset($_POST['number']) && isset($_POST['town']) && isset($_POST['sex']) && isset($_POST['trailer']) && isset($_POST['slalom']) && isset($_POST['drag'])) {
    
    $name = $_POST['name'];
    $number = $_POST['number'];
	$town = $_POST['town'];
    $sex = $_POST['sex'];
	$trailer = $_POST['trailer'];
	$slalom = $_POST['slalom'];
	$drag = $_POST['drag'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched number
    $result = mysql_query("UPDATE adatok SET nev = '$name', varos = '$town', nem = '$sex', potkocsi = '$trailer', szlalom = '$slalom', gyorsulas = '$drag' WHERE rajt = $number");
	
	if($trailer == "true") {
		mysql_query("INSERT INTO potkocsi(rajt, nev, ido, hiba, vido) VALUES('$number', '$name', '9:99:999', '99', '9:99:999')");
	} else {
		mysql_query("DELETE FROM potkocsi WHERE rajt = $number");
	}
		
	if($slalom == "true") {
		mysql_query("INSERT INTO szlalom(rajt, nev, ido, hiba, vido) VALUES('$number', '$name', '9:99:999', '99', '9:99:999')");
	} else {
		mysql_query("DELETE FROM szlalom WHERE rajt = $number");
	}
		
	if($drag == "true") {
		mysql_query("INSERT INTO gyorsulas(rajt, nev, ido1, ido2, lido) VALUES('$number', '$name', '9:99:999', '9:99:999', '9:99:999')");
	} else {
		mysql_query("DELETE FROM gyorsulas WHERE rajt = $number");
	}
	
	
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
