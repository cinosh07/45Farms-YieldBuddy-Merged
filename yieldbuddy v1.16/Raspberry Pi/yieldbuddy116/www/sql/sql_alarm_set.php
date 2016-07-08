<?php
session_start();

$sensorname=$_GET["sensorname"];
$alarmname=$_GET["alarmname"];
$alarmvalue=$_GET["alarmvalue"];

alarm_sql($sensorname,$alarmname,$alarmvalue);

function alarm_sql($sensorname,$alarmname,$alarmvalue) {
	//Load SQL settings
	$sql_address=trim($_SESSION['sql_address']);
	$sql_username=trim($_SESSION['sql_username']);
	$sql_password=trim($_SESSION['sql_password']);
	$sql_database=trim($_SESSION['sql_database']);
	
	$mysqli = new mysqli($sql_address, $sql_username, $sql_password, $sql_database, 3306);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$alarmsql_query = "UPDATE `" . $sensorname . "` SET `" . $alarmname . "` = " . $alarmvalue;
	$alarmsql_result = $mysqli->query($alarmsql_query);     
	if (!$alarmsql_result) {
	  printf("Query: " + $alarmsql_query + " ");
	  printf("Query failed: %s\n", $mysqli->error);
	  exit;
	}

}
?>
