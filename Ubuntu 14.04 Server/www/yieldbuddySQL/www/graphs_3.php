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

<style type="text/css">
	#container {
    height: 400px; 
    min-width: 1050px; 
    max-width: 1050px;
    margin: 0 auto;
	}
</style>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages': ['corechart','scatter','annotatedtimeline'});
  google.charts.setOnLoadCallback(drawChart);
</script>


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

#$db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/yieldbuddy.sqlite3');

//Load SQL settings
#Load SQL Settings (MySQL)
f_sql_address=open(app_path+'www/settings/sql/address','r+')
sql_address=f_sql_address.readline()
sql_address=sql_address.rstrip('\n')
f_sql_address.close()

f_sql_username=open(app_path+'www/settings/sql/username','r+')
sql_username=f_sql_username.readline()
sql_username=sql_username.rstrip('\n')
f_sql_username.close()

f_sql_password=open(app_path+'www/settings/sql/password','r+')
sql_password=f_sql_password.readline()
sql_password=sql_password.rstrip('\n')
f_sql_password.close()

f_sql_database=open(app_path+'www/settings/sql/database','r+')
sql_database=f_sql_database.readline()
sql_database=sql_database.rstrip('\n')
f_sql_database.close()

#db = MySQLdb.connect(sql_address,sql_username,sql_password,sql_database)

$db = new mysqli($sql_address, $sql_username, $sql_password, $sql_database, 3306);

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
  var data = array();
  /* data.addColumn('datetime', 'Date'); */
  data.addColumn('number', 'X');
  data.addColumn('number', 'Y');
  data.addColumn('number', 'Z');


	data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[" . $MagX_array[$rownum] . "," . $MagY_array[$rownum] . "," . $MagZ_array[$rownum] . "," . "]\n";
			} else {
				echo "[" . $MagX_array[$rownum] . "," . $MagY_array[$rownum] . "," . $MagZ_array[$rownum] ."],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>	
</script>
	
	

<script type="text/javascript">
	$(function () {
		

		

    // Give the points a 3D feel by adding a radial gradient
    Highcharts.getOptions().colors = $.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.4,
                cy: 0.3,
                r: 0.5
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.2).get('rgb')]
            ]
        };
    });

    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            margin: 100,
            type: 'scatter',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 30,
                depth: 250,
                viewDistance: 10,
                fitToPlot: true,
                frame: {
                    bottom: { size: 1, color: 'rgba(0,0,0,0.02)' },
                    back: { size: 1, color: 'rgba(0,0,0,0.04)' },
                    side: { size: 1, color: 'rgba(0,0,0,0.06)' }
                }
            }
        },
        title: {
            text: 'Draggable box'
        },
        subtitle: {
            text: 'Click and drag the plot area to rotate in space'
        },
        plotOptions: {
            scatter: {
                width: 10,
                height: 10,
                depth: 10
            }
        },
        yAxis: {
            min: 0,
            max: 10,
            title: null
        },
        xAxis: {
            min: 0,
            max: 10,
            gridLineWidth: 1
        },
        zAxis: {
            min: 0,
            max: 10,
            showFirstLabel: false
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Reading',
            colorByPoint: true,
            /* data: [[1, 6, 5], [8, 7, 9], [1, 3, 4], [4, 6, 8], [5, 7, 7], [6, 9, 6], [7, 0, 5], [2, 3, 3], [3, 9, 8], [3, 6, 5], [4, 9, 4], [2, 3, 3], [6, 9, 9], [0, 7, 0], [7, 7, 9], [7, 2, 9], [0, 6, 2], [4, 6, 7], [3, 7, 7], [0, 1, 7], [2, 8, 6], [2, 3, 7], [6, 4, 8], [3, 5, 9], [7, 9, 5], [3, 1, 7], [4, 4, 2], [3, 6, 2], [3, 1, 6], [6, 8, 5], [6, 6, 7], [4, 1, 1], [7, 2, 7], [7, 7, 0], [8, 8, 9], [9, 4, 1], [8, 3, 4], [9, 8, 9], [3, 5, 3], [0, 2, 4], [6, 0, 2], [2, 1, 3], [5, 8, 9], [2, 1, 1], [9, 7, 6], [3, 0, 2], [9, 9, 0], [3, 4, 8], [2, 6, 1], [8, 9, 2], [7, 6, 5], [6, 3, 1], [9, 3, 1], [8, 9, 3], [9, 1, 0], [3, 8, 7], [8, 0, 0], [4, 9, 7], [8, 6, 2], [4, 3, 0], [2, 3, 5], [9, 1, 4], [1, 1, 4], [6, 0, 2], [6, 1, 6], [3, 8, 8], [8, 8, 7], [5, 5, 0], [3, 9, 6], [5, 4, 3], [6, 8, 3], [0, 1, 5], [6, 7, 3], [8, 3, 2], [3, 8, 3], [2, 1, 6], [4, 6, 7], [8, 9, 9], [5, 4, 2], [6, 1, 3], [6, 9, 5], [4, 8, 2], [9, 7, 4], [5, 4, 2], [9, 6, 1], [2, 7, 3], [4, 5, 4], [6, 8, 1], [3, 4, 0], [2, 2, 6], [5, 1, 2], [9, 9, 7], [6, 9, 9], [8, 4, 3], [4, 1, 7], [6, 2, 5], [0, 4, 9], [3, 5, 9], [6, 9, 1], [1, 9, 2]] */
            data: [data]

						}]
    });


    // Add mouse events for rotation
    $(chart.container).bind('mousedown.hc touchstart.hc', function (eStart) {
        eStart = chart.pointer.normalize(eStart);

        var posX = eStart.pageX,
            posY = eStart.pageY,
            alpha = chart.options.chart.options3d.alpha,
            beta = chart.options.chart.options3d.beta,
            newAlpha,
            newBeta,
            sensitivity = 5; // lower is more sensitive

        $(document).bind({
            'mousemove.hc touchdrag.hc': function (e) {
                // Run beta
                newBeta = beta + (posX - e.pageX) / sensitivity;
                chart.options.chart.options3d.beta = newBeta;

                // Run alpha
                newAlpha = alpha + (e.pageY - posY) / sensitivity;
                chart.options.chart.options3d.alpha = newAlpha;

                chart.redraw(false);
            },
            'mouseup touchend': function () {
                $(document).unbind('.hc');
            }
        });
    });

});
		</script>


		
<script type="text/javascript">
      google.charts.load('current', {'packages':['scatter']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart () {

        var data = new google.visualization.DataTable();
				data.addColumn('datetime', 'Date');
				data.addColumn('number', 'X');
				data.addColumn('number', 'Y');
				/* data.addColumn('number', 'Z'); */

/*         data.addRows([
          [0, 0, 67],  [1, 1, 88],   [2, 2, 77],
          [3, 3, 93],  [4, 4, 85],   [5, 5, 91],
          [6, 6, 71],  [7, 7, 78],   [8, 8, 93],
          [9, 9, 80],  [10, 10, 82], [11, 0, 75],
          [12, 5, 80], [13, 3, 90],  [14, 1, 72],
          [15, 5, 75], [16, 6, 68],  [17, 7, 98],
          [18, 3, 82], [19, 9, 94],  [20, 2, 79],
          [21, 2, 95], [22, 2, 86],  [23, 3, 67],
          [24, 4, 60], [25, 2, 80],  [26, 6, 92],
          [27, 2, 81], [28, 8, 79],  [29, 9, 83]
        ]);
 */
 
	<?php
	echo "data.addRows([";
	$rownum=0;
		while ($rownum < sizeof($Time_array)) {
			if ($rownum == (sizeof($Time_array) - 1)) {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $MagX_array[$rownum] . "," . $MagY_array[$rownum] . "," . "]\n";
			} else {
				echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $MagX_array[$rownum] . "," . $MagY_array[$rownum] . "," . "],\n";
			}
			$rownum = $rownum + 1;
		}
	echo "]);";
	?>

 
 
 
 
 
        var options = {
          chart: {
            title: 'Magnometer',
            subtitle: 'X-Y Axis'
          },
          width: 1050,
          height: 400,
          series: {
            0: {axis: 'X-Axis'},
            1: {axis: 'Y-Axis'}
          },
          axes: {
            y: {
              'X': {label: 'X'},
              'Y': {label: 'Y'}
            }
          }
        };

        var chart = new google.charts.Scatter(document.getElementById('scatter_dual_y'));

        chart.draw(data, options);

      }
		
		</script>		
		
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>





Mag Highcharts:
</br>
</br>
<div id="container" style="height: 400px"></div>
</td>
</body>
</html>
​
