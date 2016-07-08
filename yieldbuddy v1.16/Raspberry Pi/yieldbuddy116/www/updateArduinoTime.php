<?php
session_start();
include 'sql/sql_arduino_firstrow.php';
	  $Arduino_Time=$_SESSION['Arduino_Time'];
	  echo "Arduino Time: ";
	  echo $Arduino_Time. "<br />";
?>
