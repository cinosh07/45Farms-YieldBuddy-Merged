<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!file_exists('users/' . $_SESSION['username'] . '.xml')){
	header('Location: index.php');
	die;
}

#$page = $_SERVER['PHP_SELF'];
#$sec = "2";
#header("Refresh: $sec; url=$page");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON"
       HREF="/yieldbuddy/www/img/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>yieldbuddy</title>
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
	font-size: 14px;
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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>


</head>

<body>
<table width="1165" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><br />
    <img src="img/banner.png" width="280" height="52" />
    <color class="white">
    <?php
    include $_SERVER['DOCUMENT_ROOT']. '/yieldbuddy/www/version.php';
    ?>
    </color>
    </td>
  </tr>
  <tr>
    <td height="20" align="left" valign="top">
    
    <table width="900" border="0" align="center">
      <tr class="CenterPageTitles">
        <td width="104" height="34" align="left" valign="bottom"><a href="overview.php">Overview</a></td>
        <td width="150" valign="bottom"><a href="timers.php">Timers</a></td>
        <td width="155" valign="bottom"><a href="graphs.php">Graphs</a></td>				
        <td width="155" valign="bottom"><a href="graphs_2.php">Graphs2</a></td>
        <td width="155" valign="bottom">Graphs3</td>							
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
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/yieldbuddy.sqlite3');
$db->busyTimeout(2000);
#$results = $db->query('SELECT *	FROM Sensors_Log');
$results = $db->query("SELECT *	FROM Sensors_Log WHERE Time >= datetime('now','-14 days')");
$rownum=0;
while ($row = $results->fetchArray()) {
	
	$Time_array[$rownum] = $row[0];
  $pH1_array[$rownum] = $row[1];
	$pH2_array[$rownum] = $row[2];
	$Temp_array[$rownum] = $row[3];
	$RH_array[$rownum] = $row[4];
	$TDS1_array[$rownum] = $row[5];
	$TDS2_array[$rownum] = $row[6];
	$CO2_array[$rownum] = $row[7];
	$Light_array[$rownum] = $row[8];
  $Water_array[$rownum] = $row[9];	
	$MagX_array[$rownum] = $row[10];
	$MagY_array[$rownum] = $row[11];
	$MagZ_array[$rownum] = $row[12];
	$TankTotal_array[$rownum] = $row[13];
	$Tank1_array[$rownum] = $row[14];
	$Tank2_array[$rownum] = $row[15];
	$Tank3_array[$rownum] = $row[16];
	$Tank4_array[$rownum] = $row[17];

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
  data.addColumn('number', 'Temperature');
  data.addColumn('number', 'RH');
  
	<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Temp_array[$rownum] . "," . $RH_array[$rownum] . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Temp_array[$rownum] . "," . $RH_array[$rownum] . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>
  
  var options = {
	  title: "Test",
      'colors': ["#FF5353","#6633FF","#51a806"],
	  'thickness': 2,
      'zoomStartTime': new Date((new Date()).getTime() - 1 * 1 * 60 * 60 * 1000), //NOTE: month 1 = Feb (javascript to blame)
	  'backgroundColor': '#DEB19E',
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
  data.addColumn('number', 'Light');
  
	<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Light_array[$rownum] . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Light_array[$rownum] . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>
  
  var options = {
	  title: "Test",
      'colors': ["#FF5353","#6633FF","#51a806"],
	  'thickness': 2,
		'fill': 40,
		'min' : 0,			
      'zoomStartTime': new Date((new Date()).getTime() - 1 * 1 * 60 * 60 * 1000), //NOTE: month 1 = Feb (javascript to blame)
	  'backgroundColor': ['#DEB19E'],
		scaleType:'allmaximized',
		scaleColumns: [0],
  };

  var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
	  document.getElementById('Light_Chart'));
  annotatedtimeline.draw(data, options);
  
  
}

google.setOnLoadCallback(drawVisualization);
</script>

<script type="text/javascript">
google.load('visualization', '1', {packages: ['annotatedtimeline']});
function drawVisualization() {
  var data = new google.visualization.DataTable();
  data.addColumn('datetime', 'Date');
  data.addColumn('number', 'UV Index');
//  data.addColumn('number', 'CO2');  

	<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Water_array[$rownum] . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Water_array[$rownum] . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>
  
  var options = {
	  title: "Test",
      'colors': ["#FF5353","#6633FF","#51a806"],
	  'thickness': 2,
		'fill': 40,
		'max' : 12,
		'min' : 0,
      'zoomStartTime': new Date((new Date()).getTime() - 1 * 1 * 60 * 60 * 1000), //NOTE: month 1 = Feb (javascript to blame)
	  'backgroundColor': '#DEB19E',
		scaleType:'allfixed',
		scaleColumns: [0,1],
  };

  var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
	  document.getElementById('CO2_Chart'));
  annotatedtimeline.draw(data, options);
  
  
}

google.setOnLoadCallback(drawVisualization);
</script>

<script type="text/javascript">
google.load('visualization', '1', {packages: ['annotatedtimeline']});
function drawVisualization() {
  var data = new google.visualization.DataTable();
  data.addColumn('datetime', 'Date');
  data.addColumn('number', 'X');
  data.addColumn('number', 'Y');
  data.addColumn('number', 'Z');


	<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $MagX_array[$rownum] . "," . $MagY_array[$rownum] . "," . $MagZ_array[$rownum] . "," . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $MagX_array[$rownum] . "," . $MagY_array[$rownum] . "," . $MagZ_array[$rownum] . "," . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>

  var options = {
	  title: "Test",
      'colors': ["#FF5353","#6633FF", "#51a806"],
	  'thickness': 2,
      'zoomStartTime': new Date((new Date()).getTime() - 1 * 1 * 60 * 60 * 1000), //NOTE: month 1 = Feb (javascript to blame)
	  'backgroundColor': '#DEB19E',
		scaleType:'allfixed',
		scaleColumns: [0,1,2],		
  };

  var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
	  document.getElementById('Magnometer_Chart'));
  annotatedtimeline.draw(data, options);

  
}
google.setOnLoadCallback(drawVisualization);
</script>


<script type="text/javascript">
$(function () {

<?php
  $mySeriesX = array();
	$mySeriesX = [];
	for ($i = 0; $i < sizeof ($MagX_array);$i++) {
		$mySeriesX [] = ([$MagX_array[$i], $MagX_array[$i+1]]);
	$i++;
	}
	
	$mySeriesY = array();
	$mySeriesY = [];
	for ($i = 0; $i < sizeof ($MagY_array);$i++) {
		$mySeriesY [] = ([$MagY_array[$i], $MagY_array[$i+1]]);
	$i++;
	}
?>


    $('#container').highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'Magnometer XY'
        },
        subtitle: {
            text: 'Source: Yieldbuddy'
        },
        xAxis: {
            title: {
                enabled: true,
                text: 'X'
            },
            startOnTick: true,
            endOnTick: true,
            showLastLabel: true
        },
        yAxis: {
            title: {
                text: 'Y'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 100,
            y: 70,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
            borderWidth: 1
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x} x, {point.y} y'
                }
            }
        },
        series: [{
            name: 'X',
            color: 'rgba(223, 83, 83, .5)',
            data: [<?php echo $mySeriesX ?>] 
        }, {
            name: 'Y',
            color: 'rgba(119, 152, 191, .5)',
            data: $mySeriesY
        }]
    });
});
</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Age', 'Weight'],
          [ 8,      12],
          [ 4,      5.5],
          [ 11,     14],
          [ 4,      5],
          [ 3,      3.5],
          [ 6.5,    7]
        ]);
				

        var options = {
          title: 'Magnometer XY',
          hAxis: {title: 'X-Axis'},
          vAxis: {title: 'Y-Axis'},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('gscatter'));

        chart.draw(data, options);
      }
    </script>




Temperature [°C] / Humidity :
<div id="Temperature_Chart" style="width: 1050px; height: 400px;"></div>
</br>
</br>
Light [Lumens] :
</br>
</br>
<div id="Light_Chart" style="width: 1050px; height: 400px;"></div>
</br>
</br>
Ultra-Violet UVAB :
</br>
</br>
<div id="CO2_Chart" style="width: 1050px; height: 400px;"></div>
</br>
</br>
Magnometer X,Y,Z [Gauss] :
</br>
</br>
<div id="Magnometer_Chart" style="width: 1050px; height: 400px;"></div>
</br>
</br>
Mag Highcharts:
</br>
</br>
<div id="container" style="width: 1050px; height: 400px;"></div>
</br>
</br>
gscatter:
</br>
</br>
<div id="gscatter" style="width: 1050px; height: 400px;"></div>
</td>
</body>
</html>
​
