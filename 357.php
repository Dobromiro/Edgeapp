<?php

	$arrayMonth = array();
	$arrayWeek = array();
	$arrayDays = array();
	
	$DATE = date("Y-m-d");
	
	$SamMiesiac = date("m");
	
	require_once "connect2.php";
	try {
		mysqli_report(MYSQLI_REPORT_STRICT);
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	} 
	catch (Exception $e) {
		echo "Błąd połączenia z bazą danych: " . $e->getMessage();
	}
	
	$zap1 = "SELECT `DATE` FROM data GROUP BY `DATE` ORDER BY `DATE` LIMIT 7"; 
	$result = $polaczenie->query($zap1);
	
	$ii = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$arrayDays[$ii] = $row['DATE'];
			$ii++;
		}
	}
	
	$zap2 = "SELECT DATE_FORMAT(date, '%Y-%m') AS month FROM ( SELECT CURDATE() - INTERVAL 0 MONTH AS date UNION SELECT CURDATE() - INTERVAL 1 MONTH UNION SELECT CURDATE() - INTERVAL 2 MONTH ) months ORDER BY month ASC"; //3 ostatnie miesiące nazwy
	$result2 = $polaczenie->query($zap2);
	$ii = 0;
	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			$arrayMonth[$ii] = $row['month'];
			$ii++;
		}
	}

	$zap5 = "SELECT WEEK(NOW()) AS WEEK";
	$result5 = $polaczenie->query($zap5);
	$ii = 0;
	$row = $result5->fetch_assoc();
	$var = $row['WEEK'];
	
	while ($ii < 5)
	{
		$arrayWeek[$ii] = $var;
		$ii++;
		$var = $var -1;
	}
	
	/*
	$zap3 ="SELECT * FROM data WHERE `DATE` BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 1 MONTH)"; // dane, tylko ostani miesiac

	$zap4 = "SELECT * FROM tabela_danych WHERE data BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW();"; // bierzący miesiąc
	
	$zap6 = "SELECT * FROM data WHERE YEARWEEK(`DATE`) = YEARWEEK(NOW())"; // bierzący tydzień
	*/
	
	echo "<h3>55UR</h3>";
	echo "<table border = '1'>";
		echo "<tr style='font-weight: bold;'>";
			echo "<td></td>";
			echo "<td>".$arrayMonth[0]."</td>";
			echo "<td>".$arrayMonth[1]."</td>";
			echo "<td>".$arrayMonth[2]."</td>";
			
			echo "<td>&nbsp;&nbsp;</td>";
			
			echo "<td>WW".$arrayWeek[4]."</td>";
			echo "<td>WW".$arrayWeek[3]."</td>";
			echo "<td>WW".$arrayWeek[2]."</td>";
			echo "<td>WW".$arrayWeek[1]."</td>";
			echo "<td>WW".$arrayWeek[0]."</td>";
			
			echo "<td>&nbsp;&nbsp;</td>";
			
			echo "<td>".$arrayDays[0]."</td>";
			echo "<td>".$arrayDays[1]."</td>";
			echo "<td>".$arrayDays[2]."</td>";
			echo "<td>".$arrayDays[3]."</td>";
			echo "<td>".$arrayDays[4]."</td>";
			echo "<td>".$arrayDays[5]."</td>";
			echo "<td>".$arrayDays[6]."</td>";
		echo "</tr>";
		//TOTAL
		echo "<tr>";
			echo "<td>Total</td>";
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE `DATE` BETWEEN DATE_FORMAT(NOW() - INTERVAL 2 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 2 MONTH) AND data.MODEL = '55UR'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE `DATE` BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 1 MONTH) AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
				
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW() AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			
			echo "<td>".$row['55UR_OUT']."</td>";
			
			echo "<td>&nbsp;&nbsp;</td>";
			
			// ### week start ###
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[4]' AND data.MODEL = '55UR'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";

			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[3]' AND data.MODEL = '55UR'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[2]' AND data.MODEL = '55UR'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[1]' AND data.MODEL = '55UR'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[0]' AND data.MODEL = '55UR'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			// ### week end ###
			
			echo "<td>&nbsp;&nbsp;</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[0]' AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[1]' AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();			
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[2]' AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();	
			echo "<td>".$row['55UR_OUT']."</td>";			
			

			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[3]' AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[4]' AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";		
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[5]' AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[6]' AND data.MODEL = '55UR'"; 
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";
		echo "</tr>";
		// OUTSIDE
		echo "<tr>";
			echo "<td>OUTSIDE</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE `DATE` BETWEEN DATE_FORMAT(NOW() - INTERVAL 2 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 2 MONTH) AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE `DATE` BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 1 MONTH) AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
				
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW() AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			
			echo "<td>".$row['55UR_OUT']."</td>";
			
			echo "<td>&nbsp;&nbsp;</td>";
			

			// ### week start ###
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[4]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";

			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[3]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[2]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[1]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[0]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			// ### week end ###
			
			echo "<td>&nbsp;&nbsp;</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[0]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[1]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();			
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[2]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();	
			echo "<td>".$row['55UR_OUT']."</td>";			
			

			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[3]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[4]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";		
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[5]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[6]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'OUTSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";
			
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>INSIDE</td>";
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE `DATE` BETWEEN DATE_FORMAT(NOW() - INTERVAL 2 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 2 MONTH) AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE `DATE` BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 1 MONTH) AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
				
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW() AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			
			echo "<td>".$row['55UR_OUT']."</td>";
			
			echo "<td>&nbsp;&nbsp;</td>";
			// ### week start ###
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[4]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";

			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[3]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[2]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[1]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_WEEK FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE YEARWEEK(data.DATE, 1) = 2023*100+'$arrayWeek[0]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_WEEK']."</td>";			
			// ### week end ###
			echo "<td>&nbsp;&nbsp;</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[0]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[1]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();			
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[2]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();	
			echo "<td>".$row['55UR_OUT']."</td>";			
			

			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[3]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[4]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";		
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[5]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";			
			
			$plot1 = "SELECT COUNT(defect_name.CAT_3) AS 55UR_OUT FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE DATE = '$arrayDays[6]' AND data.MODEL = '55UR' AND defect_name.CAT_1 = 'INSIDE'";
			$plot_res = $polaczenie->query($plot1);
			$row = $plot_res->fetch_assoc();
			echo "<td>".$row['55UR_OUT']."</td>";
		echo "</tr>";
	echo "</table>";
?>