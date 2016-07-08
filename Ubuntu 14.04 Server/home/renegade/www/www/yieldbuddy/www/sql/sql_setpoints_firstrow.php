<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include($_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/new_SQLite3.php');
$db->busyTimeout(2000);

//pH1
$results = $db->query('SELECT *	FROM pH1');
$column_to_session_value = array(
    "0" => "pH1Value_Low",
    "1" => "pH1Value_High",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 2){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//****************************************
//pH2
$results = $db->query('SELECT *	FROM pH2');
$column_to_session_value = array(
    "0" => "pH2Value_Low",
    "1" => "pH2Value_High",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 2){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//Temp
$results = $db->query('SELECT *	FROM Temp');
$column_to_session_value = array(
    "0" => "TempValue_Low",
    "1" => "TempValue_High",
    "2" => "Heater_ON",
    "3" => "Heater_OFF",
    "4" => "AC_ON",
    "5" => "AC_OFF",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 6){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*********************************************
//RH
$results = $db->query('SELECT *	FROM RH');
$column_to_session_value = array(
    "0" => "RHValue_Low",
    "1" => "RHValue_High",
    "2" => "Humidifier_ON",
    "3" => "Humidifier_OFF",
    "4" => "Dehumidifier_ON",
    "5" => "Dehumidifier_OFF",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 6){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//********************************************
//TDS1
$results = $db->query('SELECT *	FROM TDS1');
$column_to_session_value = array(
    "0" => "TDS1Value_Low",
    "1" => "TDS1Value_High",
    "2" => "NutePump1_ON",
    "3" => "NutePump1_OFF",
    "4" => "MixPump1_Enabled",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 5){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//TDS2
$results = $db->query('SELECT *	FROM TDS2');
$column_to_session_value = array(
    "0" => "TDS2Value_Low",
    "1" => "TDS2Value_High",
    "2" => "NutePump2_ON",
    "3" => "NutePump2_OFF",
    "4" => "MixPump2_Enabled",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 5){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//**********************************************
//CO2
$results = $db->query('SELECT *	FROM CO2');
$column_to_session_value = array(
    "0" => "CO2Value_Low",
    "1" => "CO2Value_High",
    "2" => "CO2_ON",
    "3" => "CO2_OFF",
    "4" => "CO2_Enabled",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 5){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//********************************************
//Light
$results = $db->query('SELECT *	FROM LIGHT');
$column_to_session_value = array(
    "0" => "LightValue_Low",
    "1" => "LightValue_High",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 2){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//****************************************
//Water
$results = $db->query('SELECT *	FROM Water');
$column_to_session_value = array(
    "0" => "WaterValue_Low",
    "1" => "WaterValue_High",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 2){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//****************************************
//TankTotal
$results = $db->query('SELECT *	FROM TankTotal');
$column_to_session_value = array(
    "0" => "TankTotalValue_Low",
    "1" => "TankTotalValue_High",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 2){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//Tank1
$results = $db->query('SELECT *	FROM Tank1');
$column_to_session_value = array(
    "0" => "Tank1Value_Low",
    "1" => "Tank1Value_High",
    "2" => "Tank1Pump_ON",
    "3" => "Tank1Pump_OFF",
    "4" => "Tank1MixPump_Enabled",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 5){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//Tank2
$results = $db->query('SELECT *	FROM Tank2');
$column_to_session_value = array(
    "0" => "Tank2Value_Low",
    "1" => "Tank2Value_High",
    "2" => "Tank2Pump_ON",
    "3" => "Tank2Pump_OFF",
    "4" => "Tank2MixPump_Enabled",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 5){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//Tank3
$results = $db->query('SELECT *	FROM Tank3');
$column_to_session_value = array(
    "0" => "Tank3Value_Low",
    "1" => "Tank3Value_High",
    "2" => "Tank3Pump_ON",
    "3" => "Tank3Pump_OFF",
    "4" => "Tank3MixPump_Enabled",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 5){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//Tank4
$results = $db->query('SELECT *	FROM Tank4');
$column_to_session_value = array(
    "0" => "Tank4Value_Low",
    "1" => "Tank4Value_High",
    "2" => "Tank4Pump_ON",
    "3" => "Tank4Pump_OFF",
    "4" => "Tank4MixPump_Enabled",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 5){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//**WaterTempP1
$results = $db->query('SELECT *	FROM WaterTempP1');
$column_to_session_value = array(
    "0" => "WaterTempP1Value_Low",
    "1" => "WaterTempP1Value_High",
    "2" => "WaterTempP1Heater_ON",
    "3" => "WaterTempP1Heater_OFF",
    "4" => "WaterTempP1AC_ON",
    "5" => "WaterTempP1AC_OFF",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 6){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//**WaterTempP2
$results = $db->query('SELECT *	FROM WaterTempP2');
$column_to_session_value = array(
    "0" => "WaterTempP2Value_Low",
    "1" => "WaterTempP2Value_High",
    "2" => "WaterTempP2Heater_ON",
    "3" => "WaterTempP2Heater_OFF",
    "4" => "WaterTempP2AC_ON",
    "5" => "WaterTempP2AC_OFF",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 6){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//**WaterTempP3
$results = $db->query('SELECT *	FROM WaterTempP3');
$column_to_session_value = array(
    "0" => "WaterTempP3Value_Low",
    "1" => "WaterTempP3Value_High",
    "2" => "WaterTempP3Heater_ON",
    "3" => "WaterTempP3Heater_OFF",
    "4" => "WaterTempP3AC_ON",
    "5" => "WaterTempP3AC_OFF",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 6){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

//*******************************************
//**WaterTempP4
$results = $db->query('SELECT *	FROM WaterTempP4');
$column_to_session_value = array(
    "0" => "WaterTempP4Value_Low",
    "1" => "WaterTempP4Value_High",
    "2" => "WaterTempP4Heater_ON",
    "3" => "WaterTempP4Heater_OFF",
    "4" => "WaterTempP4AC_ON",
    "5" => "WaterTempP4AC_OFF",
);
while ($row = $results->fetchArray()) {
//	var_dump($row);
	
	$i=0;
	while($i < 6){
//	echo "<p></p>";
//	echo $column_to_session_value[$i];
//	echo ": ";
//	echo $row[$i];
	$_SESSION[$column_to_session_value[$i]] = $row[$i];
	$i=$i+1;
	}
}

$db->close();

?>
