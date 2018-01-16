<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include($_SERVER['DOCUMENT_ROOT'] . '/yieldbuddy2/www/sql/new_SQLite3.php');
$db->busyTimeout(2000);
//$results = $db->query('SELECT *	FROM Sensors_Log');
$results = $db->query('SELECT *	FROM Sensors');
$column_to_session_value = array(
    "0" => "Sensors_Time",
    "1" => "Sensors_pH1",
    "2" => "Sensors_pH2",
    "3" => "Sensors_Temp",
    "4" => "Sensors_RH",
    "5" => "Sensors_TDS1",
    "6" => "Sensors_TDS2",
    "7" => "Sensors_CO2",
    "8" => "Sensors_Light",
    "9" => "Sensors_Water",
    "10" => "Sensors_MagX",
    "11" => "Sensors_MagY",
    "12" => "Sensors_MagZ",
    "13" => "Sensors_TankTotal",
    "14" => "Sensors_Tank1",
    "15" => "Sensors_Tank2",
    "16" => "Sensors_Tank3",
    "17" => "Sensors_Tank4",   
    "18" => "Sensors_WaterTempP1",
    "19" => "Sensors_WaterTempP2",
    "20" => "Sensors_WaterTempP3",
    "21" => "Sensors_WaterTempP4",
);

while ($row = $results->fetchArray()) {
//	var_dump($row);

    $i = 0;
    while ($i < 22) {
//	echo "<p></p>";
//	echo '\'';
//	echo $column_to_session_value[$i];
//	echo '\'';
//	echo ": ";
//	echo $row[$i];
        $session_string = $column_to_session_value[$i];
//	echo "   Session String: ";
//	echo $session_string;
        $_SESSION[$session_string] = $row[$i];
        $i = $i + 1;
    }
}

//echo $_SESSION['Sensors_pH1'];
$db->close();
?>
