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


//Light_ON_hour
$Light_ON_hour_query = "SELECT Light_ON_hour FROM Lighting";
$Light_ON_hour_result = $mysqli->query($Light_ON_hour_query);     
if (!$Light_ON_hour_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_ON_hour_row = $Light_ON_hour_result->fetch_row();
$Light_ON_hour_row = implode(" ", $Light_ON_hour_row);
//echo $Light_ON_hour_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_ON_hour'] = $Light_ON_hour_row;
$Light_ON_hour_result->close();

//Light_ON_min
$Light_ON_min_query = "SELECT Light_ON_min FROM Lighting";
$Light_ON_min_result = $mysqli->query($Light_ON_min_query);     
if (!$Light_ON_min_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_ON_min_row = $Light_ON_min_result->fetch_row();
$Light_ON_min_row = implode(" ", $Light_ON_min_row);
//echo $Light_ON_min_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_ON_min'] = $Light_ON_min_row;
$Light_ON_min_result->close();

//Light_OFF_hour
$Light_OFF_hour_query = "SELECT Light_OFF_hour FROM Lighting";
$Light_OFF_hour_result = $mysqli->query($Light_OFF_hour_query);     
if (!$Light_OFF_hour_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_OFF_hour_row = $Light_OFF_hour_result->fetch_row();
$Light_OFF_hour_row = implode(" ", $Light_OFF_hour_row);
//echo $Light_OFF_hour_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_OFF_hour'] = $Light_OFF_hour_row;
$Light_OFF_hour_result->close();

//Light_OFF_min
$Light_OFF_min_query = "SELECT Light_OFF_min FROM Lighting";
$Light_OFF_min_result = $mysqli->query($Light_OFF_min_query);     
if (!$Light_OFF_min_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_OFF_min_row = $Light_OFF_min_result->fetch_row();
$Light_OFF_min_row = implode(" ", $Light_OFF_min_row);
//echo $Light_OFF_min_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_OFF_min'] = $Light_OFF_min_row;
$Light_OFF_min_result->close();

//LightValue_Low
$LightValue_Low_query = "SELECT Low FROM Lighting";
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

//LightValue_High
$LightValue_High_query = "SELECT High FROM Lighting";
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
