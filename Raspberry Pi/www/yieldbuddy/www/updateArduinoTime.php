<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/yieldbuddy2/www/sql/sql_arduino_firstrow.php';
	  $Arduino_Time=$_SESSION['Arduino_Time'];
          $Arduino_Month=$_SESSION['Arduino_Month'];
          $Arduino_Day=$_SESSION['Arduino_Day'];
          $Arduino_Year=$_SESSION['Arduino_Year'];
          $Arduino_Hour=$_SESSION['Arduino_Hour'];
          $Arduino_Minute=$_SESSION['Arduino_Minute'];
          $Arduino_Second=$_SESSION['Arduino_Second'];
          
          echo '<input type="hidden" id="ArduinoTime" value="'.$Arduino_Time.'"/>';
          echo '<input type="hidden" id="ArduinoMonth" value="'.$Arduino_Month.'"/>';
          echo '<input type="hidden" id="ArduinoDay" value="'.$Arduino_Day.'"/>';
          echo '<input type="hidden" id="ArduinoYear" value="'.$Arduino_Year.'"/>';
          echo '<input type="hidden" id="ArduinoHour" value="'.$Arduino_Hour.'"/>';
          echo '<input type="hidden" id="ArduinoMinute" value="'.$Arduino_Minute.'"/>';
          echo '<input type="hidden" id="ArduinoSecond" value="'.$Arduino_Second.'"/>';
//	  echo "Arduino Time: ";
//	  echo $Arduino_Time. "<br />";
?>
