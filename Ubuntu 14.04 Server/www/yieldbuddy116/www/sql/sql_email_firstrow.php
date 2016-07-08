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


//smtp_server
$smtp_server_query = "SELECT smtp_server FROM Email";
$smtp_server_result = $mysqli->query($smtp_server_query);     
if (!$smtp_server_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$smtp_server_row = $smtp_server_result->fetch_row();
$smtp_server_row = implode(" ", $smtp_server_row);
//echo $smtp_server_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['smtp_server'] = $smtp_server_row;
$smtp_server_result->close();

//smtp_port
$smtp_port_query = "SELECT smtp_port FROM Email";
$smtp_port_result = $mysqli->query($smtp_port_query);     
if (!$smtp_port_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$smtp_port_row = $smtp_port_result->fetch_row();
$smtp_port_row = implode(" ", $smtp_port_row);
//echo $smtp_port_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['smtp_port'] = $smtp_port_row;
$smtp_port_result->close();

//login_email_address
$login_email_address_query = "SELECT login_email_address FROM Email";
$login_email_address_result = $mysqli->query($login_email_address_query);     
if (!$login_email_address_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$login_email_address_row = $login_email_address_result->fetch_row();
$login_email_address_row = implode(" ", $login_email_address_row);
//echo $login_email_address_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['login_email_address'] = $login_email_address_row;
$login_email_address_result->close();


//password_hash
$password_hash_query = "SELECT password_hash FROM Email";
$password_hash_result = $mysqli->query($password_hash_query);     
if (!$password_hash_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$password_hash_row = $password_hash_result->fetch_row();
$password_hash_row = implode(" ", $password_hash_row);
//echo $password_hash_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['email_password_hash'] = $password_hash_row;
$password_hash_result->close();


//recipient
$recipient_query = "SELECT recipient FROM Email";
$recipient_result = $mysqli->query($recipient_query);     
if (!$recipient_result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}

$recipient_row = $recipient_result->fetch_row();
$recipient_row = implode(" ", $recipient_row);
//echo $recipient_row;
//echo "&nbsp;&nbsp;&nbsp;";
$_SESSION['recipient'] = $recipient_row;
$recipient_result->close();


$mysqli->close();

//record the ending time 
$end=microtime(); 
$end=explode(" ",$end); 
$end=$end[1]+$end[0]; 

//printf("<br></br>Query took %f seconds.",$end-$start);
?>
