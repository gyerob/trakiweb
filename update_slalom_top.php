<?php

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['rajt']) && isset($_POST['nev']) && isset($_POST['nyert']) && isset($_POST['kor'])) {
    
    $rajt = $_POST['rajt'];
    $nev = $_POST['nev'];
    $nyert = $_POST['nyert'];
    $kor = $_POST['kor'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched rajt
	if ($kor == 1) {
		$result = mysql_query("UPDATE szkor1 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
	} else if ($kor == 2) }
		$result = mysql_query("UPDATE szkor2 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
	} else if ($kor == 3) {
		$result = mysql_query("UPDATE szkor3 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
	} else if ($kor == 4) {
		$result = mysql_query("UPDATE szkor4 SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
	} else {
		$result = mysql_query("UPDATE szeredmeny SET nev = '$nev', nyert = '$nyert' WHERE rajt = $rajt");
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
