<?php
	require_once "connect2.php";
	mysqli_report(MYSQLI_REPORT_STRICT);

	// Create connection
	$conn = new mysqli($host, $db_user, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	

	//$sql = "LOAD DATA INFILE 'file_test.csv' INTO TABLE reader_data FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' (ID, @DATE, TIME, RESULT, NOTCHING, READER) SET DATE = STR_TO_DATE(@DATE, '%d.%m.%Y')";
	
	//mysqli_query($result, "SET @a:='this will not work'");
	
	$CURR_DATE = date("Y-m-d");
	$sql = "SELECT CONCAT(0,0,0,pracownicy.BA_ID), DATE_FORMAT(reader_data.DATE,'%d.%m.%Y ') AS niceDate, reader_data.TIME, reader_data.RESULT, reader_data.NOTCHING, reader_data.READER
	INTO OUTFILE 'C:/xampp/htdocs/RCP_HSDZ_06.dat'
	FIELDS TERMINATED BY ',' 
	LINES TERMINATED BY '\n'
	FROM reader_data 
	INNER JOIN pracownicy on pracownicy.ID = reader_data.ID 
	WHERE reader_data.DATE = '2022-03-25'
	ORDER BY reader_data.DATE, reader_data.TIME";
	$result = $conn->query($sql);
	echo $CURR_DATE;
	
//HOUR (`reader_data.TIME`) BETWEEN '1' AND '6' AND
//	WHERE reader_data.DATE = '".$CURR_DATE."'
	
	
?>