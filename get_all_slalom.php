<?php

$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['type'])) {
	$type = $_GET['type'];
	if (isset($_GET['group'])) {
		$group = $_GET['group'];
		if ($group == 0) {
			if ($type == "veteran") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 99 AND rajt < 200) ORDER BY vido") or die(mysql_error());
			} else if ($type == "modern") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 100) ORDER BY vido") or die(mysql_error());
			} else if ($type == "150le+") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 40 AND rajt < 60) ORDER BY vido") or die(mysql_error());
			} else if ($type == "150le-") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 41) ORDER BY vido") or die(mysql_error());
			} else if ($type == "women") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 199) ORDER BY vido") or die(mysql_error());
			} else if ($type == "men") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 200) ORDER BY vido") or die(mysql_error());
			}
		} else if ($group == 1) {
			if ($type == "veteran") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 99 AND rajt < 200 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			} else if ($type == "modern") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 100 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			} else if ($type == "150le+") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 40 AND rajt < 60 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			} else if ($type == "150le-") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 41 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			} else if ($type == "women") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 199 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			} else if ($type == "men") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 200 AND csoport = '1') ORDER BY vido") or die(mysql_error());
			}
		} else if ($group == 2) {
			if ($type == "veteran") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 99 AND rajt < 200 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			} else if ($type == "modern") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 100 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			} else if ($type == "150le+") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 40 AND rajt < 60 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			} else if ($type == "150le-") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 41 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			} else if ($type == "women") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 199 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			} else if ($type == "men") {
				$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 200 AND csoport = '2') ORDER BY vido") or die(mysql_error());
			}
		}
	} else {
		if ($type == "veteran") {
			$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 99 AND rajt < 200) ORDER BY vido") or die(mysql_error());
		} else if ($type == "modern") {
			$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 100) ORDER BY vido") or die(mysql_error());
		} else if ($type == "150le+") {
			$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 40 AND rajt < 60) ORDER BY vido") or die(mysql_error());
		} else if ($type == "150le-") {
			$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 41) ORDER BY vido") or die(mysql_error());
		} else if ($type == "women") {
			$result = mysql_query("SELECT *FROM szlalom WHERE (rajt > 199) ORDER BY vido") or die(mysql_error());
		} else if ($type == "men") {
			$result = mysql_query("SELECT *FROM szlalom WHERE (rajt < 200) ORDER BY vido") or die(mysql_error());
		}
	}
} else {
	if (isset($_GET['group'])) {
		$group = $_GET['group'];
		if ($group == 0) {
			$result = mysql_query("SELECT *FROM szlalom ORDER BY vido") or die(mysql_error());
		} else if ($group == 1) {
			$result = mysql_query("SELECT *FROM szlalom WHERE (csoport = '1') ORDER BY vido") or die(mysql_error());
		} else if ($group == 2) {
			$result = mysql_query("SELECT *FROM szlalom WHERE (csoport = '2') ORDER BY vido") or die(mysql_error());
		}
	} else {
		$result = mysql_query("SELECT *FROM szlalom ORDER BY vido") or die(mysql_error());
	}
}

if (mysql_num_rows($result) > 0) {
    $response["slalom"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        $slalom = array();
        $slalom["rajt"] = $row["rajt"];
        $slalom["nev"] = $row["nev"];
        $slalom["ido"] = $row["ido"];
        $slalom["hiba"] = $row["hiba"];
        $slalom["vido"] = $row["vido"];

        array_push($response["slalom"], $slalom);
    }
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No slalomracers found";

    echo json_encode($response);
}
?>
