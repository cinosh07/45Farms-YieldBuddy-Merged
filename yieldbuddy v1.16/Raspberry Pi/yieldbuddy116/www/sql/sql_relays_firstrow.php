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


//Relay1
$Relay1_query = "SELECT Relay1 FROM Relays";
$Relay1_result = $mysqli->query($Relay1_query);     
if (!$Relay1_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay1_row = $Relay1_result->fetch_row();
$Relay1_row = implode(" ", $Relay1_row);
//echo $Relay1_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay1'] = $Relay1_row;
$Relay1_result->close();

//Relay1_isAuto
$Relay1_isAuto_query = "SELECT Relay1_isAuto FROM Relays";
$Relay1_isAuto_result = $mysqli->query($Relay1_isAuto_query);     
if (!$Relay1_isAuto_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay1_isAuto_row = $Relay1_isAuto_result->fetch_row();
$Relay1_isAuto_row = implode(" ", $Relay1_isAuto_row);
//echo $Relay1_isAuto_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay1_isAuto'] = $Relay1_isAuto_row;
$Relay1_isAuto_result->close();

//Relay2
$Relay2_query = "SELECT Relay2 FROM Relays";
$Relay2_result = $mysqli->query($Relay2_query);     
if (!$Relay2_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay2_row = $Relay2_result->fetch_row();
$Relay2_row = implode(" ", $Relay2_row);
//echo $Relay2_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay2'] = $Relay2_row;
$Relay2_result->close();

//Relay2_isAuto
$Relay2_isAuto_query = "SELECT Relay2_isAuto FROM Relays";
$Relay2_isAuto_result = $mysqli->query($Relay2_isAuto_query);     
if (!$Relay2_isAuto_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay2_isAuto_row = $Relay2_isAuto_result->fetch_row();
$Relay2_isAuto_row = implode(" ", $Relay2_isAuto_row);
//echo $Relay2_isAuto_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay2_isAuto'] = $Relay2_isAuto_row;
$Relay2_isAuto_result->close();

//Relay3
$Relay3_query = "SELECT Relay3 FROM Relays";
$Relay3_result = $mysqli->query($Relay3_query);     
if (!$Relay3_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay3_row = $Relay3_result->fetch_row();
$Relay3_row = implode(" ", $Relay3_row);
//echo $Relay3_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay3'] = $Relay3_row;
$Relay3_result->close();

//Relay3_isAuto
$Relay3_isAuto_query = "SELECT Relay3_isAuto FROM Relays";
$Relay3_isAuto_result = $mysqli->query($Relay3_isAuto_query);     
if (!$Relay3_isAuto_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay3_isAuto_row = $Relay3_isAuto_result->fetch_row();
$Relay3_isAuto_row = implode(" ", $Relay3_isAuto_row);
//echo $Relay3_isAuto_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay3_isAuto'] = $Relay3_isAuto_row;
$Relay3_isAuto_result->close();

//Relay4
$Relay4_query = "SELECT Relay4 FROM Relays";
$Relay4_result = $mysqli->query($Relay4_query);     
if (!$Relay4_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay4_row = $Relay4_result->fetch_row();
$Relay4_row = implode(" ", $Relay4_row);
//echo $Relay4_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay4'] = $Relay4_row;
$Relay4_result->close();

//Relay4_isAuto
$Relay4_isAuto_query = "SELECT Relay4_isAuto FROM Relays";
$Relay4_isAuto_result = $mysqli->query($Relay4_isAuto_query);     
if (!$Relay4_isAuto_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay4_isAuto_row = $Relay4_isAuto_result->fetch_row();
$Relay4_isAuto_row = implode(" ", $Relay4_isAuto_row);
//echo $Relay4_isAuto_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay4_isAuto'] = $Relay4_isAuto_row;
$Relay4_isAuto_result->close();

//Relay5
$Relay5_query = "SELECT Relay5 FROM Relays";
$Relay5_result = $mysqli->query($Relay5_query);     
if (!$Relay5_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay5_row = $Relay5_result->fetch_row();
$Relay5_row = implode(" ", $Relay5_row);
//echo $Relay5_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay5'] = $Relay5_row;
$Relay5_result->close();

//Relay5_isAuto
$Relay5_isAuto_query = "SELECT Relay5_isAuto FROM Relays";
$Relay5_isAuto_result = $mysqli->query($Relay5_isAuto_query);     
if (!$Relay5_isAuto_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay5_isAuto_row = $Relay5_isAuto_result->fetch_row();
$Relay5_isAuto_row = implode(" ", $Relay5_isAuto_row);
//echo $Relay5_isAuto_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay5_isAuto'] = $Relay5_isAuto_row;
$Relay5_isAuto_result->close();

//Relay6
$Relay6_query = "SELECT Relay6 FROM Relays";
$Relay6_result = $mysqli->query($Relay6_query);     
if (!$Relay6_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay6_row = $Relay6_result->fetch_row();
$Relay6_row = implode(" ", $Relay6_row);
//echo $Relay6_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay6'] = $Relay6_row;
$Relay6_result->close();

//Relay6_isAuto
$Relay6_isAuto_query = "SELECT Relay6_isAuto FROM Relays";
$Relay6_isAuto_result = $mysqli->query($Relay6_isAuto_query);     
if (!$Relay6_isAuto_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Relay6_isAuto_row = $Relay6_isAuto_result->fetch_row();
$Relay6_isAuto_row = implode(" ", $Relay6_isAuto_row);
//echo $Relay6_isAuto_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Relay6_isAuto'] = $Relay6_isAuto_row;
$Relay6_isAuto_result->close();

$mysqli->close();

//record the ending time 
$end=microtime(); 
$end=explode(" ",$end); 
$end=$end[1]+$end[0]; 

//printf("<br></br>Query took %f seconds.",$end-$start);
?>
