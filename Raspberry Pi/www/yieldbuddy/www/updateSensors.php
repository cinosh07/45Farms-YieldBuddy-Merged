<?php
session_start();
//var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/sql_sensors_firstrow.php'));
include $_SERVER['DOCUMENT_ROOT'].'/yieldbuddy2/www/sql/sql_sensors_firstrow.php';
	  $pH1=$_SESSION['Sensors_pH1'];
	  echo "pH1: ";
	  echo $pH1. "<br />";
	  
	  $pH2=$_SESSION['Sensors_pH2'];
	  echo "pH2: ";
	  echo $pH2. "<br />";

	  $Temp=$_SESSION['Sensors_Temp'];
	  echo "Temp: ";
	  echo $Temp. "<br />";

	  $RH=$_SESSION['Sensors_RH'];
	  echo "RH: ";
	  echo $RH. "<br />";

	  $TDS1=$_SESSION['Sensors_TDS1'];
	  echo "TDS1: ";
	  echo $TDS1. "<br />";

	  $TDS2=$_SESSION['Sensors_TDS2'];
	  echo "TDS2: ";
	  echo $TDS2. "<br />";

	  $CO2=$_SESSION['Sensors_CO2'];
	  echo "CO2: ";
	  echo $CO2. "<br />";

	  $Light=$_SESSION['Sensors_Light'];
	  echo "Light: ";
	  echo $Light. "<br />";
	  
	  $Water=$_SESSION['Sensors_Water'];
	  echo "Water: ";
	  echo $Water. "<br />";
	  
	  $MagX=$_SESSION['Sensors_MagX'];
	  echo "MagX: ";
	  echo $MagX. "<br />";	  
	  
	  $MagY=$_SESSION['Sensors_MagY'];
	  echo "MagY: ";
	  echo $MagY. "<br />";
	  
	  $MagZ=$_SESSION['Sensors_MagZ'];
	  echo "MagZ: ";
	  echo $MagZ. "<br />";
	  
	  $TankTotal=$_SESSION['Sensors_TankTotal'];
	  echo "Total Water: ";
	  echo $TankTotal. "<br />";
	  
	  $Tank1=$_SESSION['Sensors_Tank1'];
	  echo "Tank1: ";
	  echo $Tank1. "<br />";
	  
	  $Tank2=$_SESSION['Sensors_Tank2'];
	  echo "Tank2: ";
	  echo $Tank2. "<br />";
	  
	  $Tank3=$_SESSION['Sensors_Tank3'];
	  echo "Tank3: ";
	  echo $Tank3. "<br />";	  

	  $Tank4=$_SESSION['Sensors_Tank4'];
	  echo "Tank4: ";
	  echo $Tank4. "<br />";	  
	  
?>
