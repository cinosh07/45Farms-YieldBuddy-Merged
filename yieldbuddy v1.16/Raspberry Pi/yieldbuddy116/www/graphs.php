<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
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
}
.description {
	font-size: 9px;
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
</head>

<body>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="100" align="center"><h6><br />
    <img src="img/banner.png" width="280" height="52" />[v1.16]</h6></td>
  </tr>
  <tr>
    <td height="20" align="left" valign="top">
    
    <table width="1044" border="0">
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
    <td height="77" valign="top"><p>
      <?php
session_start();
//SET MAXIMUM NUMBER OF arrayS TO QUERY HERE:
$Maximumarrays = 99;
//echo "Maximum Number of arrays: " . $Maximumarrays . "<br></br>";

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
$Query = "SELECT * FROM Sensors_Log ORDER BY `Time` ASC";
$Result = $mysqli->query($Query);     
if (!$Result) {
  printf("Query failed: %s\n", $mysqli->error);
  exit;
}
$i=0;
while ($Row =  $Result->fetch_array()) {
   $Time_array[$i] = $Row[0];
   $pH1_array[$i] = $Row[1];
   $pH2_array[$i] = $Row[2];
   $Temp_array[$i] = $Row[3];
   $RH_array[$i] = $Row[4];
   $TDS1_array[$i] = $Row[5];
   $TDS2_array[$i] = $Row[6];
   $CO2_array[$i] = $Row[7];
   $Light_array[$i] = $Row[8];
   $i=$i+1;
}
$Result->close();

//echo $Time_array[0] . " " . $pH1_array[0];




//echo "<br> " . $mysqli->host_info . "</br>";

$mysqli->close();

//record the ending time 
$end=microtime(); 
$end=explode(" ",$end); 
$end=$end[1]+$end[0]; 

//printf("<br></br>Query took %f seconds.",$end-$start);

?>
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'pH_Chart',
                zoomType: 'x',
                spacingRight: 20
            },
            title: {
                text: 'pH Sensors'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Drag your finger over the plot to zoom in'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 1 * 3600000, // one hour
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'pH'
                },
                showFirstLabel: false
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, 'rgba(2,0,0,0)']
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                radius: 5
                            }
                        }
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                name: 'pH1',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $pH1_array[$i] . "], ";
				$i=$i+1;
				}
				?>
                ]
            },
			{
				name: 'pH2',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $pH2_array[$i] . "], ";
				$i=$i+1;
				}
				?>
				]
			}			
			]
        });
    });
    
});
        </script>
      </p>
<div id="pH_Chart"> </div>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'Temp_Chart',
                zoomType: 'x',
                spacingRight: 20
            },
            title: {
                text: 'Temperature'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Drag your finger over the plot to zoom in'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 1 * 3600000, // one hour
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'Temperature [°C]'
                },
                showFirstLabel: false
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, 'rgba(2,0,0,0)']
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                radius: 5
                            }
                        }
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                name: 'Temperature',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $Temp_array[$i] . "], ";
				$i=$i+1;
				}
				?>
                ]
            }			
			]
        });
    });
    
});
</script>
<br />
<div id="Temp_Chart"> </div>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'TDS_Charts',
                zoomType: 'x',
                spacingRight: 20
            },
            title: {
                text: 'TDS1 / TDS2'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Drag your finger over the plot to zoom in'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 1 * 3600000, // one hour
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'Total Disolved Solids'
                },
                showFirstLabel: false
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, 'rgba(2,0,0,0)']
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                radius: 5
                            }
                        }
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                name: 'TDS1',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $TDS1_array[$i] . "], ";
				$i=$i+1;
				}
				?>
                ]
            },
			{
                name: 'TDS2',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $TDS2_array[$i] . "], ";
				$i=$i+1;
				}
				?>
                ]
            }			
			]
        });
    });
    
});
</script>
<br />
<div id="TDS_Charts"> </div>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'RH_CO2_Light_Charts',
                zoomType: 'x',
                spacingRight: 20
            },
            title: {
                text: 'RH / CO2 / Light'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Drag your finger over the plot to zoom in'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 1 * 3600000, // one hour
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'Percent [%]'
                },
                showFirstLabel: false
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, 'rgba(2,0,0,0)']
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                radius: 5
                            }
                        }
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                name: 'RH',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $RH_array[$i] . "], ";
				$i=$i+1;
				}
				?>
                ]
            },
			{
                name: 'CO2',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $CO2_array[$i] . "], ";
				$i=$i+1;
				}
				?>
                ]
            },
			{
                name: 'Light',
                data: [
                 <?php
				$i=0;
				$t = new DateTime;
				while ($i < sizeof($Time_array) ) {
				$t = date("U",strtotime($Time_array[$i]) );
				$t *= 1000;  // convert from Unix timestamp to JavaScript time
				//$t -= 12600000;
				//echo $t . " | ";
				echo "[" . $t . "," . $Light_array[$i] . "], ";
				$i=$i+1;
				}
				?>
                ]
            }			
			]
        });
    });
    
});
</script>
<br />
<div id="RH_CO2_Light_Charts"> </div>
<script src="sql/charts/highcharts.js"></script>
<script src="sql/charts/exporting.js"></script>
    </td>
  </tr>
  <tr>
    <td height="77">&nbsp;</td>
  </tr>
</table>
</body>
</html>
