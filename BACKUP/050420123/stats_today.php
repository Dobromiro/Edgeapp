<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
?>

<!DOCTYPE html>
<html>
<title>Heesung Electornics</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<style>
body,h1 {font-family: "Montserrat", sans-serif}
img {margin-bottom: -7px}
.w3-row-padding img {margin-bottom: 12px}

* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}

/* Slideshow container */
.slideshow-container {
  position: relative;
  background: #f1f1f1f1;
}

/* Slides */
.mySlides {
  display: none;
  padding: 80px;
  text-align: center;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -30px;
  padding: 16px;
  color: #888;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  position: absolute;
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
  color: white;
}

/* The dot/bullet/indicator container */
.dot-container {
    text-align: center;
    padding: 20px;
    background: #ddd;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

/* Add a background color to the active dot/circle */
.active, .dot:hover {
  background-color: #717171;
}

/* Add an italic font style to all quotes */
q {font-style: italic;}

/* Add a blue color to the author */
.author {color: cornflowerblue;}

table {
	
	width: 50%; 	
	margin: 0 auto;
	font-size: 38px;
	line-height: 100px;
}

td {
	padding: 15px;
	box-shadow: 0px 0px 0px!important;
	border: 1px solid !important;
	
}

.worker-input {
	
	margin: 0 auto;
	text-align: center;
}

  .table-cell-link {
    display: block;
    text-decoration: none;
    color: inherit;
    width: 100%;
    height: 100%;
  }

</style>

<body>

<nav class="w3-sidebar w3-black w3-animate-top w3-xxlarge" style="display:none;padding-top:150px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-black w3-xxlarge w3-padding w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <div class="w3-bar-block w3-center">
  <div class="w3-bar-block w3-center">
	<?php
		require_once('navigation.php');
	?>
  </div>
  </div>
</nav>
<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">

<!-- Header -->
<div class="w3-opacity">
<span class="w3-button w3-xxlarge w3-white w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></span> 
<div class="w3-clear"></div>
<header class="w3-center w3-margin-bottom">
  <h1><b>HS System</b></h1>
  <p><b></b></p>
  <p><b></b></p>
  <h2>LQC LGP REPORT</h2>
  <p><b></b></p>
  
  
</header>

<div class="worker-input">


	
		
		</br>
		</br>
		</div>
		
		<table style="font-size: 20px; padding: 0px; ">
			<td><b>No.</b></td>
			<td><b>TIME</b></td>
			<td><b>MODEL</b></td>
			<td><b>LEVEL1.</b></td>
			<td><b>LEVEL2.</b></td>
			<td><b>LEVEL3.</b></td>
			
		<div style="font-size: 30px; text-align: center; margin: 0 auto;">
		<?php
			//sql = "SELECT `MODEL`, COUNT(`DEFECT`) FROM `data` WHERE `DATE` = '2023-03-23' GROUP BY `MODEL`;"
			
			require_once "connect2.php";
			try {
				mysqli_report(MYSQLI_REPORT_STRICT);
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			} 
			catch (Exception $e) {
			echo "Błąd połączenia z bazą danych: " . $e->getMessage();
			}
			echo "<b>TODAY RESULTS:</b><br><br>";
			echo "<br>";
			$DZIS = date("Y-m-d");
			$i = 1;
			//$sqla = mysqli_query($polaczenie, "SELECT `MODEL`, COUNT(`DEFECT`) AS Qty FROM `data` WHERE `DATE` = '$DZIS' GROUP BY `MODEL`");
			$sqla = mysqli_query($polaczenie, "SELECT data.TIME, data.MODEL, defect_name.CAT_1, defect_name.CAT_2, defect_name.CAT_3 FROM `data` INNER JOIN defect_name ON data.DEFECT = defect_name.ID WHERE data.DATE = '$DZIS'");
			while ($row = $sqla->fetch_assoc()){		
			echo "<tr>";
			echo "<td>".$i++."</td>";
			echo "<td>".$row["TIME"]."</td>";
			echo "<td>".$row["MODEL"]."</td>";
			echo "<td>".$row["CAT_1"]."</td>";
			echo "<td>".$row["CAT_2"]."</td>";
			echo "<td>".$row["CAT_3"]."</td>";
			echo "</tr>";
			
			}
		?>
		</div>
	</table>

<!-- End Page Content -->
</div>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-opacity w3-xlarge" style="margin-top:128px"> 

  <p class="w3-medium">Powered by HSMA IT TEAM</p></a></p>
</footer>
 
<script>
// Toggle grid padding
function myFunction() {
    var x = document.getElementById("myGrid");
    if (x.className === "w3-row") {
        x.className = "w3-row-padding";
    } else { 
        x.className = x.className.replace("w3-row-padding", "w3-row");
    }
}

// Open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.width = "100%";
    document.getElementById("mySidebar").style.display = "block";
}
riko 

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>
