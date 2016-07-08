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


//pH1_Low_Alarm
$pH1_Low_query = "SELECT Low_Alarm FROM pH1";
$pH1_Low_result = $mysqli->query($pH1_Low_query);     
if (!$pH1_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH1_Low_row = $pH1_Low_result->fetch_row();
$pH1_Low_row = implode(" ", $pH1_Low_row);
//echo $pH1_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH1_Low_Alarm'] = $pH1_Low_row;
$pH1_Low_result->close();

//pH1_Low_Time
$pH1_Low_query = "SELECT Low_Time FROM pH1";
$pH1_Low_result = $mysqli->query($pH1_Low_query);     
if (!$pH1_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH1_Low_row = $pH1_Low_result->fetch_row();
$pH1_Low_row = implode(" ", $pH1_Low_row);
//echo $pH1_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH1_Low_Time'] = $pH1_Low_row;
$pH1_Low_result->close();

//pH1_High_Alarm
$pH1_High_query = "SELECT High_Alarm FROM pH1";
$pH1_High_result = $mysqli->query($pH1_High_query);     
if (!$pH1_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH1_High_row = $pH1_High_result->fetch_row();
$pH1_High_row = implode(" ", $pH1_High_row);
//echo $pH1_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH1_High_Alarm'] = $pH1_High_row;
$pH1_High_result->close();

//pH1_High_Time
$pH1_High_query = "SELECT High_Time FROM pH1";
$pH1_High_result = $mysqli->query($pH1_High_query);     
if (!$pH1_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH1_High_row = $pH1_High_result->fetch_row();
$pH1_High_row = implode(" ", $pH1_High_row);
//echo $pH1_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH1_High_Time'] = $pH1_High_row;
$pH1_High_result->close();



//pH2_Low_Alarm
$pH2_Low_query = "SELECT Low_Alarm FROM pH2";
$pH2_Low_result = $mysqli->query($pH2_Low_query);     
if (!$pH2_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH2_Low_row = $pH2_Low_result->fetch_row();
$pH2_Low_row = implode(" ", $pH2_Low_row);
//echo $pH2_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH2_Low_Alarm'] = $pH2_Low_row;
$pH2_Low_result->close();

//pH2_Low_Time
$pH2_Low_query = "SELECT Low_Time FROM pH2";
$pH2_Low_result = $mysqli->query($pH2_Low_query);     
if (!$pH2_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH2_Low_row = $pH2_Low_result->fetch_row();
$pH2_Low_row = implode(" ", $pH2_Low_row);
//echo $pH2_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH2_Low_Time'] = $pH2_Low_row;
$pH2_Low_result->close();

//pH2_High_Alarm
$pH2_High_query = "SELECT High_Alarm FROM pH2";
$pH2_High_result = $mysqli->query($pH2_High_query);     
if (!$pH2_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH2_High_row = $pH2_High_result->fetch_row();
$pH2_High_row = implode(" ", $pH2_High_row);
//echo $pH2_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH2_High_Alarm'] = $pH2_High_row;
$pH2_High_result->close();

//pH2_High_Time
$pH2_High_query = "SELECT High_Time FROM pH2";
$pH2_High_result = $mysqli->query($pH2_High_query);     
if (!$pH2_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$pH2_High_row = $pH2_High_result->fetch_row();
$pH2_High_row = implode(" ", $pH2_High_row);
//echo $pH2_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['pH2_High_Time'] = $pH2_High_row;
$pH2_High_result->close();



//Temp_Low_Alarm
$Temp_Low_query = "SELECT Low_Alarm FROM Temp";
$Temp_Low_result = $mysqli->query($Temp_Low_query);     
if (!$Temp_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Temp_Low_row = $Temp_Low_result->fetch_row();
$Temp_Low_row = implode(" ", $Temp_Low_row);
//echo $Temp_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Temp_Low_Alarm'] = $Temp_Low_row;
$Temp_Low_result->close();

//Temp_Low_Time
$Temp_Low_query = "SELECT Low_Time FROM Temp";
$Temp_Low_result = $mysqli->query($Temp_Low_query);     
if (!$Temp_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Temp_Low_row = $Temp_Low_result->fetch_row();
$Temp_Low_row = implode(" ", $Temp_Low_row);
//echo $Temp_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Temp_Low_Time'] = $Temp_Low_row;
$Temp_Low_result->close();

//Temp_High_Alarm
$Temp_High_query = "SELECT High_Alarm FROM Temp";
$Temp_High_result = $mysqli->query($Temp_High_query);     
if (!$Temp_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Temp_High_row = $Temp_High_result->fetch_row();
$Temp_High_row = implode(" ", $Temp_High_row);
//echo $Temp_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Temp_High_Alarm'] = $Temp_High_row;
$Temp_High_result->close();

//Temp_High_Time
$Temp_High_query = "SELECT High_Time FROM Temp";
$Temp_High_result = $mysqli->query($Temp_High_query);     
if (!$Temp_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Temp_High_row = $Temp_High_result->fetch_row();
$Temp_High_row = implode(" ", $Temp_High_row);
//echo $Temp_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Temp_High_Time'] = $Temp_High_row;
$Temp_High_result->close();



//RH_Low_Alarm
$RH_Low_query = "SELECT Low_Alarm FROM RH";
$RH_Low_result = $mysqli->query($RH_Low_query);     
if (!$RH_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$RH_Low_row = $RH_Low_result->fetch_row();
$RH_Low_row = implode(" ", $RH_Low_row);
//echo $RH_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['RH_Low_Alarm'] = $RH_Low_row;
$RH_Low_result->close();

//RH_Low_Time
$RH_Low_query = "SELECT Low_Time FROM RH";
$RH_Low_result = $mysqli->query($RH_Low_query);     
if (!$RH_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$RH_Low_row = $RH_Low_result->fetch_row();
$RH_Low_row = implode(" ", $RH_Low_row);
//echo $RH_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['RH_Low_Time'] = $RH_Low_row;
$RH_Low_result->close();

//RH_High_Alarm
$RH_High_query = "SELECT High_Alarm FROM RH";
$RH_High_result = $mysqli->query($RH_High_query);     
if (!$RH_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$RH_High_row = $RH_High_result->fetch_row();
$RH_High_row = implode(" ", $RH_High_row);
//echo $RH_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['RH_High_Alarm'] = $RH_High_row;
$RH_High_result->close();

//RH_High_Time
$RH_High_query = "SELECT High_Time FROM RH";
$RH_High_result = $mysqli->query($RH_High_query);     
if (!$RH_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$RH_High_row = $RH_High_result->fetch_row();
$RH_High_row = implode(" ", $RH_High_row);
//echo $RH_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['RH_High_Time'] = $RH_High_row;
$RH_High_result->close();



//TDS1_Low_Alarm
$TDS1_Low_query = "SELECT Low_Alarm FROM TDS1";
$TDS1_Low_result = $mysqli->query($TDS1_Low_query);     
if (!$TDS1_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS1_Low_row = $TDS1_Low_result->fetch_row();
$TDS1_Low_row = implode(" ", $TDS1_Low_row);
//echo $TDS1_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS1_Low_Alarm'] = $TDS1_Low_row;
$TDS1_Low_result->close();

//TDS1_Low_Time
$TDS1_Low_query = "SELECT Low_Time FROM TDS1";
$TDS1_Low_result = $mysqli->query($TDS1_Low_query);     
if (!$TDS1_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS1_Low_row = $TDS1_Low_result->fetch_row();
$TDS1_Low_row = implode(" ", $TDS1_Low_row);
//echo $TDS1_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS1_Low_Time'] = $TDS1_Low_row;
$TDS1_Low_result->close();

//TDS1_High_Alarm
$TDS1_High_query = "SELECT High_Alarm FROM TDS1";
$TDS1_High_result = $mysqli->query($TDS1_High_query);     
if (!$TDS1_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS1_High_row = $TDS1_High_result->fetch_row();
$TDS1_High_row = implode(" ", $TDS1_High_row);
//echo $TDS1_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS1_High_Alarm'] = $TDS1_High_row;
$TDS1_High_result->close();

//TDS1_High_Time
$TDS1_High_query = "SELECT High_Time FROM TDS1";
$TDS1_High_result = $mysqli->query($TDS1_High_query);     
if (!$TDS1_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS1_High_row = $TDS1_High_result->fetch_row();
$TDS1_High_row = implode(" ", $TDS1_High_row);
//echo $TDS1_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS1_High_Time'] = $TDS1_High_row;
$TDS1_High_result->close();



//TDS2_Low_Alarm
$TDS2_Low_query = "SELECT Low_Alarm FROM TDS2";
$TDS2_Low_result = $mysqli->query($TDS2_Low_query);     
if (!$TDS2_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS2_Low_row = $TDS2_Low_result->fetch_row();
$TDS2_Low_row = implode(" ", $TDS2_Low_row);
//echo $TDS2_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS2_Low_Alarm'] = $TDS2_Low_row;
$TDS2_Low_result->close();

//TDS2_Low_Time
$TDS2_Low_query = "SELECT Low_Time FROM TDS2";
$TDS2_Low_result = $mysqli->query($TDS2_Low_query);     
if (!$TDS2_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS2_Low_row = $TDS2_Low_result->fetch_row();
$TDS2_Low_row = implode(" ", $TDS2_Low_row);
//echo $TDS2_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS2_Low_Time'] = $TDS2_Low_row;
$TDS2_Low_result->close();

//TDS2_High_Alarm
$TDS2_High_query = "SELECT High_Alarm FROM TDS2";
$TDS2_High_result = $mysqli->query($TDS2_High_query);     
if (!$TDS2_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS2_High_row = $TDS2_High_result->fetch_row();
$TDS2_High_row = implode(" ", $TDS2_High_row);
//echo $TDS2_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS2_High_Alarm'] = $TDS2_High_row;
$TDS2_High_result->close();

//TDS2_High_Time
$TDS2_High_query = "SELECT High_Time FROM TDS2";
$TDS2_High_result = $mysqli->query($TDS2_High_query);     
if (!$TDS2_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$TDS2_High_row = $TDS2_High_result->fetch_row();
$TDS2_High_row = implode(" ", $TDS2_High_row);
//echo $TDS2_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['TDS2_High_Time'] = $TDS2_High_row;
$TDS2_High_result->close();



//CO2_Low_Alarm
$CO2_Low_query = "SELECT Low_Alarm FROM CO2";
$CO2_Low_result = $mysqli->query($CO2_Low_query);     
if (!$CO2_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$CO2_Low_row = $CO2_Low_result->fetch_row();
$CO2_Low_row = implode(" ", $CO2_Low_row);
//echo $CO2_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['CO2_Low_Alarm'] = $CO2_Low_row;
$CO2_Low_result->close();

//CO2_Low_Time
$CO2_Low_query = "SELECT Low_Time FROM CO2";
$CO2_Low_result = $mysqli->query($CO2_Low_query);     
if (!$CO2_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$CO2_Low_row = $CO2_Low_result->fetch_row();
$CO2_Low_row = implode(" ", $CO2_Low_row);
//echo $CO2_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['CO2_Low_Time'] = $CO2_Low_row;
$CO2_Low_result->close();

//CO2_High_Alarm
$CO2_High_query = "SELECT High_Alarm FROM CO2";
$CO2_High_result = $mysqli->query($CO2_High_query);     
if (!$CO2_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$CO2_High_row = $CO2_High_result->fetch_row();
$CO2_High_row = implode(" ", $CO2_High_row);
//echo $CO2_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['CO2_High_Alarm'] = $CO2_High_row;
$CO2_High_result->close();

//CO2_High_Time
$CO2_High_query = "SELECT High_Time FROM CO2";
$CO2_High_result = $mysqli->query($CO2_High_query);     
if (!$CO2_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$CO2_High_row = $CO2_High_result->fetch_row();
$CO2_High_row = implode(" ", $CO2_High_row);
//echo $CO2_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['CO2_High_Time'] = $CO2_High_row;
$CO2_High_result->close();



//Light_Low_Alarm
$Light_Low_query = "SELECT Low_Alarm FROM Light";
$Light_Low_result = $mysqli->query($Light_Low_query);     
if (!$Light_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_Low_row = $Light_Low_result->fetch_row();
$Light_Low_row = implode(" ", $Light_Low_row);
//echo $Light_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_Low_Alarm'] = $Light_Low_row;
$Light_Low_result->close();

//Light_Low_Time
$Light_Low_query = "SELECT Low_Time FROM Light";
$Light_Low_result = $mysqli->query($Light_Low_query);     
if (!$Light_Low_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_Low_row = $Light_Low_result->fetch_row();
$Light_Low_row = implode(" ", $Light_Low_row);
//echo $Light_Low_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_Low_Time'] = $Light_Low_row;
$Light_Low_result->close();

//Light_High_Alarm
$Light_High_query = "SELECT High_Alarm FROM Light";
$Light_High_result = $mysqli->query($Light_High_query);     
if (!$Light_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_High_row = $Light_High_result->fetch_row();
$Light_High_row = implode(" ", $Light_High_row);
//echo $Light_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_High_Alarm'] = $Light_High_row;
$Light_High_result->close();

//Light_High_Time
$Light_High_query = "SELECT High_Time FROM Light";
$Light_High_result = $mysqli->query($Light_High_query);     
if (!$Light_High_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$Light_High_row = $Light_High_result->fetch_row();
$Light_High_row = implode(" ", $Light_High_row);
//echo $Light_High_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['Light_High_Time'] = $Light_High_row;
$Light_High_result->close();




$mysqli->close();

//record the ending time 
$end=microtime(); 
$end=explode(" ",$end); 
$end=$end[1]+$end[0]; 

//printf("<br></br>Query took %f seconds.",$end-$start);
?>
