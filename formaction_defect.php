<?php

	session_start();
	// wyłączenie niepotrzebnych komunikatów NOTICE
	error_reporting(E_ALL ^ E_NOTICE);
	$value = 0;

	
	if (isset($_SESSION['zmianamodelu']))
	{

		
		require_once "connect2.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
						//$name = $_POST['name'];
						$DATE = date("Y-m-d");
						$TIME = date("H:i:s");
						$DEFECT = $_POST['button_one'];
						//$DEFECT = "RYSA"; 
						$CATEGORY = "LGP";
						$MODEL = $_SESSION['zmianamodelu'];
						$OPERATOR = "SUPERMAN";
						$LINE = "BMS10";

											
						
						
						
					if ($polaczenie->query("INSERT INTO data VALUES ('$DATE', '$TIME', '$DEFECT', '$CATEGORY', '$MODEL', '$OPERATOR', '$LINE')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: dziekuje.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	else
	{
		echo "MODEL DIND'T SET. <a href='index.php'>COMEBACK AND SET MODEL</a>";
	}
	

	
	
?>