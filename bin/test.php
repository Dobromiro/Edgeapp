<?php

$CURRENT_DATE = date("Y-m-d");
echo $CURRENT_DATE."<br>";

$CURRENT_DATE2 = date("Y-m-d");
$n = date('Y-m-d', strtotime( $d . " -1 days"));
echo $CURRENT_DATE2;
echo $n."<br><br>";
echo $d;
?>
