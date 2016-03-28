<?php
session_start();
//var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/sql_sensors_firstrow.php'));
include $_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/sql_sensors_firstrow.php';
	  $pH1=$_SESSION['Sensors_pH1'];
	  echo "SW Probe1: ";
	  echo $pH1. "<br />";
	  
	  $pH2=$_SESSION['Sensors_pH2'];
	  echo "SW Probe2: ";
	  echo $pH2. "<br />";

	  $Temp=$_SESSION['Sensors_Temp'];
	  echo "Temp: ";
	  echo $Temp. "<br />";

	  $RH=$_SESSION['Sensors_RH'];
	  echo "RH: ";
	  echo $RH. "<br />";

	  $TDS1=$_SESSION['Sensors_TDS1'];
	  echo "Mag X: ";
	  echo $TDS1. "<br />";

	  $TDS2=$_SESSION['Sensors_TDS2'];
	  echo "Mag Y: ";
	  echo $TDS2. "<br />";

	  $CO2=$_SESSION['Sensors_CO2'];
	  echo "Mag Z: ";
	  echo $CO2. "<br />";

	  $Light=$_SESSION['Sensors_Light'];
	  echo "Light: ";
	  echo $Light. "<br />";
	  
	  $Water=$_SESSION['Sensors_Water'];
	  echo "Tank1: ";
	  echo $Water. "<br />";
?>
