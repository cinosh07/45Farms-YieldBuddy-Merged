<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
#
//Session_start();
//if(!file_exists('users/' . $_SESSION['username'] . '.xml')){
//	header('Location: index.php');
//	die;
//}

#$page = $_SERVER['PHP_SELF'];
#$sec = "2";
#header("Refresh: $sec; url=$page");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON"
       HREF="">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Renegade Garden Logger</title>
<meta http-equiv="refresh" content="180">
<style type="text/css">
body {
	background-image: url(img/background.png);
	margin-top: 0px;
	background-color: #000;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	color: #CCC;
	font-weight: bold;
	position: relative;
}
.description {
	font-size: 9px;
}
color.white {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFF;
	font-weight: bold;
	position: relative;
	font-size: 10px;
}
a:link {
	color: #999;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #999;
}
a:hover {
	text-decoration: underline;
	color: #999;
}
a:active {
	text-decoration: none;
	color: #999;
}
.CenterPageTitles {
	text-align: center;
}
.CenterPageTitles td {
	color: #FFF;
}
</style>
<style type="text/css">
	div.cssbox {
		font-family: Verdana, Geneva, sans-serif;
		border: 2px solid #000000 ;
		border-radius: 40px ;
		padding: 20px ;
		background-color: #FFFFFF ;
		color: #000 ;
		width: 90% ;
		margin-left: auto ;
		margin-right: auto ;
	}
</style>
</head>

<body>
<table width="1165" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><br />
   <img src="img/banner.png" width="280" height="52" />
    <color class="white">
    <?php
//    include $_SERVER['DOCUMENT_ROOT']. '/yieldbuddy/www/version.php';
    ?>
   </color>
    </td>
  </tr>
  <tr>
    <td height="20" align="left" valign="top">
    <table width="1165" border="0">
      <tr class="CenterPageTitles">

      <td width="104" height="34" align="left" valign="bottom"><a href="overview.php">Overview</a></td>
      <td width="150" valign="bottom"><a href="timers.php">Timers</a></td>
      <td width="155" valign="bottom">Graphs</td>
      <td width="193" valign="bottom"><a href="setpoints.php">Set Points</a></td>
      <td width="163" valign="bottom"><a href="alarms.php">Alarms</a></td>
      <td width="150" valign="bottom"><a href="system.php">System</a></td>
      <td width="99" align="right" valign="bottom"><a href="logout.php">Log Out</a></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td height="10" valign="top">            <div align="center">
            <h6>Note: Refresh the page to update the graphs with new datapoints.</h6></div></td>
  </tr>
  <tr>
    <td height="77" width="1170" valign="top"><div class="cssbox"><p>
      <?php
//session_start();

$db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/greenhouse/greenhouse_main.db');
$db->busyTimeout(2000);
$results = $db->query('SELECT timestamp,temp0,echo0,echo1,echo2,total_water,tempDHT,humidityDHT,echo3 FROM readings');

$rownum=0;
while ($row = $results->fetchArray()) {
	$Time_array[$rownum] = $row[0];
   	$temp0_array[$rownum] = $row[1];
	$echo0_array[$rownum] = $row[2];
	$echo1_array[$rownum] = $row[3];
	$echo2_array[$rownum] = $row[4];
	$twater_array[$rownum] = $row[5];
	$tempDHT_array[$rownum] = $row[6];
	$humDHT_array[$rownum] = $row[7];
	$echo3_array[$rownum] = $row[8];
	#echo $Time_array[$rownum];
	$dates = explode("-",$Time_array[$rownum]);
	#echo "</br>";
	$parsed_year[$rownum] = $dates[0];
	#echo $parsed_year[$rownum];
	#echo "</br>";
	$parsed_month[$rownum] = $dates[1];
	#echo $parsed_month[$rownum];
	#echo "</br>";
	#echo $dates[2];
	$dates_split = explode(" ",$dates[2]);
	$parsed_day[$rownum] = $dates_split[0];
	#echo $parsed_day[$rownum];
	#echo "</br>";
	#echo $dates_split[1];
	$times_split = explode(":",$dates_split[1]);
	$parsed_hour[$rownum] = $times_split[0];
	$parsed_min[$rownum] = $times_split[1];
	$parsed_sec[$rownum] = $times_split[2];
	#echo "</br>";
	#echo $parsed_hour[$rownum];
	#echo "</br>";
	#echo $parsed_min[$rownum];
	#echo "</br>";
	#echo $parsed_sec[$rownum];
	#echo "</br>";
	$rownum = $rownum + 1;
}

$db->close();

?>


<!--
You are free to copy and use this sample in accordance with the terms of the
Apache license (http://www.apache.org/licenses/LICENSE-2.0.html)
-->

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {packages: ['annotatedtimeline']});
function drawVisualization() {
  var data = new google.visualization.DataTable();
  data.addColumn('datetime', 'Date');
  data.addColumn('number', 'Inside');
  data.addColumn('number', 'Outside');
  data.addColumn('number', 'Outside Humidity');
<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $temp0_array[$rownum] . "," . $tempDHT_array[$rownum] . "," . $humDHT_array[$rownum] . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $temp0_array[$rownum] . "," . $tempDHT_array[$rownum] . "," . $humDHT_array[$rownum] . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>
  var options = {
	  title: "Test",thickness: 2,fill: 10,displayAnnotations: true
  };

  var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
	  document.getElementById('pH_Chart'));
  annotatedtimeline.draw(data, options);
}

google.setOnLoadCallback(drawVisualization);
</script>
<script type="text/javascript">
google.load('visualization', '1', {packages: ['annotatedtimeline']});
function drawVisualization() {
  var data = new google.visualization.DataTable();
  data.addColumn('datetime', 'Date');
  data.addColumn('number', 'Total H20');
<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $twater_array[$rownum] . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $twater_array[$rownum] . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
?>
  var options = {
	  title: "Test",thickness: 2,fill: 10
  };

  var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
	  document.getElementById('Temperature_Chart'));
  annotatedtimeline.draw(data, options);
}

google.setOnLoadCallback(drawVisualization);
</script>

<script type="text/javascript">
google.load('visualization', '1', {packages: ['annotatedtimeline']});
function drawVisualization() {
  var data = new google.visualization.DataTable();
  data.addColumn('datetime', 'Date');
  data.addColumn('number', 'Tank RB1');
  data.addColumn('number', 'Tank RB2');
  data.addColumn('number', 'Tank RB3');
  data.addColumn('number', 'Tank RB4');
 // data.addColumn('number', 'Total Water (L)');
	<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $echo0_array[$rownum] . "," . $echo1_array[$rownum] . "," . $echo2_array[$rownum] . "," . $echo3_array[$rownum] . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $echo0_array[$rownum] . "," . $echo1_array[$rownum] . "," . $echo2_array[$rownum] . "," . $echo3_array[$rownum] . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>
  var options = {
	  title: "Test",thickness: 2,fill: 10
  };

  var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
	  document.getElementById('TDS_Chart'));
  annotatedtimeline.draw(data, options);
}

google.setOnLoadCallback(drawVisualization);
</script>

<script type="text/javascript">
google.load('visualization', '1', {packages: ['annotatedtimeline']});
function drawVisualization() {
  var data = new google.visualization.DataTable();
  data.addColumn('datetime', 'Date');
  data.addColumn('number', 'Outside Humidity');
  data.addColumn('number', 'Outside Temp');
  //data.addColumn('number', 'Total Water (L)');
	<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $humDHT_array[$rownum] . "," . $tempDHT_array[$rownum] . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $humDHT_array[$rownum] . "," . $tempDHT_array[$rownum] . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>
  var options = {

	  title: "Test",thickness: 2,fill: 10
  };

  var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
	  document.getElementById('Percentage_Chart'));
  annotatedtimeline.draw(data, options);
}
google.setOnLoadCallback(drawVisualization);
</script>
All Temp/Humidity:
<div id="pH_Chart" style="width: 1050px; height: 500px;"></div>
</br>
</br>
Litres of Water All Tanks:
</br>
</br>
<div id="Temperature_Chart" style="width: 1050px; height: 500px;"></div>
</br>
</br>
Water Tank Logs:
</br>
</br>
<div id="TDS_Chart" style="width: 1050px; height: 500px;"></div>
</br>
</br>
Outside Temp/Humidity:
</br>
</br>
<div id="Percentage_Chart" style="width: 1050px; height: 500px;"></div>
</td>
</body>
</html>
​
