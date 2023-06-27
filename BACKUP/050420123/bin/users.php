<?php

	session_start();
	
?>

<!DOCTYPE html>
<html>
<title>Heesung Electornics</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">

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
	
	width: 100%; 	
	margin: 0 auto;
	//border: 1px solid black;
	//margin: auto;
	height: 80px; 
	//width: 2200px; 
	border-top-right-radius: 10px !important;
	border-top-left-radius: 10px !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	border-spacing: 2mm 2mm !important;
	text-align: center;
	//font-size: 28pt;
}

.worker-input {
	
	margin: 0 auto;
	text-align: center;
}
.form-button{
    margin: 0 auto;
    padding: revert;
    padding: 10px;
}

th, td {
  //font-weight: unset;
  padding 10px;
  //padding-left: 16px;
  //margin: auto;
  //text-align: center;
  border-top-right-radius: 0px;
  border-top-left-radius: 0px;
  border-bottom-right-radius: 0px;
  border-bottom-left-radius: 0px;
  box-shadow: 0px 0px 0px;

}



</style>

<body>

<!-- Sidebar -->
<nav class="w3-sidebar w3-black w3-animate-top w3-xxlarge" style="display:none;padding-top:150px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-black w3-xxlarge w3-padding w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <div class="w3-bar-block w3-center">
	<?php
		require_once('navigation.php');
	?>
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
  <h2>BAZA PRACOWNICY</h2>
  <p><b></b></p>
  
</header>

<div class="worker-input">

	
<?php
	  

    /////
//require_once "connect2.php";
//mysqli_report(MYSQLI_REPORT_STRICT);
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dzrcp";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




    if(/*$_SERVER['REQUEST_METHOD'] == "POST" and */isset($_POST['someAction']))
    {
        func();
    }
    function func()
    {
        //$ID_NO = $row["ID"];
		$ID_NO = 12;
		$_SESSION['ID_NO'] = $ID_NO;
		//header('Location: after-photo-input.php');
    }


$i = 1;
$DATE = date("Y-m-d");
$DATE_TIME = date("Y-m-d\TH-i-s");

$sql = "SELECT * FROM pracownicy";

$result = $conn->query($sql);
			
			echo "<TABLE BORDER=1 ALIGN='CENTER'>";
			echo "<tr style='background-color: red; color: #fff;'>";
			echo "<td>No.</td>";
			//echo "<td>ID</td>";
			echo "<td>IMIE</td>";
			echo "<td>NAZWISKO</td>";
			echo "<td>B-access ID</td>";	
			echo "<td>DZ-READER ID</td>";			
			echo "</tr>";
			
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		


			echo "<tr>";
			echo "<td>".$i++."</td>";
			//echo "<td>".$row["ID"]."</td>";
			echo "<td>".$row["IMIE"]."</td>";
			echo "<td>".$row["NAZWISKO"]."</td>";
			echo "<td>".$row["BA_ID"]."</td>";
			echo "<td>".$row["ID"]."</td>";
			echo "</tr>";

			
		

        //echo "<br> id: ". $row["MIC_NO"]. " - Name: ". $row["POSITION"]. "<br>";
		
    }
	echo "</TABLE>";
} else {
    echo "0 results";
}

$conn->close();   
 echo '</div>';


//<!-- End Page Content -->
 ?>
</div>
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

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>
