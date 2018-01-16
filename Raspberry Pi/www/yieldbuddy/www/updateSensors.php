<?php
session_start();
//var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/sql_sensors_firstrow.php'));
include $_SERVER['DOCUMENT_ROOT'].'/yieldbuddy2/www/sql/sql_sensors_firstrow.php';
	  $pH1=$_SESSION['Sensors_pH1'];
          echo '<input type="hidden" id="ph1ValueInput" value="'.$pH1.'"/>';
//	  echo "pH1: ";
//	  echo $pH1. "<br />";
	  
//	  $pH2=$_SESSION['Sensors_pH2'];
//	  echo "pH2: ";
//	  echo $pH2. "<br />";

	  $Temp=$_SESSION['Sensors_Temp'];
          echo '<input type="hidden" id="tempValueInput" value="'.$Temp.'"/>';
//	  echo "Temp: ";
//	  echo $Temp. "<br />";

	  $RH=$_SESSION['Sensors_RH'];
          echo '<input type="hidden" id="rhValueInput" value="'.$RH.'"/>';
//	  echo "RH: ";
//	  echo $RH. "<br />";

//	  $TDS1=$_SESSION['Sensors_TDS1'];
//	  echo "TDS1: ";
//	  echo $TDS1. "<br />";
//
//	  $TDS2=$_SESSION['Sensors_TDS2'];
//	  echo "TDS2: ";
//	  echo $TDS2. "<br />";
//
//	  $CO2=$_SESSION['Sensors_CO2'];
//	  echo "CO2: ";
//	  echo $CO2. "<br />";
//
//	  $Light=$_SESSION['Sensors_Light'];
//	  echo "Light: ";
//	  echo $Light. "<br />";
	  
	  $Water=$_SESSION['Sensors_Water'];
          echo '<input type="hidden" id="waterValueInput" value="'.$Water.'"/>';
//	  echo "Water: ";
//	  echo $Water. " || ";
	  
//	  $MagX=$_SESSION['Sensors_MagX'];
//	  echo "MagX: ";
//	  echo $MagX. "<br />";	  
//	  
//	  $MagY=$_SESSION['Sensors_MagY'];
//	  echo "MagY: ";
//	  echo $MagY. "<br />";
//	  
//	  $MagZ=$_SESSION['Sensors_MagZ'];
//	  echo "MagZ: ";
//	  echo $MagZ. "<br />";
//	  
//	  $TankTotal=$_SESSION['Sensors_TankTotal'];
//	  echo "Total Water: ";
//	  echo $TankTotal. "<br />";
	  
	  $Tank1=$_SESSION['Sensors_Tank1'];
          echo '<input type="hidden" id="tank1ValueInput" value="'.$Tank1.'"/>';
//	  echo "Tank1: ";
//	  echo $Tank1. " || ";
	  
	  $Tank2=$_SESSION['Sensors_Tank2'];
          echo '<input type="hidden" id="tank2ValueInput" value="'.$Tank2.'"/>';
//	  echo "Tank2: ";
//	  echo $Tank2. "";
	  
//	  $Tank3=$_SESSION['Sensors_Tank3'];
//	  echo "Tank3: ";
//	  echo $Tank3. "<br />";	  
//
//	  $Tank4=$_SESSION['Sensors_Tank4'];
//	  echo "Tank4: ";
//	  echo $Tank4. "<br />";	
          
          $WaterTempP1=$_SESSION['Sensors_WaterTempP1'];
          echo '<input type="hidden" id="waterTemp1ValueInput" value="'.$WaterTempP1.'"/>';
//	  echo "WaterTempP1: ";
//	  echo $WaterTempP1. "<br />";
          
//          $WaterTempP2=$_SESSION['Sensors_WaterTempP2'];
//	  echo "WaterTempP2: ";
//	  echo $WaterTempP2. "<br />";
//          
//          $WaterTempP3=$_SESSION['Sensors_WaterTempP3'];
//	  echo "WaterTempP3: ";
//	  echo $WaterTempP3. "<br />";
//          
//          $WaterTempP4=$_SESSION['Sensors_WaterTempP4'];
//	  echo "WaterTempP4: ";
//	  echo $WaterTempP4. "<br />";
	  
?>
