<?php
session_start();
// wyłączenie niepotrzebnych komunikatów NOTICE
//error_reporting(E_ALL ^ E_NOTICE);
require_once "connect3.php";
mysqli_report(MYSQLI_REPORT_STRICT);
try 
{
	if(isset($_POST['PN'])) {
		
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		$var = mysqli_real_escape_string($polaczenie, $_POST['PN']);
		//echo "oto znienna var ";
		//echo $var;
		if(empty($var)) {
			echo "Pole formularza jest puste, proszę wypełnić pole <br>";
		}
		
		
		$sqla = mysqli_query($polaczenie, "SELECT COUNT(*) AS czy_istnieje FROM `common_all_long_name` WHERE `HS_PN` ='$var' ;");
					
			while ($row = $sqla->fetch_assoc()){
			//echo "<p><option value=".$row['czy_istnieje'].">".$row['czy_istnieje']."</option></p>";
			$moja_zmienna = $row['czy_istnieje'];
			}
		if ($moja_zmienna == 1)
		{
			$_SESSION['zmianamodelu']=$_POST['PN'];
			echo "Model ustawiony poprawnie. Życzę miłego używania aplikacji";
			header("Location: index.php");
			exit();
		}
		else
		{
			echo "Proszę ustawić poprawny model <br>";
			echo "<br><br>";
			echo "<a href ='modelchange.php'>Powrót do wyboru</a>";
		}
	}
	
}
catch(Exception $e)
{
	echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
	echo '<br />Informacja developerska: '.$e;
}
?>
<!DOCTYPE html>
<html>
<title>Heesung Electornics</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <meta http-equiv="refresh" content="1; URL=index.php"> -->
<body></body>
</html>