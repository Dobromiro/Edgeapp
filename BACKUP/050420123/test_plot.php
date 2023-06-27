<?php

require_once "connect2.php";
	try {
		mysqli_report(MYSQLI_REPORT_STRICT);
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	} 
	catch (Exception $e) {
		echo "Błąd połączenia z bazą danych: " . $e->getMessage();
	}

	$sql = "SELECT COUNT(defect_name.CAT_1) AS QTY_OTS FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE data.DATE ="2023-04-05" AND defect_name.CAT_1 = "OUTSIDE";
	$result = $polaczenie->query($sql);
	
	$row = $result->fetch_assoc()
	echo "test text";
	echo $row['QTY_OTS'];
	
	
?>