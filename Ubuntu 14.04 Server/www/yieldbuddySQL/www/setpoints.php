<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/sql_setpoints_firstrow.php';
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
	color: #000;
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
</head>

<body>
<table width="850" border="0" align="center">
  <tr>
    <td align="center"><br />
    <img src="img/banner.png" width="280" height="52" />
    <color class="white">
    <?php
    include $_SERVER['DOCUMENT_ROOT']. '/yieldbuddy/www/version.php';
    ?>
    </color>
  </tr>
  <tr>
    <td valign="middle">
    
    <table width="850" border="0">
      <tr class="CenterPageTitles">
        <td width="104" height="34" align="left" valign="bottom"><a href="overview.php">Overview</a></td>
        <td width="150" valign="bottom"><a href="timers.php">Timers</a></td>
        <td width="155" valign="bottom"><a href="graphs.php">Graphs</a></td>
        <td width="155" valign="bottom"><a href="graphs_2.php">Graphs2</a></td>
        <td width="155" valign="bottom"><a href="graphs_3.php">Graphs3</a></td>				
        <td width="193" valign="bottom">Set Points</td>
        <td width="163" valign="bottom"><a href="alarms.php">Alarms</a></td>
        <td width="150" valign="bottom"><a href="system.php">System</a></td>
        <td width="99" align="right" valign="bottom"><a href="logout.php">Log Out</a></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
	<table width="900" align = "center">
    <td width ="900" align="center"><div class="cssbox">
      <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="77" colspan="2">
          
            <div align="center">
            <h6>Note: Low / High Values are used for alerts and for logging purposes.<br>
            </h6>
            </div>
            <h4>
              pH1
            </h4>
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		
		$pH1Value_Low=$_SESSION['pH1Value_Low'];
		$pH1Value_High=$_SESSION['pH1Value_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"pH1Value_Low\" size=\"6\" value=\"" . $pH1Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"pH1Value_High\" size=\"6\" value=\"" . $pH1Value_High . "\" /></div></td>";
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\">";
		echo "<input type=\"submit\"  name=\"submit\" value=\"Save pH1 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />
            pH2
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$pH2Value_Low=$_SESSION['pH2Value_Low'];
		$pH2Value_High=$_SESSION['pH2Value_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"pH2Value_Low\" size=\"6\" value=\"" . $pH2Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"pH2Value_High\" size=\"6\" value=\"" . $pH2Value_High . "\" /></div></td>";
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\">";
		echo "<input type=\"submit\"  name=\"submit\" value=\"Save pH2 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />
            Temperature
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$TempValue_Low=$_SESSION['TempValue_Low'];
		$TempValue_High=$_SESSION['TempValue_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TempValue_Low\" size=\"6\" value=\"" . $TempValue_Low . "\" />";
		echo "</td>";
     	echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TempValue_High\" size=\"6\" value=\"" . $TempValue_High . "\" /></div></td>";
		echo "</tr>";
		
		$Heater_ON=$_SESSION['Heater_ON'];
		$Heater_OFF=$_SESSION['Heater_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Heater On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Heater_ON\" size=\"6\" value=\"" . $Heater_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Heater Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Heater_OFF\" size=\"6\" value=\"" . $Heater_OFF . "\" /></div></td>";
		echo "</tr>";
		$AC_ON=$_SESSION['AC_ON'];
		$AC_OFF=$_SESSION['AC_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">AC On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"AC_ON\" size=\"6\" value=\"" . $AC_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">AC Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"AC_OFF\" size=\"6\" value=\"" . $AC_OFF . "\" /></div></td>";
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save Temp Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />
            RH
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$RHValue_Low=$_SESSION['RHValue_Low'];
		$RHValue_High=$_SESSION['RHValue_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"RHValue_Low\" size=\"6\" value=\"" . $RHValue_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"RHValue_High\" size=\"6\" value=\"" . $RHValue_High . "\" /></div></td>";
		echo "</tr>";
		
		$Humidifier_ON=$_SESSION['Humidifier_ON'];
		$Humidifier_OFF=$_SESSION['Humidifier_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Humidifier ON: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Humidifier_ON\" size=\"6\" value=\"" . $Humidifier_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Humidifier OFF: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Humidifier_OFF\" size=\"6\" value=\"" . $Humidifier_OFF . "\" /></div<</td>";
		echo "</tr>";
		
		$Dehumidifier_ON=$_SESSION['Dehumidifier_ON'];
		$Dehumidifier_OFF=$_SESSION['Dehumidifier_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Dehumidifier ON: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Dehumidifier_ON\" size=\"6\" value=\"" . $Dehumidifier_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Dehumidifier OFF: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Dehumidifier_OFF\" size=\"6\" value=\"" . $Dehumidifier_OFF . "\" /></div></td>";
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save RH Settings\" /></div></td>";
		echo "</tr>";

		?>
                </form>
              </tr>
            </table>
            <br />
            TDS 1
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$TDS1Value_Low=$_SESSION['TDS1Value_Low'];
		$TDS1Value_High=$_SESSION['TDS1Value_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TDS1Value_Low\" size=\"6\" value=\"" . $TDS1Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TDS1Value_High\" size=\"6\" value=\"" . $TDS1Value_High . "\" /></div></td>";
		
		$NutePump1_ON=$_SESSION['NutePump1_ON'];
		$NutePump1_OFF=$_SESSION['NutePump1_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Nutrient Pump On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"NutePump1_ON\" size=\"6\" value=\"" . $NutePump1_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Nutrient Pump Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"NutePump1_OFF\" size=\"6\" value=\"" . $NutePump1_OFF . "\" /></div></td>";
		echo "</tr>";
		
		$MixPump1_Enabled=$_SESSION['MixPump1_Enabled'];
		echo "<tr>";
		echo "<td><div align=\"right\">MixPump1 Enabled: &nbsp;&nbsp;&nbsp;";
		if ($MixPump1_Enabled == "1"){
	    echo "<label for=\"MixPump1 Enabled\"></label>";
		echo "<select name=\"MixPump1 Enabled\" id=\"MixPump1 Enabled\">";
		echo "<option selected=\"selected\">True</option>";
     	echo "<option>False</option>";
		echo "</select>";
		} else if ($MixPump1_Enabled == "0") {
	    echo "<label for=\"MixPump1 Enabled\"></label>";
		echo "<select name=\"MixPump1 Enabled\" id=\"MixPump1 Enabled\">";
		echo "<option selected=\"selected\">False</option>";
     	echo "<option>True</option>";
		echo "</select>";
		}
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save TDS1 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />
            TDS 2
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$TDS2Value_Low=$_SESSION['TDS2Value_Low'];
		$TDS2Value_High=$_SESSION['TDS2Value_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TDS2Value_Low\" size=\"6\" value=\"" . $TDS2Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TDS2Value_High\" size=\"6\" value=\"" . $TDS2Value_High . "\" /></div></td>";
		
		$NutePump2_ON=$_SESSION['NutePump2_ON'];
		$NutePump2_OFF=$_SESSION['NutePump2_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Nutrient Pump On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"NutePump2_ON\" size=\"6\" value=\"" . $NutePump2_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Nutrient Pump Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"NutePump2_OFF\" size=\"6\" value=\"" . $NutePump2_OFF . "\" /></div></td>";
		echo "</tr>";
		
		$MixPump2_Enabled=$_SESSION['MixPump2_Enabled'];
		echo "<tr>";
		echo "<td><div align=\"right\">MixPump2 Enabled: &nbsp;&nbsp;&nbsp;";
		if ($MixPump2_Enabled == "1"){
	    echo "<label for=\"MixPump2 Enabled\"></label>";
		echo "<select name=\"MixPump2 Enabled\" id=\"MixPump2 Enabled\">";
		echo "<option selected=\"selected\">True</option>";
     	echo "<option>False</option>";
		echo "</select>";
		} else if ($MixPump2_Enabled == "0") {
	    echo "<label for=\"MixPump2 Enabled\"></label>";
		echo "<select name=\"MixPump2 Enabled\" id=\"MixPump2 Enabled\">";
		echo "<option selected=\"selected\">False</option>";
     	echo "<option>True</option>";
		echo "</select>";
		}
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save TDS2 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />
            CO2
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$CO2Value_Low=$_SESSION['CO2Value_Low'];
		$CO2Value_High=$_SESSION['CO2Value_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"CO2Value_Low\" size=\"6\" value=\"" . $CO2Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"CO2Value_High\" size=\"6\" value=\"" . $CO2Value_High . "\" /></div></td>";
		echo "</tr>";
		
		$CO2_ON=$_SESSION['CO2_ON'];
		$CO2_OFF=$_SESSION['CO2_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">CO2 On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"CO2_ON\" size=\"6\" value=\"" . $CO2_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">CO2 Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"CO2_OFF\" size=\"6\" value=\"" . $CO2_OFF . "\" /></div></td>";
		echo "</tr>";
		
		$CO2_Enabled=$_SESSION['CO2_Enabled'];
		echo "<tr>";
		echo "<td><div align=\"right\">CO2 Enabled: &nbsp;&nbsp;&nbsp;";
		if ($CO2_Enabled == "1"){
	    echo "<label for=\"CO2 Enabled\"></label>";
		echo "<select name=\"CO2 Enabled\" id=\"CO2 Enabled\">";
		echo "<option selected=\"selected\">True</option>";
     	echo "<option>False</option>";
		echo "</select>";
		} else if ($CO2_Enabled == "0") {
	    echo "<label for=\"CO2 Enabled\"></label>";
		echo "<select name=\"CO2 Enabled\" id=\"CO2 Enabled\">";
		echo "<option selected=\"selected\">False</option>";
     	echo "<option>True</option>";
		echo "</select>";
		}
		//echo "<input type=\"text\" name=\"CO2_Enabled\" size=\"6\" value=\"" . $CO2_Enabled . "\" /></div></td>";
		echo "</tr>";
		echo "<tr><td></td>";			
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save CO2 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />
            Light
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$LightValue_Low=$_SESSION['LightValue_Low'];
		$LightValue_High=$_SESSION['LightValue_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"LightValue_Low\" size=\"6\" value=\"" . $LightValue_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"LightValue_High\" size=\"6\" value=\"" . $LightValue_High . "\" /></div></td>";
		echo "</tr>";
		
		echo "<tr><td></td>";				
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save Light Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />
            Water
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$WaterValue_Low=$_SESSION['WaterValue_Low'];
		$WaterValue_High=$_SESSION['WaterValue_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterValue_Low\" size=\"6\" value=\"" . $WaterValue_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterValue_High\" size=\"6\" value=\"" . $WaterValue_High . "\" /></div></td>";
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\">";
		echo "<input type=\"submit\"  name=\"submit\" value=\"Save Water Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />			
            TankTotal
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$TankTotalValue_Low=$_SESSION['TankTotalValue_Low'];
		$TankTotalValue_High=$_SESSION['TankTotalValue_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TankTotalValue_Low\" size=\"6\" value=\"" . $TankTotalValue_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"TankTotalValue_High\" size=\"6\" value=\"" . $TankTotalValue_High . "\" /></div></td>";
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\">";
		echo "<input type=\"submit\"  name=\"submit\" value=\"Save TankTotal Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />			
            Tank1
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$Tank1Value_Low=$_SESSION['Tank1Value_Low'];
		$Tank1Value_High=$_SESSION['Tank1Value_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank1Value_Low\" size=\"6\" value=\"" . $Tank1Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank1Value_High\" size=\"6\" value=\"" . $Tank1Value_High . "\" /></div></td>";
		
		$Tank1Pump_ON=$_SESSION['Tank1Pump_ON'];
		$Tank1Pump_OFF=$_SESSION['Tank1Pump_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Tank1 Pump On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank1Pump_ON\" size=\"6\" value=\"" . $Tank1Pump_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Tank1 Pump Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank1Pump_OFF\" size=\"6\" value=\"" . $Tank1Pump_OFF . "\" /></div></td>";
		echo "</tr>";
		
		$Tank1MixPump_Enabled=$_SESSION['Tank1MixPump_Enabled'];
		echo "<tr>";
		echo "<td><div align=\"right\">Tank1MixPump Enabled: &nbsp;&nbsp;&nbsp;";
		if ($Tank1MixPump_Enabled == "1"){
	    echo "<label for=\"Tank1MixPump Enabled\"></label>";
		echo "<select name=\"Tank1MixPump Enabled\" id=\"Tank1MixPump Enabled\">";
		echo "<option selected=\"selected\">True</option>";
     	echo "<option>False</option>";
		echo "</select>";
		} else if ($Tank1MixPump_Enabled == "0") {
	    echo "<label for=\"Tank1MixPump Enabled\"></label>";
		echo "<select name=\"Tank1MixPump Enabled\" id=\"Tank1MixPump Enabled\">";
		echo "<option selected=\"selected\">False</option>";
     	echo "<option>True</option>";
		echo "</select>";
		}
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save Tank1 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />					
            Tank2
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$Tank2Value_Low=$_SESSION['Tank2Value_Low'];
		$Tank2Value_High=$_SESSION['Tank2Value_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank2Value_Low\" size=\"6\" value=\"" . $Tank2Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank2Value_High\" size=\"6\" value=\"" . $Tank2Value_High . "\" /></div></td>";
		
		$Tank2Pump_ON=$_SESSION['Tank2Pump_ON'];
		$Tank2Pump_OFF=$_SESSION['Tank2Pump_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Tank2 Pump On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank2Pump_ON\" size=\"6\" value=\"" . $Tank2Pump_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Tank2 Pump Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank2Pump_OFF\" size=\"6\" value=\"" . $Tank2Pump_OFF . "\" /></div></td>";
		echo "</tr>";
		
		$Tank2MixPump_Enabled=$_SESSION['Tank2MixPump_Enabled'];
		echo "<tr>";
		echo "<td><div align=\"right\">Tank2MixPump Enabled: &nbsp;&nbsp;&nbsp;";
		if ($Tank2MixPump_Enabled == "1"){
	    echo "<label for=\"Tank2MixPump Enabled\"></label>";
		echo "<select name=\"Tank2MixPump Enabled\" id=\"Tank2MixPump Enabled\">";
		echo "<option selected=\"selected\">True</option>";
     	echo "<option>False</option>";
		echo "</select>";
		} else if ($Tank2MixPump_Enabled == "0") {
	    echo "<label for=\"Tank2MixPump Enabled\"></label>";
		echo "<select name=\"Tank2MixPump Enabled\" id=\"Tank2MixPump Enabled\">";
		echo "<option selected=\"selected\">False</option>";
     	echo "<option>True</option>";
		echo "</select>";
		}
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save Tank2 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>			
            <br />			
            Tank3
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$Tank3Value_Low=$_SESSION['Tank3Value_Low'];
		$Tank3Value_High=$_SESSION['Tank3Value_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank3Value_Low\" size=\"6\" value=\"" . $Tank3Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank3Value_High\" size=\"6\" value=\"" . $Tank3Value_High . "\" /></div></td>";
		
		$Tank3Pump_ON=$_SESSION['Tank3Pump_ON'];
		$Tank3Pump_OFF=$_SESSION['Tank3Pump_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Tank3 Pump On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank3Pump_ON\" size=\"6\" value=\"" . $Tank3Pump_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Tank3 Pump Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank3Pump_OFF\" size=\"6\" value=\"" . $Tank3Pump_OFF . "\" /></div></td>";
		echo "</tr>";
		
		$Tank3MixPump_Enabled=$_SESSION['Tank3MixPump_Enabled'];
		echo "<tr>";
		echo "<td><div align=\"right\">Tank3MixPump Enabled: &nbsp;&nbsp;&nbsp;";
		if ($Tank3MixPump_Enabled == "1"){
	    echo "<label for=\"Tank3MixPump Enabled\"></label>";
		echo "<select name=\"Tank3MixPump Enabled\" id=\"Tank3MixPump Enabled\">";
		echo "<option selected=\"selected\">True</option>";
     	echo "<option>False</option>";
		echo "</select>";
		} else if ($Tank3MixPump_Enabled == "0") {
	    echo "<label for=\"Tank3MixPump Enabled\"></label>";
		echo "<select name=\"Tank3MixPump Enabled\" id=\"Tank3MixPump Enabled\">";
		echo "<option selected=\"selected\">False</option>";
     	echo "<option>True</option>";
		echo "</select>";
		}
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save Tank3 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>			
            <br />			
            Tank4
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$Tank4Value_Low=$_SESSION['Tank4Value_Low'];
		$Tank4Value_High=$_SESSION['Tank4Value_High'];
        echo "<td width=\"300\"><div align=\"right\">Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank4Value_Low\" size=\"6\" value=\"" . $Tank4Value_Low . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank4Value_High\" size=\"6\" value=\"" . $Tank4Value_High . "\" /></div></td>";
		
		$Tank4Pump_ON=$_SESSION['Tank4Pump_ON'];
		$Tank4Pump_OFF=$_SESSION['Tank4Pump_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">Tank4 Pump On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank4Pump_ON\" size=\"6\" value=\"" . $Tank4Pump_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">Tank4 Pump Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"Tank4Pump_OFF\" size=\"6\" value=\"" . $Tank4Pump_OFF . "\" /></div></td>";
		echo "</tr>";
		
		$Tank4MixPump_Enabled=$_SESSION['Tank4MixPump_Enabled'];
		echo "<tr>";
		echo "<td><div align=\"right\">Tank4MixPump Enabled: &nbsp;&nbsp;&nbsp;";
		if ($Tank4MixPump_Enabled == "1"){
	    echo "<label for=\"Tank4MixPump Enabled\"></label>";
		echo "<select name=\"Tank4MixPump Enabled\" id=\"Tank4MixPump Enabled\">";
		echo "<option selected=\"selected\">True</option>";
     	echo "<option>False</option>";
		echo "</select>";
		} else if ($Tank4MixPump_Enabled == "0") {
	    echo "<label for=\"Tank4MixPump Enabled\"></label>";
		echo "<select name=\"Tank4MixPump Enabled\" id=\"Tank4MixPump Enabled\">";
		echo "<option selected=\"selected\">False</option>";
     	echo "<option>True</option>";
		echo "</select>";
		}
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save Tank4 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>			
			<br />
            WaterTempP1
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$WaterTempP1Value_Low=$_SESSION['WaterTempP1Value_Low'];
		$WaterTempP1Value_High=$_SESSION['WaterTempP1Value_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP1Value_Low\" size=\"6\" value=\"" . $WaterTempP1Value_Low . "\" />";
		echo "</td>";
     	echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP1Value_High\" size=\"6\" value=\"" . $WaterTempP1Value_High . "\" /></div></td>";
		echo "</tr>";
		
		$WaterTempP1Heater_ON=$_SESSION['WaterTempP1Heater_ON'];
		$WaterTempP1Heater_OFF=$_SESSION['WaterTempP1Heater_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP1Heater On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP1Heater_ON\" size=\"6\" value=\"" . $WaterTempP1Heater_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP1Heater Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP1Heater_OFF\" size=\"6\" value=\"" . $WaterTempP1Heater_OFF . "\" /></div></td>";
		echo "</tr>";
		$WaterTempP1AC_ON=$_SESSION['WaterTempP1AC_ON'];
		$WaterTempP1AC_OFF=$_SESSION['WaterTempP1AC_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP1AC On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP1AC_ON\" size=\"6\" value=\"" . $WaterTempP1AC_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP1AC Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP1AC_OFF\" size=\"6\" value=\"" . $WaterTempP1AC_OFF . "\" /></div></td>";
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save WaterTempP1 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />			
            WaterTempP2
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$WaterTempP2Value_Low=$_SESSION['WaterTempP2Value_Low'];
		$WaterTempP2Value_High=$_SESSION['WaterTempP2Value_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP2Value_Low\" size=\"6\" value=\"" . $WaterTempP2Value_Low . "\" />";
		echo "</td>";
     	echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP2Value_High\" size=\"6\" value=\"" . $WaterTempP2Value_High . "\" /></div></td>";
		echo "</tr>";
		
		$WaterTempP2Heater_ON=$_SESSION['WaterTempP2Heater_ON'];
		$WaterTempP2Heater_OFF=$_SESSION['WaterTempP2Heater_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP2Heater On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP2Heater_ON\" size=\"6\" value=\"" . $WaterTempP2Heater_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP2Heater Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP2Heater_OFF\" size=\"6\" value=\"" . $WaterTempP2Heater_OFF . "\" /></div></td>";
		echo "</tr>";
		$WaterTempP2AC_ON=$_SESSION['WaterTempP2AC_ON'];
		$WaterTempP2AC_OFF=$_SESSION['WaterTempP2AC_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP2AC On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP2AC_ON\" size=\"6\" value=\"" . $WaterTempP2AC_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP2AC Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP2AC_OFF\" size=\"6\" value=\"" . $WaterTempP2AC_OFF . "\" /></div></td>";
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save WaterTempP2 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />			
            WaterTempP3
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$WaterTempP3Value_Low=$_SESSION['WaterTempP3Value_Low'];
		$WaterTempP3Value_High=$_SESSION['WaterTempP3Value_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP3Value_Low\" size=\"6\" value=\"" . $WaterTempP3Value_Low . "\" />";
		echo "</td>";
     	echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP3Value_High\" size=\"6\" value=\"" . $WaterTempP3Value_High . "\" /></div></td>";
		echo "</tr>";
		
		$WaterTempP3Heater_ON=$_SESSION['WaterTempP3Heater_ON'];
		$WaterTempP3Heater_OFF=$_SESSION['WaterTempP3Heater_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP3Heater On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP3Heater_ON\" size=\"6\" value=\"" . $WaterTempP3Heater_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP3Heater Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP3Heater_OFF\" size=\"6\" value=\"" . $WaterTempP3Heater_OFF . "\" /></div></td>";
		echo "</tr>";
		$WaterTempP3AC_ON=$_SESSION['WaterTempP3AC_ON'];
		$WaterTempP3AC_OFF=$_SESSION['WaterTempP3AC_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP3AC On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP3AC_ON\" size=\"6\" value=\"" . $WaterTempP3AC_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP3AC Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP3AC_OFF\" size=\"6\" value=\"" . $WaterTempP3AC_OFF . "\" /></div></td>";
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save WaterTempP3 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />			
            WaterTempP4
            <table width="600" border="0">
              <tr>
                <form action="command.php" method="get">
                  <?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$WaterTempP4Value_Low=$_SESSION['WaterTempP4Value_Low'];
		$WaterTempP4Value_High=$_SESSION['WaterTempP4Value_High'];
		echo "<td width=\"300\"><div align=\"right\">";
        echo "Low: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP4Value_Low\" size=\"6\" value=\"" . $WaterTempP4Value_Low . "\" />";
		echo "</td>";
     	echo "<td><div align=\"right\">";
		echo "High: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP4Value_High\" size=\"6\" value=\"" . $WaterTempP4Value_High . "\" /></div></td>";
		echo "</tr>";
		
		$WaterTempP4Heater_ON=$_SESSION['WaterTempP4Heater_ON'];
		$WaterTempP4Heater_OFF=$_SESSION['WaterTempP4Heater_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP4Heater On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP4Heater_ON\" size=\"6\" value=\"" . $WaterTempP4Heater_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP4Heater Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP4Heater_OFF\" size=\"6\" value=\"" . $WaterTempP4Heater_OFF . "\" /></div></td>";
		echo "</tr>";
		$WaterTempP4AC_ON=$_SESSION['WaterTempP4AC_ON'];
		$WaterTempP4AC_OFF=$_SESSION['WaterTempP4AC_OFF'];
		echo "<tr>";
        echo "<td><div align=\"right\">WaterTempP4AC On: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP4AC_ON\" size=\"6\" value=\"" . $WaterTempP4AC_ON . "\" /></div>";
		echo "</td>";
		echo "<td><div align=\"right\">WaterTempP4AC Off: &nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"WaterTempP4AC_OFF\" size=\"6\" value=\"" . $WaterTempP4AC_OFF . "\" /></div></td>";
		
		echo "</tr>";
		echo "<tr><td></td>";
		echo "<td><div align=\"right\"><input type=\"submit\"  name=\"submit\" value=\"Save WaterTempP4 Settings\" /></div></td>";
		echo "</tr>";
		?>
                </form>
              </tr>
            </table>
            <br />			
			
			
			
			
			
			
			
			
			
			
        </td>
        </tr>
      </table>
  </td>
  </tr>
</table>

</body>
</html>
