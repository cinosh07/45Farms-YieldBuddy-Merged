<?php
session_start();
//SET MAXIMUM NUMBER OF ROWS TO QUERY HERE:
$MaximumRows = 1;
//echo "Maximum Number of Rows: " . $MaximumRows . "<br></br>";

//Load SQL settings
$sql_address=trim($_SESSION['sql_address']);
$sql_username=trim($_SESSION['sql_username']);
$sql_password=trim($_SESSION['sql_password']);
$sql_database=trim($_SESSION['sql_database']);

//echo "|" . $sql_address . "| |" . $sql_username . "| |" . $sql_password . "| |" . $sql_database . "|<br></br>";

//echo "Querying SQL Database...<br></br>";

//record the starting time 
$start=microtime(); 
$start=explode(" ",$start); 
$start=$start[1]+$start[0];

$mysqli = new mysqli($sql_address, $sql_username, $sql_password, $sql_database, 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


//pH1
	//Low
	$pH1Value_Low_query = "SELECT Low FROM pH1";
	$pH1Value_Low_result = $mysqli->query($pH1Value_Low_query);     
	if (!$pH1Value_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$pH1Value_Low_row = $pH1Value_Low_result->fetch_row();
	$pH1Value_Low_row = implode(" ", $pH1Value_Low_row);
	//echo $pH1Value_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['pH1Value_Low'] = $pH1Value_Low_row;
	$pH1Value_Low_result->close();
	
	//High
	$pH1Value_High_query = "SELECT High FROM pH1";
	$pH1Value_High_result = $mysqli->query($pH1Value_High_query);     
	if (!$pH1Value_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$pH1Value_High_row = $pH1Value_High_result->fetch_row();
	$pH1Value_High_row = implode(" ", $pH1Value_High_row);
	//echo $pH1Value_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['pH1Value_High'] = $pH1Value_High_row;
	$pH1Value_High_result->close();


//pH2
	//Low
	$pH2Value_Low_query = "SELECT Low FROM pH2";
	$pH2Value_Low_result = $mysqli->query($pH2Value_Low_query);     
	if (!$pH2Value_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$pH2Value_Low_row = $pH2Value_Low_result->fetch_row();
	$pH2Value_Low_row = implode(" ", $pH2Value_Low_row);
	//echo $pH2Value_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['pH2Value_Low'] = $pH2Value_Low_row;
	$pH2Value_Low_result->close();
	
	//High
	$pH2Value_High_query = "SELECT High FROM pH2";
	$pH2Value_High_result = $mysqli->query($pH2Value_High_query);     
	if (!$pH2Value_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$pH2Value_High_row = $pH2Value_High_result->fetch_row();
	$pH2Value_High_row = implode(" ", $pH2Value_High_row);
	//echo $pH2Value_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['pH2Value_High'] = $pH2Value_High_row;
	$pH2Value_High_result->close();

//Temp
	//Low
	$TempValue_Low_query = "SELECT Low FROM Temp";
	$TempValue_Low_result = $mysqli->query($TempValue_Low_query);     
	if (!$TempValue_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$TempValue_Low_row = $TempValue_Low_result->fetch_row();
	$TempValue_Low_row = implode(" ", $TempValue_Low_row);
	//echo $TempValue_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['TempValue_Low'] = $TempValue_Low_row;
	$TempValue_Low_result->close();
	
	//High
	$TempValue_High_query = "SELECT High FROM Temp";
	$TempValue_High_result = $mysqli->query($TempValue_High_query);     
	if (!$TempValue_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$TempValue_High_row = $TempValue_High_result->fetch_row();
	$TempValue_High_row = implode(" ", $TempValue_High_row);
	//echo $TempValue_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['TempValue_High'] = $TempValue_High_row;
	$TempValue_High_result->close();

	//Heater_ON
	$Heater_ON_query = "SELECT Heater_ON FROM Temp";
	$Heater_ON_result = $mysqli->query($Heater_ON_query);     
	if (!$Heater_ON_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$Heater_ON_row = $Heater_ON_result->fetch_row();
	$Heater_ON_row = implode(" ", $Heater_ON_row);
	//echo $Heater_ON_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['Heater_ON'] = $Heater_ON_row;
	$Heater_ON_result->close();
	
	//Heater_OFF
	$Heater_OFF_query = "SELECT Heater_OFF FROM Temp";
	$Heater_OFF_result = $mysqli->query($Heater_OFF_query);     
	if (!$Heater_OFF_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$Heater_OFF_row = $Heater_OFF_result->fetch_row();
	$Heater_OFF_row = implode(" ", $Heater_OFF_row);
	//echo $Heater_OFF_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['Heater_OFF'] = $Heater_OFF_row;
	$Heater_OFF_result->close();
	
	//AC_ON
	$AC_ON_query = "SELECT AC_ON FROM Temp";
	$AC_ON_result = $mysqli->query($AC_ON_query);     
	if (!$AC_ON_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$AC_ON_row = $AC_ON_result->fetch_row();
	$AC_ON_row = implode(" ", $AC_ON_row);
	//echo $AC_ON_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['AC_ON'] = $AC_ON_row;
	$AC_ON_result->close();
	
	//AC_OFF
	$AC_OFF_query = "SELECT AC_OFF FROM Temp";
	$AC_OFF_result = $mysqli->query($AC_OFF_query);     
	if (!$AC_OFF_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$AC_OFF_row = $AC_OFF_result->fetch_row();
	$AC_OFF_row = implode(" ", $AC_OFF_row);
	//echo $AC_OFF_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['AC_OFF'] = $AC_OFF_row;
	$AC_OFF_result->close();
	
//RH
	//Low
	$RHValue_Low_query = "SELECT Low FROM RH";
	$RHValue_Low_result = $mysqli->query($RHValue_Low_query);     
	if (!$RHValue_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$RHValue_Low_row = $RHValue_Low_result->fetch_row();
	$RHValue_Low_row = implode(" ", $RHValue_Low_row);
	//echo $RHValue_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['RHValue_Low'] = $RHValue_Low_row;
	$RHValue_Low_result->close();
	
	//High
	$RHValue_High_query = "SELECT High FROM RH";
	$RHValue_High_result = $mysqli->query($RHValue_High_query);     
	if (!$RHValue_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$RHValue_High_row = $RHValue_High_result->fetch_row();
	$RHValue_High_row = implode(" ", $RHValue_High_row);
	//echo $RHValue_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['RHValue_High'] = $RHValue_High_row;
	$RHValue_High_result->close();

	//Humidifier_ON
	$Humidifier_ON_query = "SELECT Humidifier_ON FROM RH";
	$Humidifier_ON_result = $mysqli->query($Humidifier_ON_query);     
	if (!$Humidifier_ON_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$Humidifier_ON_row = $Humidifier_ON_result->fetch_row();
	$Humidifier_ON_row = implode(" ", $Humidifier_ON_row);
	//echo $Humidifier_ON_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['Humidifier_ON'] = $Humidifier_ON_row;
	$Humidifier_ON_result->close();
	
	//Humidifier_OFF
	$Humidifier_OFF_query = "SELECT Humidifier_OFF FROM RH";
	$Humidifier_OFF_result = $mysqli->query($Humidifier_OFF_query);     
	if (!$Humidifier_OFF_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$Humidifier_OFF_row = $Humidifier_OFF_result->fetch_row();
	$Humidifier_OFF_row = implode(" ", $Humidifier_OFF_row);
	//echo $Humidifier_OFF_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['Humidifier_OFF'] = $Humidifier_OFF_row;
	$Humidifier_OFF_result->close();
	
	//Dehumidifier_ON
	$Dehumidifier_ON_query = "SELECT Dehumidifier_ON FROM RH";
	$Dehumidifier_ON_result = $mysqli->query($Dehumidifier_ON_query);     
	if (!$Dehumidifier_ON_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$Dehumidifier_ON_row = $Dehumidifier_ON_result->fetch_row();
	$Dehumidifier_ON_row = implode(" ", $Dehumidifier_ON_row);
	//echo $Dehumidifier_ON_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['Dehumidifier_ON'] = $Dehumidifier_ON_row;
	$Dehumidifier_ON_result->close();
	
	//Dehumidifier_OFF
	$Dehumidifier_OFF_query = "SELECT Dehumidifier_OFF FROM RH";
	$Dehumidifier_OFF_result = $mysqli->query($Dehumidifier_OFF_query);     
	if (!$Dehumidifier_OFF_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$Dehumidifier_OFF_row = $Dehumidifier_OFF_result->fetch_row();
	$Dehumidifier_OFF_row = implode(" ", $Dehumidifier_OFF_row);
	//echo $Dehumidifier_OFF_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['Dehumidifier_OFF'] = $Dehumidifier_OFF_row;
	$Dehumidifier_OFF_result->close();
	
//TDS1
	//Low
	$TDS1Value_Low_query = "SELECT Low FROM TDS1";
	$TDS1Value_Low_result = $mysqli->query($TDS1Value_Low_query);     
	if (!$TDS1Value_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$TDS1Value_Low_row = $TDS1Value_Low_result->fetch_row();
	$TDS1Value_Low_row = implode(" ", $TDS1Value_Low_row);
	//echo $TDS1Value_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['TDS1Value_Low'] = $TDS1Value_Low_row;
	$TDS1Value_Low_result->close();
	
	//High
	$TDS1Value_High_query = "SELECT High FROM TDS1";
	$TDS1Value_High_result = $mysqli->query($TDS1Value_High_query);     
	if (!$TDS1Value_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$TDS1Value_High_row = $TDS1Value_High_result->fetch_row();
	$TDS1Value_High_row = implode(" ", $TDS1Value_High_row);
	//echo $TDS1Value_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['TDS1Value_High'] = $TDS1Value_High_row;
	$TDS1Value_High_result->close();

	//NutePump1_ON
	$NutePump1_ON_query = "SELECT NutePump1_ON FROM TDS1";
	$NutePump1_ON_result = $mysqli->query($NutePump1_ON_query);     
	if (!$NutePump1_ON_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$NutePump1_ON_row = $NutePump1_ON_result->fetch_row();
	$NutePump1_ON_row = implode(" ", $NutePump1_ON_row);
	//echo $NutePump1_ON_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['NutePump1_ON'] = $NutePump1_ON_row;
	$NutePump1_ON_result->close();
	
	//NutePump1_OFF
	$NutePump1_OFF_query = "SELECT NutePump1_OFF FROM TDS1";
	$NutePump1_OFF_result = $mysqli->query($NutePump1_OFF_query);     
	if (!$NutePump1_OFF_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$NutePump1_OFF_row = $NutePump1_OFF_result->fetch_row();
	$NutePump1_OFF_row = implode(" ", $NutePump1_OFF_row);
	//echo $NutePump1_OFF_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['NutePump1_OFF'] = $NutePump1_OFF_row;
	$NutePump1_OFF_result->close();
	
	//MixPump1_Enabled
	$MixPump1_Enabled_query = "SELECT MixPump1_Enabled FROM TDS1";
	$MixPump1_Enabled_result = $mysqli->query($MixPump1_Enabled_query);     
	if (!$MixPump1_Enabled_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$MixPump1_Enabled_row = $MixPump1_Enabled_result->fetch_row();
	$MixPump1_Enabled_row = implode(" ", $MixPump1_Enabled_row);
	//echo $MixPump1_Enabled_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['MixPump1_Enabled'] = $MixPump1_Enabled_row;
	$MixPump1_Enabled_result->close();
	
//TDS2
	//Low
	$TDS2Value_Low_query = "SELECT Low FROM TDS2";
	$TDS2Value_Low_result = $mysqli->query($TDS2Value_Low_query);     
	if (!$TDS2Value_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$TDS2Value_Low_row = $TDS2Value_Low_result->fetch_row();
	$TDS2Value_Low_row = implode(" ", $TDS2Value_Low_row);
	//echo $TDS2Value_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['TDS2Value_Low'] = $TDS2Value_Low_row;
	$TDS2Value_Low_result->close();
	
	//High
	$TDS2Value_High_query = "SELECT High FROM TDS2";
	$TDS2Value_High_result = $mysqli->query($TDS2Value_High_query);     
	if (!$TDS2Value_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$TDS2Value_High_row = $TDS2Value_High_result->fetch_row();
	$TDS2Value_High_row = implode(" ", $TDS2Value_High_row);
	//echo $TDS2Value_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['TDS2Value_High'] = $TDS2Value_High_row;
	$TDS2Value_High_result->close();

	//NutePump2_ON
	$NutePump2_ON_query = "SELECT NutePump2_ON FROM TDS2";
	$NutePump2_ON_result = $mysqli->query($NutePump2_ON_query);     
	if (!$NutePump2_ON_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$NutePump2_ON_row = $NutePump2_ON_result->fetch_row();
	$NutePump2_ON_row = implode(" ", $NutePump2_ON_row);
	//echo $NutePump2_ON_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['NutePump2_ON'] = $NutePump2_ON_row;
	$NutePump2_ON_result->close();
	
	//NutePump2_OFF
	$NutePump2_OFF_query = "SELECT NutePump2_OFF FROM TDS2";
	$NutePump2_OFF_result = $mysqli->query($NutePump2_OFF_query);     
	if (!$NutePump2_OFF_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$NutePump2_OFF_row = $NutePump2_OFF_result->fetch_row();
	$NutePump2_OFF_row = implode(" ", $NutePump2_OFF_row);
	//echo $NutePump2_OFF_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['NutePump2_OFF'] = $NutePump2_OFF_row;
	$NutePump2_OFF_result->close();
	
	//MixPump2_Enabled
	$MixPump2_Enabled_query = "SELECT MixPump2_Enabled FROM TDS2";
	$MixPump2_Enabled_result = $mysqli->query($MixPump2_Enabled_query);     
	if (!$MixPump2_Enabled_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$MixPump2_Enabled_row = $MixPump2_Enabled_result->fetch_row();
	$MixPump2_Enabled_row = implode(" ", $MixPump2_Enabled_row);
	//echo $MixPump2_Enabled_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['MixPump2_Enabled'] = $MixPump2_Enabled_row;
	$MixPump2_Enabled_result->close();
	
//CO2
	//Low
	$CO2Value_Low_query = "SELECT Low FROM CO2";
	$CO2Value_Low_result = $mysqli->query($CO2Value_Low_query);     
	if (!$CO2Value_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$CO2Value_Low_row = $CO2Value_Low_result->fetch_row();
	$CO2Value_Low_row = implode(" ", $CO2Value_Low_row);
	//echo $CO2Value_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['CO2Value_Low'] = $CO2Value_Low_row;
	$CO2Value_Low_result->close();
	
	//High
	$CO2Value_High_query = "SELECT High FROM CO2";
	$CO2Value_High_result = $mysqli->query($CO2Value_High_query);     
	if (!$CO2Value_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$CO2Value_High_row = $CO2Value_High_result->fetch_row();
	$CO2Value_High_row = implode(" ", $CO2Value_High_row);
	//echo $CO2Value_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['CO2Value_High'] = $CO2Value_High_row;
	$CO2Value_High_result->close();

	//CO2_ON
	$CO2_ON_query = "SELECT CO2_ON FROM CO2";
	$CO2_ON_result = $mysqli->query($CO2_ON_query);     
	if (!$CO2_ON_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$CO2_ON_row = $CO2_ON_result->fetch_row();
	$CO2_ON_row = implode(" ", $CO2_ON_row);
	//echo $CO2_ON_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['CO2_ON'] = $CO2_ON_row;
	$CO2_ON_result->close();
	
	//CO2_OFF
	$CO2_OFF_query = "SELECT CO2_OFF FROM CO2";
	$CO2_OFF_result = $mysqli->query($CO2_OFF_query);     
	if (!$CO2_OFF_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$CO2_OFF_row = $CO2_OFF_result->fetch_row();
	$CO2_OFF_row = implode(" ", $CO2_OFF_row);
	//echo $CO2_OFF_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['CO2_OFF'] = $CO2_OFF_row;
	$CO2_OFF_result->close();
	
	//CO2_Enabled
	$CO2_Enabled_query = "SELECT CO2_Enabled FROM CO2";
	$CO2_Enabled_result = $mysqli->query($CO2_Enabled_query);     
	if (!$CO2_Enabled_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$CO2_Enabled_row = $CO2_Enabled_result->fetch_row();
	$CO2_Enabled_row = implode(" ", $CO2_Enabled_row);
	//echo $CO2_Enabled_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['CO2_Enabled'] = $CO2_Enabled_row;
	$CO2_Enabled_result->close();

//Light
	//Low
	$LightValue_Low_query = "SELECT Low FROM Light";
	$LightValue_Low_result = $mysqli->query($LightValue_Low_query);     
	if (!$LightValue_Low_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$LightValue_Low_row = $LightValue_Low_result->fetch_row();
	$LightValue_Low_row = implode(" ", $LightValue_Low_row);
	//echo $LightValue_Low_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['LightValue_Low'] = $LightValue_Low_row;
	$LightValue_Low_result->close();
	
	//High
	$LightValue_High_query = "SELECT High FROM Light";
	$LightValue_High_result = $mysqli->query($LightValue_High_query);     
	if (!$LightValue_High_result) {
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}
	
	$LightValue_High_row = $LightValue_High_result->fetch_row();
	$LightValue_High_row = implode(" ", $LightValue_High_row);
	//echo $LightValue_High_row;
	//echo "&nbsp;&nbsp;&nbsp;";
	$_SESSION['LightValue_High'] = $LightValue_High_row;
	$LightValue_High_result->close();

$mysqli->close();

//record the ending time 
$end=microtime(); 
$end=explode(" ",$end); 
$end=$end[1]+$end[0]; 

//printf("<br></br>Query took %f seconds.",$end-$start);
?>
