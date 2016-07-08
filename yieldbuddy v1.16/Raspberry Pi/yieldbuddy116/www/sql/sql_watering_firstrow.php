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


//Pump_start_hour
$Pump_start_hour_query = "SELECT Pump_start_hour FROM Watering";
$Pump_start_hour_result = $mysqli->query($Pump_start_hour_query);     
if (!$Pump_start_hour_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Pump_start_hour_row = $Pump_start_hour_result->fetch_row();
$Pump_start_hour_row = implode(" ", $Pump_start_hour_row);
//echo $Pump_start_hour_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Pump_start_hour'] = $Pump_start_hour_row;
$Pump_start_hour_result->close();

//Pump_start_min
$Pump_start_min_query = "SELECT Pump_start_min FROM Watering";
$Pump_start_min_result = $mysqli->query($Pump_start_min_query);     
if (!$Pump_start_min_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Pump_start_min_row = $Pump_start_min_result->fetch_row();
$Pump_start_min_row = implode(" ", $Pump_start_min_row);
//echo $Pump_start_min_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Pump_start_min'] = $Pump_start_min_row;
$Pump_start_min_result->close();

//Pump_start_isAM
$Pump_start_isAM_query = "SELECT Pump_start_isAM FROM Watering";
$Pump_start_isAM_result = $mysqli->query($Pump_start_isAM_query);     
if (!$Pump_start_isAM_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Pump_start_isAM_row = $Pump_start_isAM_result->fetch_row();
$Pump_start_isAM_row = implode(" ", $Pump_start_isAM_row);
//echo $Pump_start_isAM_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Pump_start_isAM'] = $Pump_start_isAM_row;
$Pump_start_isAM_result->close();

//Pump_every_hours
$Pump_every_hours_query = "SELECT Pump_every_hours FROM Watering";
$Pump_every_hours_result = $mysqli->query($Pump_every_hours_query);     
if (!$Pump_every_hours_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Pump_every_hours_row = $Pump_every_hours_result->fetch_row();
$Pump_every_hours_row = implode(" ", $Pump_every_hours_row);
//echo $Pump_every_hours_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Pump_every_hours'] = $Pump_every_hours_row;
$Pump_every_hours_result->close();

//Pump_every_mins
$Pump_every_mins_query = "SELECT Pump_every_mins FROM Watering";
$Pump_every_mins_result = $mysqli->query($Pump_every_mins_query);     
if (!$Pump_every_mins_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Pump_every_mins_row = $Pump_every_mins_result->fetch_row();
$Pump_every_mins_row = implode(" ", $Pump_every_mins_row);
//echo $Pump_every_mins_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Pump_every_mins'] = $Pump_every_mins_row;
$Pump_every_mins_result->close();

//Pump_for
$Pump_for_query = "SELECT Pump_for FROM Watering";
$Pump_for_result = $mysqli->query($Pump_for_query);     
if (!$Pump_for_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Pump_for_row = $Pump_for_result->fetch_row();
$Pump_for_row = implode(" ", $Pump_for_row);
//echo $Pump_for_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Pump_for'] = $Pump_for_row;
$Pump_for_result->close();

//Pump_times
$Pump_times_query = "SELECT Pump_times FROM Watering";
$Pump_times_result = $mysqli->query($Pump_times_query);     
if (!$Pump_times_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Pump_times_row = $Pump_times_result->fetch_row();
$Pump_times_row = implode(" ", $Pump_times_row);
//echo $Pump_times_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Pump_times'] = $Pump_times_row;
$Pump_times_result->close();

$mysqli->close();

//record the ending time 
$end=microtime(); 
$end=explode(" ",$end); 
$end=$end[1]+$end[0]; 

//printf("<br></br>Query took %f seconds.",$end-$start);
?>
