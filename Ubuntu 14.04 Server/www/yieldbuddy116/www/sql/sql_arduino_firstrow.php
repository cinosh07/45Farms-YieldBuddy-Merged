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


//Time
$Time_query = "SELECT Time FROM Arduino";
$Time_result = $mysqli->query($Time_query);     
if (!$Time_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Time_row = $Time_result->fetch_row();
$Time_row = implode(" ", $Time_row);
//echo $Time_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Arduino_Time'] = $Time_row;
$Time_result->close();

//Month
$Month_query = "SELECT Month FROM Arduino";
$Month_result = $mysqli->query($Month_query);     
if (!$Month_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Month_row = $Month_result->fetch_row();
$Month_row = implode(" ", $Month_row);
//echo $Month_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Arduino_month'] = $Month_row;
$Month_result->close();

//Day
$Day_query = "SELECT Day FROM Arduino";
$Day_result = $mysqli->query($Day_query);     
if (!$Day_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Day_row = $Day_result->fetch_row();
$Day_row = implode(" ", $Day_row);
//echo $Day_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Arduino_day'] = $Day_row;
$Day_result->close();


//Year
$Year_query = "SELECT Year FROM Arduino";
$Year_result = $mysqli->query($Year_query);     
if (!$Year_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Year_row = $Year_result->fetch_row();
$Year_row = implode(" ", $Year_row);
//echo $Year_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Arduino_year'] = $Year_row;
$Year_result->close();


//Hour
$Hour_query = "SELECT Hour FROM Arduino";
$Hour_result = $mysqli->query($Hour_query);     
if (!$Hour_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Hour_row = $Hour_result->fetch_row();
$Hour_row = implode(" ", $Hour_row);
//echo $Hour_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Arduino_hour'] = $Hour_row;
$Hour_result->close();


//Minute
$Minute_query = "SELECT Minute FROM Arduino";
$Minute_result = $mysqli->query($Minute_query);     
if (!$Minute_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Minute_row = $Minute_result->fetch_row();
$Minute_row = implode(" ", $Minute_row);
//echo $Minute_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Arduino_min'] = $Minute_row;
$Minute_result->close();


//Second
$Second_query = "SELECT Second FROM Arduino";
$Second_result = $mysqli->query($Second_query);     
if (!$Second_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Second_row = $Second_result->fetch_row();
$Second_row = implode(" ", $Second_row);
//echo $Second_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Arduino_sec'] = $Second_row;
$Second_result->close();


$mysqli->close();

//record the ending time 
$end=microtime(); 
$end=explode(" ",$end); 
$end=$end[1]+$end[0]; 

//printf("<br></br>Query took %f seconds.",$end-$start);
?>
