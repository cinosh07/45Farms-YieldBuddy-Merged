<?php
session_start();
if(!file_exists('users/' . $_SESSION['username'] . '.xml')){
	header('Location: index.php');
	die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON"
       HREF="/yieldbuddy/www/img/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sending Command</title>
<style type="text/css">
body {
	background-image: url(img/background.png);
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	color: #CCC;
	font-weight: bold;
	position: relative;
}
</style>
</head>

<body>
<p><img src="img/banner.png" width="383" height="77" /></p>
<p>
      <?php
 	$sec = "2";  //Default Refresh Time
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }

	$command=$_GET["command"];
    $submit=$_GET["submit"];


	echo "Submit:  " .$submit. "<br>";
	if ($submit == "Set Arduino's Time to Raspberry Pi's Time"){
	$command="setdate," .date("m"). "," .date("d"). "," .date("Y"). "," .date("H"). "," .date("i"). "," .date("s");
	}
	if ($submit == "Set Raspberry Pi's Time to Arduino's Time"){
	$command = "Set Raspberry Pi's Time to Arduino's Time";
	}
		
	if ($submit == "Set Arduino"){
	$Arduino_month = $_GET["Arduino_month"];
	$Arduino_day = $_GET["Arduino_day"];
	$Arduino_year = $_GET["Arduino_year"];
	$Arduino_hour = $_GET["Arduino_hour"];
	$Arduino_min = $_GET["Arduino_min"];
	$Arduino_sec = $_GET["Arduino_sec"];
	$command="setdate," .$Arduino_month. "," .$Arduino_day. "," .$Arduino_year. "," .$Arduino_hour. "," .$Arduino_min. "," .$Arduino_sec;
	}
	if ($submit == "Set Raspberry Pi"){
	$Rasp_month = $_GET["Rasp_month"];
	$Rasp_day = $_GET["Rasp_day"];
	$Rasp_year = $_GET["Rasp_year"];
	$Rasp_hour = $_GET["Rasp_hour"];
	$Rasp_min = $_GET["Rasp_min"];
	$Rasp_sec = $_GET["Rasp_sec"];
	$command="setraspberrypi," .$Rasp_month. "," .$Rasp_day. "," .$Rasp_year. "," .$Rasp_hour. "," .$Rasp_min. "," .$Rasp_sec;
	}
	if ($submit == "Save Light Schedule"){
	$Light_Mode_INT = $_GET["Light_Mode_INT"];
	$Light_ON_hour = $_GET["Light_ON_hour"];
	$Light_ON_min = $_GET["Light_ON_min"];
	$Light_OFF_hour = $_GET["Light_OFF_hour"];
	$Light_OFF_min = $_GET["Light_OFF_min"];
	$command="setlightschedule," .$Light_ON_hour. "," .$Light_ON_min. "," .$Light_OFF_hour. "," .$Light_OFF_min;
	$sec = "4";  //Increase Refresh Time to allow changes
	}
	if ($submit == "Save Watering Schedule"){
	$Pump_start_hour = $_GET["Pump_start_hour"];
	$Pump_start_min = $_GET["Pump_start_min"];
	$Pump_every_hours = $_GET["Pump_every_hours"];
	$Pump_every_mins= $_GET["Pump_every_mins"];
	$Pump_for = $_GET["Pump_for"];
	$Pump_times = $_GET["Pump_times"];
	$command="setwateringschedule," .$Pump_start_hour. "," .$Pump_start_min. "," .$Pump_every_hours. "," .$Pump_every_mins. "," .$Pump_for. "," .$Pump_times;
	$sec = "5";  //Increase Refresh Time to allow changes
	}
	
	if ($submit == "Restore Defaults"){
		$command="restoredefaults";
	}
	
	if ($submit == "Save Email Settings"){
		$smtp_server = $_GET["smtp_server"];
		$smtp_port = $_GET["smtp_port"];
		$login_email = $_GET["login_email"];
		$login_email_password = $_GET["login_email_password"];
		$recipient_email = $_GET["recipient_email"]; 
		$command="saveemailsettings," .$login_email. "," .$login_email_password. "," . $recipient_email. "," . $smtp_server. "," .$smtp_port;
	}
	
	if ($submit == "Save Camera Settings"){
		$camera_address = $_GET["camera_address"];
		
		session_start();

		$db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/yieldbuddy/www/sql/yieldbuddy.sqlite3');
		$db->busyTimeout(4000);
		$alarmsql_query = "UPDATE Camera SET connectback_address='" . $camera_address ."'";
		$query = $db->exec($alarmsql_query);
		if (!$query) {
			echo("Error saving changes: '$error'");
		}
	}
	
	if ($submit == "Save pH1 Settings"){
	$pH1Value_Low = $_GET["pH1Value_Low"];
	$pH1Value_High = $_GET["pH1Value_High"];
	$command="setpH1," .$pH1Value_Low. "," .$pH1Value_High;
	}
	
	if ($submit == "Save pH2 Settings"){
	$pH2Value_Low = $_GET["pH2Value_Low"];
	$pH2Value_High = $_GET["pH2Value_High"];
	$command="setpH2," .$pH2Value_Low. "," .$pH2Value_High;
	}
	
	if ($submit == "Save Temp Settings"){
	$TempValue_Low = $_GET["TempValue_Low"];
	$TempValue_High = $_GET["TempValue_High"];
	$Heater_ON = $_GET["Heater_ON"];
	$Heater_OFF = $_GET["Heater_OFF"];
	$AC_ON= $_GET["AC_ON"];
	$AC_OFF = $_GET["AC_OFF"];		
	$command="setTemp," .$TempValue_Low. "," .$TempValue_High. "," .$Heater_ON. "," .$Heater_OFF. "," .$AC_ON. "," .$AC_OFF;
	}
	
	if ($submit == "Save RH Settings"){
	$RHValue_Low = $_GET["RHValue_Low"];
	$RHValue_High = $_GET["RHValue_High"];
	$Humidifier_ON = $_GET["Humidifier_ON"];
	$Humidifier_OFF = $_GET["Humidifier_OFF"];
	$Dehumidifier_ON= $_GET["Dehumidifier_ON"];
	$Dehumidifier_OFF = $_GET["Dehumidifier_OFF"];		
	$command="setRH," .$RHValue_Low. "," .$RHValue_High. "," .$Humidifier_ON. "," .$Humidifier_OFF. "," .$Dehumidifier_ON. "," .$Dehumidifier_OFF;
	}
	
	if ($submit == "Save TDS1 Settings"){
	$TDS1Value_Low = $_GET["TDS1Value_Low"];
	$TDS1Value_High = $_GET["TDS1Value_High"];
	$NutePump1_ON = $_GET["NutePump1_ON"];
	$NutePump1_OFF = $_GET["NutePump1_OFF"];
	$MixPump1_Enabled= $_GET["MixPump1_Enabled"];
	if ($MixPump1_Enabled == "True"){
		$MixPump1_Enabled = "1";
	} else if ($MixPump1_Enabled == "False") {
		$MixPump1_Enabled = "0";
	}
	$command="setTDS1Value," .$TDS1Value_Low. "," .$TDS1Value_High. "," .$NutePump1_ON. "," .$NutePump1_OFF. "," .$MixPump1_Enabled;
	}
	
	if ($submit == "Save TDS2 Settings"){
	$TDS2Value_Low = $_GET["TDS2Value_Low"];
	$TDS2Value_High = $_GET["TDS2Value_High"];
	$NutePump2_ON = $_GET["NutePump2_ON"];
	$NutePump2_OFF = $_GET["NutePump2_OFF"];
	$MixPump2_Enabled= $_GET["MixPump2_Enabled"];	
	if ($MixPump2_Enabled == "True"){
		$MixPump2_Enabled = "1";
	} else if ($MixPump2_Enabled == "False") {
		$MixPump2_Enabled = "0";
	}	
	$command="setTDS2Value," .$TDS2Value_Low. "," .$TDS2Value_High. "," .$NutePump2_ON. "," .$NutePump2_OFF. "," .$MixPump2_Enabled;
	}
	
	if ($submit == "Save CO2 Settings"){
	$CO2Value_Low = $_GET["CO2Value_Low"];
	$CO2Value_High = $_GET["CO2Value_High"];
	$CO2_ON = $_GET["CO2_ON"];
	$CO2_OFF = $_GET["CO2_OFF"];	
	$CO2_Enabled = $_GET["CO2_Enabled"];
	if ($CO2_Enabled == "True"){
		$CO2_Enabled = "1";
	} else if ($CO2_Enabled == "False") {
		$CO2_Enabled = "0";
	}
	$command="setCO2," .$CO2Value_Low. "," .$CO2Value_High. "," .$CO2_ON. "," .$CO2_OFF. "," .$CO2_Enabled;
	}
	
	if ($submit == "Save Light Settings"){
	$LightValue_Low = $_GET["LightValue_Low"];
	$LightValue_High = $_GET["LightValue_High"];
	$command="setLight," .$LightValue_Low. "," .$LightValue_High;
	}
	if ($submit == "Save Water Settings"){
	$WaterValue_Low = $_GET["WaterValue_Low"];
	$WaterValue_High = $_GET["WaterValue_High"];
	$command="setWater," .$WaterValue_Low. "," .$WaterValue_High;
	}
	
	if ($submit == "Save TankTotal Settings"){
	$TankTotalValue_Low = $_GET["TankTotalValue_Low"];
	$TankTotalValue_High = $_GET["TankTotalValue_High"];
	$command="setTankTotal," .$TankTotalValue_Low. "," .$TankTotalValue_High;
	}
	
	if ($submit == "Save Tank1 Settings"){
	$Tank1Value_Low = $_GET["Tank1Value_Low"];
	$Tank1Value_High = $_GET["Tank1Value_High"];
	$Tank1Pump_ON = $_GET["Tank1Pump_ON"];
	$Tank1Pump_OFF = $_GET["Tank1Pump_OFF"];
	$Tank1MixPump_Enabled= $_GET["Tank1MixPump_Enabled"];
	if ($Tank1MixPump_Enabled == "True"){
		$Tank1MixPump_Enabled = "1";
	} else if ($Tank1MixPump_Enabled == "False") {
		$Tank1MixPump_Enabled = "0";
	}
	$command="setTank1Value," .$Tank1Value_Low. "," .$Tank1Value_High. "," .$Tank1Pump_ON. "," .$Tank1Pump_OFF. "," .$Tank1MixPump_Enabled;
	}
	
	if ($submit == "Save Tank2 Settings"){
	$Tank2Value_Low = $_GET["Tank2Value_Low"];
	$Tank2Value_High = $_GET["Tank2Value_High"];
	$Tank2Pump_ON = $_GET["Tank2Pump_ON"];
	$Tank2Pump_OFF = $_GET["Tank2Pump_OFF"];
	$Tank2MixPump_Enabled= $_GET["Tank2MixPump_Enabled"];
	if ($Tank2MixPump_Enabled == "True"){
		$Tank2MixPump_Enabled = "1";
	} else if ($Tank2MixPump_Enabled == "False") {
		$Tank2MixPump_Enabled = "0";
	}
	$command="setTank2Value," .$Tank2Value_Low. "," .$Tank2Value_High. "," .$Tank2Pump_ON. "," .$Tank2Pump_OFF. "," .$Tank2MixPump_Enabled;
	}	
	
	if ($submit == "Save Tank3 Settings"){
	$Tank3Value_Low = $_GET["Tank3Value_Low"];
	$Tank3Value_High = $_GET["Tank3Value_High"];
	$Tank3Pump_ON = $_GET["Tank3Pump_ON"];
	$Tank3Pump_OFF = $_GET["Tank3Pump_OFF"];
	$Tank3MixPump_Enabled= $_GET["Tank3MixPump_Enabled"];
	if ($Tank3MixPump_Enabled == "True"){
		$Tank3MixPump_Enabled = "1";
	} else if ($Tank3MixPump_Enabled == "False") {
		$Tank3MixPump_Enabled = "0";
	}
	$command="setTank3Value," .$Tank3Value_Low. "," .$Tank3Value_High. "," .$Tank3Pump_ON. "," .$Tank3Pump_OFF. "," .$Tank3MixPump_Enabled;
	}	

	if ($submit == "Save Tank4 Settings"){
	$Tank4Value_Low = $_GET["Tank4Value_Low"];
	$Tank4Value_High = $_GET["Tank4Value_High"];
	$Tank4Pump_ON = $_GET["Tank4Pump_ON"];
	$Tank4Pump_OFF = $_GET["Tank4Pump_OFF"];
	$Tank4MixPump_Enabled= $_GET["Tank4MixPump_Enabled"];
	if ($Tank4MixPump_Enabled == "True"){
		$Tank4MixPump_Enabled = "1";
	} else if ($Tank4MixPump_Enabled == "False") {
		$Tank4MixPump_Enabled = "0";
	}
	$command="setTank4Value," .$Tank4Value_Low. "," .$Tank4Value_High. "," .$Tank4Pump_ON. "," .$Tank4Pump_OFF. "," .$Tank4MixPump_Enabled;
	}
	
	if ($submit == "Save Email Settings"){
    echo "Sending Command:  Save Email Settings<br>";
	} 
	
	else {
	echo "Sending Command:  " .$command. "<br>";
	}
	
	if ($submit == "Reboot"){
	echo "Rebooting!  Waiting 65 seconds...</br>";
	$command="reboot yes";
	$sec = "65";
	}
	
	if ($submit == "Restart yieldbuddy"){
	echo "Restarting yieldbuddy!  Waiting 10 seconds...</br>";
	$command="restart yieldbuddy";
	$sec = "10";
	}

	//SEND COMMAND
	$myFile = $_SERVER['DOCUMENT_ROOT'] . "/yieldbuddy/Command";
	$file_command=fopen($myFile, "w") or exit("Unable to open file! '" .$myFile."'");
        fwrite($file_command, $command);
	echo "Command Sent.";
	fclose($file_command);
	
	
	//PAGES THAT REQUIRE MORE REFRESH TIME
	if ($command == "restart cam"){
		$sec = "5";
	}
	header("Refresh: $sec; url={$_SERVER['HTTP_REFERER']}");
     ?>
</p>

</body>
</html>
