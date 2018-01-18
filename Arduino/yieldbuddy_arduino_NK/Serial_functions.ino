#include "Arduino.h"
/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!SEND SERIAL MESSAGE!!!!SEND SERIAL MESSAGE!!SEND SERIAL MESSAGE!!SEND SERIAL MESSAGE!!SEND SERIAL MESSAGE!!SEND SERIAL MESSAGE!!SEND SERIAL MESSAGE!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
void sendRelayMessages() {
  //RELAYS
    Serial.print("Relays,");
    if (digitalRead(Relay1_Pin) == LOW){
      Serial.print(1);
    } 
    else if (digitalRead(Relay1_Pin) == HIGH) {
      Serial.print(0);
    }
    Serial.print(",");
    if (digitalRead(Relay2_Pin) == LOW){
      Serial.print(1);
    } 
    else if (digitalRead(Relay2_Pin) == HIGH) {
      Serial.print(0);
    }
    Serial.print(",");
    if (digitalRead(Relay3_Pin) == LOW){
      Serial.print(1);
    } 
    else if (digitalRead(Relay3_Pin) == HIGH) {
      Serial.print(0);
    }
    Serial.print(",");
    if (digitalRead(Relay4_Pin) == LOW){
      Serial.print(1);
    } 
    else if (digitalRead(Relay4_Pin) == HIGH) {
      Serial.print(0);
    }
    Serial.print(",");
    if (digitalRead(Relay5_Pin) == LOW){
      Serial.print(1);
    } 
    else if (digitalRead(Relay5_Pin) == HIGH) {
      Serial.print(0);
    }
    Serial.print(",");
    if (digitalRead(Relay6_Pin) == LOW){
      Serial.print(1);
    } 
    else if (digitalRead(Relay6_Pin) == HIGH) {
      Serial.print(0);
    }
    Serial.print(",");
    if (digitalRead(Relay7_Pin) == LOW){
      Serial.print(1);
    } 
    else if (digitalRead(Relay7_Pin) == HIGH) {
      Serial.print(0);
    }
   Serial.print(",");   //This Relay is opposite
    if (digitalRead(Relay8_Pin) == LOW){
      Serial.println(1);
    } 
    else if (digitalRead(Relay8_Pin) == HIGH) {
      Serial.println(0);
    }

    //Relay_isAuto Values (Modes)
    Serial.print("Relay_isAuto,");
    Serial.print(Relay1_isAuto);
    Serial.print(",");
    Serial.print(Relay2_isAuto);
    Serial.print(",");
    Serial.print(Relay3_isAuto);
    Serial.print(",");
    Serial.print(Relay4_isAuto);
    Serial.print(",");
    Serial.print(Relay5_isAuto);
    Serial.print(",");
    Serial.print(Relay6_isAuto);  
    Serial.print(",");
    Serial.print(Relay7_isAuto);
    Serial.print(",");
    Serial.println(Relay8_isAuto);
}
 
void sendserialmessages(){

  //The purpose of 'serialcounter' is so that serial messages are not sent as one big chunk of data every 'loop()', instead they are split up
  //into 3 chunks, and those chunks are then sent every second loop (over a period of a total of 5 'loop()s')
  //However, Sensors and Relay values are sent every 1st and 4th messages.

  if (serialcounter == 1 || serialcounter == 3 || serialcounter == 5 || serialcounter == 7 || serialcounter == 9 || serialcounter == 11 || serialcounter == 13 || serialcounter == 15 || serialcounter == 17|| serialcounter == 19 || serialcounter == 21){
    //*****SEND TIMESTAMP
    updatelongdate();
    Serial.println(); 
    Serial.print("Time,");
    Serial.print(longdate);
    Serial.print(",");
    Serial.print(month());
    Serial.print(",");
    Serial.print(day());
    Serial.print(",");
    Serial.print(year());
    Serial.print(",");
    Serial.print(hour());
    Serial.print(",");
    Serial.print(minute());
    Serial.print(",");
    Serial.println(second());  
    //*****SENSOR VALUES
    Serial.print("Sensors,");
    Serial.print(pH1Value);
    Serial.print(",");
    Serial.print(pH2Value);
    Serial.print(",");
    Serial.print(TempValue);
    Serial.print(",");
    Serial.print(RHValue);
    Serial.print(",");
    Serial.print(TDS1Value);
    Serial.print(",");
    Serial.print(TDS2Value);
    Serial.print(",");
    Serial.print(CO2Value);
    Serial.print(",");
    Serial.print(LightValue);
    Serial.print(",");
    Serial.print(WaterValue);
    Serial.print(",");    
    Serial.print(MagXValue);
    Serial.print(",");
    Serial.print(MagYValue);
    Serial.print(",");
    Serial.print(MagZValue);
    Serial.print(",");
    Serial.print(TankTotalValue);            
    Serial.print(",");    
    Serial.print(Tank1Value);
    Serial.print(",");
    Serial.print(Tank2Value);
    Serial.print(",");
    Serial.print(Tank3Value);
    Serial.print(",");
    Serial.print(Tank4Value);
    Serial.print(",");    
    Serial.print(WaterTempP1RawValue);
    Serial.print(",");
    Serial.print(WaterTempP2Value);
    Serial.print(",");
    Serial.print(WaterTempP3Value);
    Serial.print(",");
    Serial.println(WaterTempP4Value);   
    sendRelayMessages(); //<<---- Relays and Relay_isAutoMessages
  }
 //******Schedules**************** 
  if (serialcounter == 3) { 


    //*****LIGHTS
    Serial.print("Light_Schedule,");
    Serial.print(Light_ON_hour);
    Serial.print(",");
    Serial.print(Light_ON_min);
    Serial.print(",");
    Serial.print(Light_OFF_hour);
    Serial.print(",");
    Serial.println(Light_OFF_min);
    
    //*****WATERING
    Serial.print("Watering_Schedule,");
    Serial.print(Pump_start_hour);
    Serial.print(",");
    Serial.print(Pump_start_min);
    Serial.print(",");
    
    if (Pump_start_isAM == true) {
      Serial.print("1,");
    } 
    else {
      Serial.print("0,");
    }
    Serial.print(Pump_every_hours);
    Serial.print(",");
    Serial.print(Pump_every_mins);
    Serial.print(",");
    Serial.print(Pump_for);
    Serial.print(",");
    Serial.println(Pump_times);
  }
 //******SETPOINTS****************  
  if (serialcounter == 4) {    

    //*****pH1    
    Serial.print("SetPoint_pH1,");
    Serial.print(pH1Value_Low);
    Serial.print(",");
    Serial.print(pH1Value_High);
    Serial.print(",");
    Serial.println(pH1_Status);
  }
  if (serialcounter == 5) { 

    //*****pH2    
    Serial.print("SetPoint_pH2,");
    Serial.print(pH2Value_Low);
    Serial.print(",");
    Serial.print(pH2Value_High);
    Serial.print(",");
    Serial.println(pH2_Status);
  }
  if (serialcounter == 6) { 

    //*****Temp   
    Serial.print("SetPoint_Temp,");
    Serial.print(TempValue_Low);
    Serial.print(",");
    Serial.print(TempValue_High);
    Serial.print(",");
    Serial.print(Heater_ON);
    Serial.print(",");
    Serial.print(Heater_OFF);
    Serial.print(",");
    Serial.print(AC_ON);
    Serial.print(",");
    Serial.print(AC_OFF);
    Serial.print(",");
    Serial.println(Temp_Status);
  } 
  if (serialcounter == 7) { 
 
    //*****RH    
    Serial.print("SetPoint_RH,");
    Serial.print(RHValue_Low);
    Serial.print(",");
    Serial.print(RHValue_High);
    Serial.print(",");
    Serial.print(Humidifier_ON);
    Serial.print(",");
    Serial.print(Humidifier_OFF);
    Serial.print(",");
    Serial.print(Dehumidifier_ON);
    Serial.print(",");
    Serial.print(Dehumidifier_OFF);
    Serial.print(",");        
    Serial.println(RH_Status);
  }
  if (serialcounter == 8) { 

    //*****TDS1    
    Serial.print("SetPoint_TDS1,");
    Serial.print(TDS1Value_Low);
    Serial.print(",");
    Serial.print(TDS1Value_High);
    Serial.print(",");
    Serial.print(NutePump1_ON);
    Serial.print(",");
    Serial.print(NutePump1_OFF);
    Serial.print(",");
    Serial.print(MixPump1_Enabled);
    Serial.print(",");
    Serial.println(TDS1_Status);
  }
  if (serialcounter == 9) { 

    //*****TDS2   
    Serial.print("SetPoint_TDS2,");
    Serial.print(TDS2Value_Low);
    Serial.print(",");
    Serial.print(TDS2Value_High);
    Serial.print(",");
    Serial.print(NutePump2_ON);
    Serial.print(",");
    Serial.print(NutePump2_OFF);
    Serial.print(",");
    Serial.print(MixPump2_Enabled);
    Serial.print(",");
    Serial.println(TDS2_Status);
  }
  if (serialcounter == 10) { 

   //*****CO2    
    Serial.print("SetPoint_CO2,");
    Serial.print(CO2Value_Low);
    Serial.print(",");
    Serial.print(CO2Value_High);
    Serial.print(",");
    Serial.print(CO2_ON);
    Serial.print(",");
    Serial.print(CO2_OFF);
    Serial.print(",");
    Serial.print(CO2_Enabled);
    Serial.print(",");
    Serial.println(CO2_Status);
  }
  if (serialcounter == 11) { 
 
    //*****Light   
    Serial.print("SetPoint_Light,");
    Serial.print(LightValue_Low);
    Serial.print(",");
    Serial.print(LightValue_High);
    Serial.print(",");
    Serial.println(Light_Status); 

  }
  if (serialcounter == 13) {    

    //*****Water    
    Serial.print("SetPoint_Water,");
    Serial.print(WaterValue_Low);
    Serial.print(",");
    Serial.print(WaterValue_High);
    Serial.print(",");
    Serial.println(Water_Status);
  }
  if (serialcounter == 14) { 

    //*****Tank Total    
    Serial.print("SetPoint_TankTotal,");
    Serial.print(TankTotalValue_Low);
    Serial.print(",");
    Serial.print(TankTotalValue_High);
    Serial.print(",");
    Serial.println(TankTotal_Status);
  }
  if (serialcounter == 15) { 

    //*****Tank 1   
    Serial.print("SetPoint_Tank1,");
    Serial.print(Tank1Value_Low);
    Serial.print(",");
    Serial.print(Tank1Value_High);
    Serial.print(",");
    Serial.print(Tank1Pump_ON);
    Serial.print(",");
    Serial.print(Tank1Pump_OFF);
    Serial.print(",");
    Serial.print(Tank1MixPump_Enabled);
    Serial.print(",");
    Serial.println(Tank1_Status);
  }
  if (serialcounter == 16) { 
 
    //*****Tank 2   
    Serial.print("SetPoint_Tank2,");
    Serial.print(Tank2Value_Low);
    Serial.print(",");
    Serial.print(Tank2Value_High);
    Serial.print(",");
    Serial.print(Tank2Pump_ON);
    Serial.print(",");
    Serial.print(Tank2Pump_OFF);
    Serial.print(",");
    Serial.print(Tank2MixPump_Enabled);
    Serial.print(",");
    Serial.println(Tank2_Status);
  }
  if (serialcounter == 17) { 

    //*****Tank 3    
    Serial.print("SetPoint_Tank3,");
    Serial.print(Tank3Value_Low);
    Serial.print(",");
    Serial.print(Tank3Value_High);
    Serial.print(",");
    Serial.print(Tank3Pump_ON);
    Serial.print(",");
    Serial.print(Tank3Pump_OFF);
    Serial.print(",");
    Serial.print(Tank3MixPump_Enabled);
    Serial.print(",");
    Serial.println(Tank3_Status);
  }
  if (serialcounter == 18) { 

    //*****Tank 4    
    Serial.print("SetPoint_Tank4,");
    Serial.print(Tank4Value_Low);
    Serial.print(",");
    Serial.print(Tank4Value_High);
    Serial.print(",");
    Serial.print(Tank4Pump_ON);
    Serial.print(",");
    Serial.print(Tank4Pump_OFF);
    Serial.print(",");
    Serial.print(Tank4MixPump_Enabled);
    Serial.print(",");
    Serial.println(Tank4_Status);
    serialcounter = 0;
  }
  if (serialcounter == 19) { 

    Serial.print("SetPoint_WaterTempP1,");
    Serial.print(WaterTempP1Value_Low);
    Serial.print(",");
    Serial.print(WaterTempP1Value_High);
    Serial.print(",");
    Serial.print(WaterTempP1Heater_ON);
    Serial.print(",");
    Serial.print(WaterTempP1Heater_OFF);
    Serial.print(",");
    Serial.print(WaterTempP1AC_ON);
    Serial.print(",");
    Serial.print(WaterTempP1AC_OFF);
    Serial.print(",");
    Serial.println(WaterTempP1_Status);

  }
  if (serialcounter == 20) { 

    Serial.print("SetPoint_WaterTempP2,");
    Serial.print(WaterTempP2Value_Low);
    Serial.print(",");
    Serial.print(WaterTempP2Value_High);
    Serial.print(",");
    Serial.print(WaterTempP2Heater_ON);
    Serial.print(",");
    Serial.print(WaterTempP2Heater_OFF);
    Serial.print(",");
    Serial.print(WaterTempP2AC_ON);
    Serial.print(",");
    Serial.print(WaterTempP2AC_OFF);
    Serial.print(",");
    Serial.println(WaterTempP2_Status);


  }
  if (serialcounter == 21) { 

    Serial.print("SetPoint_WaterTempP3,");
    Serial.print(WaterTempP3Value_Low);
    Serial.print(",");
    Serial.print(WaterTempP3Value_High);
    Serial.print(",");
    Serial.print(WaterTempP3Heater_ON);
    Serial.print(",");
    Serial.print(WaterTempP3Heater_OFF);
    Serial.print(",");
    Serial.print(WaterTempP3AC_ON);
    Serial.print(",");
    Serial.print(WaterTempP3AC_OFF);
    Serial.print(",");
    Serial.println(WaterTempP3_Status);

  }
  if (serialcounter == 22) { 

    Serial.print("SetPoint_WaterTempP4,");
    Serial.print(WaterTempP4Value_Low);
    Serial.print(",");
    Serial.print(WaterTempP4Value_High);
    Serial.print(",");
    Serial.print(WaterTempP4Heater_ON);
    Serial.print(",");
    Serial.print(WaterTempP4Heater_OFF);
    Serial.print(",");
    Serial.print(WaterTempP4AC_ON);
    Serial.print(",");
    Serial.print(WaterTempP4AC_OFF);
    Serial.print(",");
    Serial.println(WaterTempP4_Status);
    serialcounter = 0;
  }    
  serialcounter++;
}

/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!serialEvent!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
void serialEvent() {
  while (Serial.available() > 0) {
    // get the new byte:
    char inChar = (char)Serial.read(); 

    // if the incoming character is a newline, set a flag
    // so the main loop can do something about it:
    if (inChar == '\n') {
      stringComplete = true;
      Serial.println("Recieved String! '" + Serial_inString + "'");

      if (Serial_inString == "Relay1 on" && Relay1_isAuto == 0) {
        Relay1_State = 1;
        EEPROM.write(6,1);
        turnRelay(1, 1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay1 off" && Relay1_isAuto == 0) {
        Relay1_State = 0;
        EEPROM.write(6,0);
        turnRelay(1, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay2 on" && Relay2_isAuto == 0) {
        Relay2_State = 1;
        EEPROM.write(7,1);
        turnRelay(2, 1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay2 off" && Relay2_isAuto == 0) {
        Relay2_State = 0;
        EEPROM.write(7,0);
        turnRelay(2, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay3 on" && Relay3_isAuto == 0) {
        Relay3_State = 1;
        EEPROM.write(8,1);
        turnRelay(3, 1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay3 off" && Relay3_isAuto == 0) {
        Relay3_State = 0;
        EEPROM.write(8,0);
        turnRelay(3, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay4 on" && Relay4_isAuto == 0) {
        Relay4_State = 1;
        EEPROM.write(9,1);
        turnRelay(4, 1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay4 off" && Relay4_isAuto == 0) {
        Relay4_State = 0;
        EEPROM.write(9,0);
        turnRelay(4, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay5 on" && Relay5_isAuto == 0) {
        Relay5_State = 1;
        EEPROM.write(10,1);
        turnRelay(5, 1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay5 off" && Relay5_isAuto == 0) {
        Relay5_State = 0;
        EEPROM.write(10,0);
        turnRelay(5, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay6 on" && Relay6_isAuto == 0) {
        Relay6_State = 1;
        EEPROM.write(11,1);
        turnRelay(6, 1);
        sendRelayMessages();

      } 
      else if (Serial_inString == "Relay6 off" && Relay6_isAuto == 0) {
        Relay6_State = 0;
        EEPROM.write(11,0);
        turnRelay(6, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay7 on" && Relay7_isAuto == 0) {
        Relay7_State = 1;
        EEPROM.write(12,1);
        turnRelay(7, 1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay7 off" && Relay7_isAuto == 0) {
        Relay7_State = 0;
        EEPROM.write(12,0);
        turnRelay(7, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay8 on" && Relay8_isAuto == 0) {
        Relay8_State = 1;
        EEPROM.write(13,1);
        turnRelay(8, 1);
        sendRelayMessages();

      } 
      else if (Serial_inString == "Relay8 off" && Relay8_isAuto == 0) {
        Relay8_State = 0;
        EEPROM.write(13,0);
        turnRelay(8, 0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay1 isAuto 1") {
        Relay1_isAuto = 1;
        EEPROM.write(22,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay1 isAuto 0") {
        Relay1_isAuto = 0;
        EEPROM.write(22,0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay2 isAuto 1") {
        Relay2_isAuto = 1;
        EEPROM.write(23,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay2 isAuto 0") {
        Relay2_isAuto = 0;
        EEPROM.write(23,0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay3 isAuto 1") {
        Relay3_isAuto = 1;
        EEPROM.write(24,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay3 isAuto 0") {
        Relay3_isAuto = 0;
        EEPROM.write(24,0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay4 isAuto 1") {
        Relay4_isAuto = 1;
        EEPROM.write(25,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay4 isAuto 0") {
        Relay4_isAuto = 0;
        EEPROM.write(25,0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay5 isAuto 1") {
        Relay5_isAuto = 1;
        EEPROM.write(26,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay5 isAuto 0") {
        Relay5_isAuto = 0;
        EEPROM.write(26,0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay6 isAuto 1") {
        Relay6_isAuto = 1;
        EEPROM.write(27,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay6 isAuto 0") {
        Relay6_isAuto = 0;
        EEPROM.write(27,0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay7 isAuto 1") {
        Relay7_isAuto = 1;
        EEPROM.write(28,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay7 isAuto 0") {
        Relay7_isAuto = 0;
        EEPROM.write(28,0);
        sendRelayMessages();
      }
      if (Serial_inString == "Relay8 isAuto 1") {
        Relay8_isAuto = 1;
        EEPROM.write(29,1);
        sendRelayMessages();
      } 
      else if (Serial_inString == "Relay8 isAuto 0") {
        Relay8_isAuto = 0;
        EEPROM.write(29,0);
        sendRelayMessages();
      }
      if (Serial_inString == "restoredefaults") {
        RestoreDefaults();
      }    
      if(Serial_inString.indexOf("setdate") >=0) {
        //      Serial.println("YESSS");
        char datechar[Serial_inString.length()+1];
        Serial_inString.toCharArray(datechar, Serial_inString.length()+1);
        //      Serial.print("Char: ");
        //      Serial.println(datechar);
        int date[10];
        //      Serial.println(Serial_inString);
        //      Serial.print("Size: ");
        //      Serial.println(Serial_inString.length()+1);
        int i;
        String datestring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (datechar[i] == ',') {
            tmpBuffer.replace(",", "");
            datestring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            datestring[parsecount] = tmpBuffer;
          }
          tmpBuffer += datechar[i];
        }


        //      Serial.print("Split:");
        //      Serial.println(Serial_inString);
        //        
        //     
        //      Serial.println("Month");
        //      Serial.println(datestring[1]);
        //      Serial.println("Day");
        //      Serial.println(datestring[2]);
        //      Serial.println("Year");
        //      Serial.println(datestring[3]);
        //      Serial.println("Hour");
        //      Serial.println(datestring[4]);
        //      Serial.println("Min");
        //      Serial.println(datestring[5]);
        //      Serial.println("Sec");
        //      Serial.println(datestring[6]);
        //      
        int parsed_month = datestring[1].toInt();
        int parsed_day = datestring[2].toInt();
        int parsed_year = datestring[3].toInt();
        int parsed_hour = datestring[4].toInt();
        int parsed_minute = datestring[5].toInt();
        int parsed_second = datestring[6].toInt();

        EEPROM.write(0,parsed_hour);
        EEPROM.write(1,parsed_minute);
        EEPROM.write(2,parsed_second);
        EEPROM.write(3,parsed_day);
        EEPROM.write(4,parsed_month);
        EEPROM.write(5,parsed_year);
        setTime(parsed_hour,parsed_minute,parsed_second,parsed_day,parsed_month,parsed_year);   
        RTC.set(now());
      }
      if(Serial_inString.indexOf("setlightschedule") >=0) {
        //        Serial.println("setlightschedule");
        char lightschedulechar[Serial_inString.length()+1];
        Serial_inString.toCharArray(lightschedulechar, Serial_inString.length()+1);
        //        Serial.print("Char: ");
        //        Serial.println(lightschedulechar);
        int date[10];
        //        Serial.println(Serial_inString);
        //        Serial.print("Size: ");
        //        Serial.println(Serial_inString.length()+1);
        int i;
        String lightschedulestring[6];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (lightschedulechar[i] == ',') {
            tmpBuffer.replace(",", "");
            lightschedulestring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            lightschedulestring[parsecount] = tmpBuffer;
          }
          tmpBuffer += lightschedulechar[i];
        }


        //        Serial.print("Split:");
        //        Serial.println(Serial_inString);

        //        Serial.println("Light_ON_hour");
        //        Serial.println(lightschedulestring[1]);
        //        Serial.println("Light_ON_min");
        //        Serial.println(lightschedulestring[2]);
        //        Serial.println("Light_OFF_hour");
        //        Serial.println(lightschedulestring[3]);
        //        Serial.println("Light_OFF_min");
        //        Serial.println(lightschedulestring[4]);

        int parsed_Light_ON_hour = lightschedulestring[1].toInt();
        int parsed_Light_ON_min = lightschedulestring[2].toInt();
        int parsed_Light_OFF_hour = lightschedulestring[3].toInt();
        int parsed_Light_OFF_min = lightschedulestring[4].toInt();

        Light_ON_hour = parsed_Light_ON_hour;
        Light_ON_min = parsed_Light_ON_min;
        Light_OFF_hour = parsed_Light_OFF_hour;
        Light_OFF_min = parsed_Light_OFF_min;

        EEPROM.write(93, Light_ON_hour);
        EEPROM.write(94, Light_OFF_hour);
        EEPROM.write(95, Light_ON_min);
        EEPROM.write(96, Light_OFF_min);
      }
      if(Serial_inString.indexOf("setwateringschedule") >=0) {
        Serial.println("setwaterschedule");
        char waterschedulechar[Serial_inString.length()+1];
        Serial_inString.toCharArray(waterschedulechar, Serial_inString.length()+1);
        Serial.print("Char: ");
        Serial.println(waterschedulechar);
        int date[10];
        //        Serial.println(Serial_inString);
        //        Serial.print("Size: ");
        //        Serial.println(Serial_inString.length()+1);
        int i;
        String waterschedulestring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (waterschedulechar[i] == ',') {
            tmpBuffer.replace(",", "");
            waterschedulestring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            waterschedulestring[parsecount] = tmpBuffer;
          }
          tmpBuffer += waterschedulechar[i];
        }


        //          Serial.print("Split:");
        //          Serial.println(Serial_inString);

        //          Serial.println("Pump_start_hour");
        //          Serial.println(waterschedulestring[1]);
        //          Serial.println("Pump_start_min");
        //          Serial.println(waterschedulestring[2]);
        //          Serial.println("Pump_every_hours");
        //          Serial.println(waterschedulestring[3]);
        //          Serial.println("Pump_every_mins");
        //          Serial.println(waterschedulestring[4]);
        //          Serial.println("Pump_for");
        //          Serial.println(waterschedulestring[5]);
        //          Serial.println("Pump_times");
        //          Serial.println(waterschedulestring[6]);

        int parsed_Pump_start_hour = waterschedulestring[1].toInt();
        int parsed_Pump_start_min = waterschedulestring[2].toInt();
        int parsed_Pump_every_hours = waterschedulestring[3].toInt();
        int parsed_Pump_every_mins = waterschedulestring[4].toInt();
        int parsed_Pump_for = waterschedulestring[5].toInt();
        int parsed_Pump_times = waterschedulestring[6].toInt();

        Pump_start_hour = parsed_Pump_start_hour;
        Pump_start_min = parsed_Pump_start_min;
        Pump_every_hours = parsed_Pump_every_hours;
        Pump_every_mins = parsed_Pump_every_mins;
        Pump_for = parsed_Pump_for;
        Pump_times = parsed_Pump_times;

        EEPROM.write(38,Pump_start_hour);
        EEPROM.write(39,Pump_start_min);
        EEPROM.write(40,Pump_every_hours);
        EEPROM.write(41,Pump_every_mins);
        EEPROM.write(42,Pump_for);
        EEPROM.write(43,Pump_times);

        FillPumpTimesArrays(Pump_start_hour, Pump_start_min, Pump_every_hours, Pump_every_mins, Pump_for, Pump_times);

        i = 0;
        for(i = 0; i < Pump_times; i++){
          Pump_hour_array[i]=  tmp_Pump_hour_array[i];
          Pump_min_array[i] = tmp_Pump_min_array[i];
          Pump_isAM_array[i] = tmp_Pump_isAM_array[i];
          EEPROM.write((i+44),Pump_hour_array[i]);
          EEPROM.write((i+60),Pump_min_array[i]);
          EEPROM.write((i+76),Pump_isAM_array[i]);
        }



      }
      if(Serial_inString.indexOf("setpH1") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[3];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }
        char char_pH1Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_pH1Value_Low, sizeof(char_pH1Value_Low));
        float parsed_pH1Value_Low = atof(char_pH1Value_Low);

        char char_pH1Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_pH1Value_High, sizeof(char_pH1Value_High));
        float parsed_pH1Value_High = atof(char_pH1Value_High);

        pH1Value_Low = parsed_pH1Value_Low;
        pH1Value_High = parsed_pH1Value_High;

        eepromWriteFloat(113, parsed_pH1Value_Low);
        eepromWriteFloat(117, parsed_pH1Value_High);  

      }
      if(Serial_inString.indexOf("setpH2") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[3];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
             tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }
        char char_pH2Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_pH2Value_Low, sizeof(char_pH2Value_Low));
        float parsed_pH2Value_Low = atof(char_pH2Value_Low);

        char char_pH2Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_pH2Value_High, sizeof(char_pH2Value_High));
        float parsed_pH2Value_High = atof(char_pH2Value_High);

        pH2Value_Low = parsed_pH2Value_Low;
        pH2Value_High = parsed_pH2Value_High;

        eepromWriteFloat(121, parsed_pH2Value_Low);
        eepromWriteFloat(125, parsed_pH2Value_High);  

      }
      if(Serial_inString.indexOf("setTemp") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_TempValue_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_TempValue_Low, sizeof(char_TempValue_Low));
        float parsed_TempValue_Low = atof(char_TempValue_Low);

        char char_TempValue_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_TempValue_High, sizeof(char_TempValue_High));
        float parsed_TempValue_High = atof(char_TempValue_High);

        char char_Heater_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_Heater_ON, sizeof(char_Heater_ON));
        float parsed_Heater_ON = atof(char_Heater_ON);

        char char_Heater_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_Heater_OFF, sizeof(char_Heater_OFF));
        float parsed_Heater_OFF = atof(char_Heater_OFF);

        char char_AC_ON[splitstring[5].length() + 1];
        splitstring[5].toCharArray(char_AC_ON, sizeof(char_AC_ON));
        float parsed_AC_ON = atof(char_AC_ON);

        char char_AC_OFF[splitstring[6].length() + 1];
        splitstring[6].toCharArray(char_AC_OFF, sizeof(char_AC_OFF));
        float parsed_AC_OFF = atof(char_AC_OFF);

        TempValue_Low = parsed_TempValue_Low;
        TempValue_High = parsed_TempValue_High;
        Heater_ON = parsed_Heater_ON;
        Heater_OFF = parsed_Heater_OFF;
        AC_ON = parsed_AC_ON;
        AC_OFF = parsed_AC_OFF;

        eepromWriteFloat(129, parsed_TempValue_Low);
        eepromWriteFloat(133, parsed_TempValue_High);  
        eepromWriteFloat(137, parsed_Heater_ON);
        eepromWriteFloat(141, parsed_Heater_OFF);  
        eepromWriteFloat(145, parsed_AC_ON);
        eepromWriteFloat(149, parsed_AC_OFF);  

      }
      if(Serial_inString.indexOf("setWaterTempP1") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_WaterTempP1Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_WaterTempP1Value_Low, sizeof(char_WaterTempP1Value_Low));
        float parsed_WaterTempP1Value_Low = atof(char_WaterTempP1Value_Low);

        char char_WaterTempP1Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_WaterTempP1Value_High, sizeof(char_WaterTempP1Value_High));
        float parsed_WaterTempP1Value_High = atof(char_WaterTempP1Value_High);

        char char_WaterTempP1Heater_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_WaterTempP1Heater_ON, sizeof(char_WaterTempP1Heater_ON));
        float parsed_WaterTempP1Heater_ON = atof(char_WaterTempP1Heater_ON);

        char char_WaterTempP1Heater_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_WaterTempP1Heater_OFF, sizeof(char_WaterTempP1Heater_OFF));
        float parsed_WaterTempP1Heater_OFF = atof(char_WaterTempP1Heater_OFF);

        char char_WaterTempP1AC_ON[splitstring[5].length() + 1];
        splitstring[5].toCharArray(char_WaterTempP1AC_ON, sizeof(char_WaterTempP1AC_ON));
        float parsed_WaterTempP1AC_ON = atof(char_WaterTempP1AC_ON);

        char char_WaterTempP1AC_OFF[splitstring[6].length() + 1];
        splitstring[6].toCharArray(char_WaterTempP1AC_OFF, sizeof(char_WaterTempP1AC_OFF));
        float parsed_WaterTempP1AC_OFF = atof(char_WaterTempP1AC_OFF);

        WaterTempP1Value_Low = parsed_WaterTempP1Value_Low;
        WaterTempP1Value_High = parsed_WaterTempP1Value_High;
        WaterTempP1Heater_ON = parsed_WaterTempP1Heater_ON;
        WaterTempP1Heater_OFF = parsed_WaterTempP1Heater_OFF;
        WaterTempP1AC_ON = parsed_WaterTempP1AC_ON;
        WaterTempP1AC_OFF = parsed_WaterTempP1AC_OFF;

        eepromWriteFloat(500, parsed_WaterTempP1Value_Low);
        eepromWriteFloat(504, parsed_WaterTempP1Value_High);  
        eepromWriteFloat(508, parsed_WaterTempP1Heater_ON);
        eepromWriteFloat(512, parsed_WaterTempP1Heater_OFF);  
        eepromWriteFloat(516, parsed_WaterTempP1AC_ON);
        eepromWriteFloat(520, parsed_WaterTempP1AC_OFF);  

      }
      if(Serial_inString.indexOf("setWaterTempP2") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_WaterTempP2Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_WaterTempP2Value_Low, sizeof(char_WaterTempP2Value_Low));
        float parsed_WaterTempP2Value_Low = atof(char_WaterTempP2Value_Low);

        char char_WaterTempP2Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_WaterTempP2Value_High, sizeof(char_WaterTempP2Value_High));
        float parsed_WaterTempP2Value_High = atof(char_WaterTempP2Value_High);

        char char_WaterTempP2Heater_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_WaterTempP2Heater_ON, sizeof(char_WaterTempP2Heater_ON));
        float parsed_WaterTempP2Heater_ON = atof(char_WaterTempP2Heater_ON);

        char char_WaterTempP2Heater_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_WaterTempP2Heater_OFF, sizeof(char_WaterTempP2Heater_OFF));
        float parsed_WaterTempP2Heater_OFF = atof(char_WaterTempP2Heater_OFF);

        char char_WaterTempP2AC_ON[splitstring[5].length() + 1];
        splitstring[5].toCharArray(char_WaterTempP2AC_ON, sizeof(char_WaterTempP2AC_ON));
        float parsed_WaterTempP2AC_ON = atof(char_WaterTempP2AC_ON);

        char char_WaterTempP2AC_OFF[splitstring[6].length() + 1];
        splitstring[6].toCharArray(char_WaterTempP2AC_OFF, sizeof(char_WaterTempP2AC_OFF));
        float parsed_WaterTempP2AC_OFF = atof(char_WaterTempP2AC_OFF);

        WaterTempP2Value_Low = parsed_WaterTempP2Value_Low;
        WaterTempP2Value_High = parsed_WaterTempP2Value_High;
        WaterTempP2Heater_ON = parsed_WaterTempP2Heater_ON;
        WaterTempP2Heater_OFF = parsed_WaterTempP2Heater_OFF;
        WaterTempP2AC_ON = parsed_WaterTempP2AC_ON;
        WaterTempP2AC_OFF = parsed_WaterTempP2AC_OFF;

        eepromWriteFloat(524, parsed_WaterTempP2Value_Low);
        eepromWriteFloat(528, parsed_WaterTempP2Value_High);  
        eepromWriteFloat(532, parsed_WaterTempP2Heater_ON);
        eepromWriteFloat(536, parsed_WaterTempP2Heater_OFF);  
        eepromWriteFloat(540, parsed_WaterTempP2AC_ON);
        eepromWriteFloat(544, parsed_WaterTempP2AC_OFF);  

      }
      if(Serial_inString.indexOf("setWaterTempP3") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_WaterTempP3Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_WaterTempP3Value_Low, sizeof(char_WaterTempP3Value_Low));
        float parsed_WaterTempP3Value_Low = atof(char_WaterTempP3Value_Low);

        char char_WaterTempP3Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_WaterTempP3Value_High, sizeof(char_WaterTempP3Value_High));
        float parsed_WaterTempP3Value_High = atof(char_WaterTempP3Value_High);

        char char_WaterTempP3Heater_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_WaterTempP3Heater_ON, sizeof(char_WaterTempP3Heater_ON));
        float parsed_WaterTempP3Heater_ON = atof(char_WaterTempP3Heater_ON);

        char char_WaterTempP3Heater_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_WaterTempP3Heater_OFF, sizeof(char_WaterTempP3Heater_OFF));
        float parsed_WaterTempP3Heater_OFF = atof(char_WaterTempP3Heater_OFF);

        char char_WaterTempP3AC_ON[splitstring[5].length() + 1];
        splitstring[5].toCharArray(char_WaterTempP3AC_ON, sizeof(char_WaterTempP3AC_ON));
        float parsed_WaterTempP3AC_ON = atof(char_WaterTempP3AC_ON);

        char char_WaterTempP3AC_OFF[splitstring[6].length() + 1];
        splitstring[6].toCharArray(char_WaterTempP3AC_OFF, sizeof(char_WaterTempP3AC_OFF));
        float parsed_WaterTempP3AC_OFF = atof(char_WaterTempP3AC_OFF);

        WaterTempP3Value_Low = parsed_WaterTempP3Value_Low;
        WaterTempP3Value_High = parsed_WaterTempP3Value_High;
        WaterTempP3Heater_ON = parsed_WaterTempP3Heater_ON;
        WaterTempP3Heater_OFF = parsed_WaterTempP3Heater_OFF;
        WaterTempP3AC_ON = parsed_WaterTempP3AC_ON;
        WaterTempP3AC_OFF = parsed_WaterTempP3AC_OFF;

        eepromWriteFloat(548, parsed_WaterTempP3Value_Low);
        eepromWriteFloat(552, parsed_WaterTempP3Value_High);  
        eepromWriteFloat(556, parsed_WaterTempP3Heater_ON);
        eepromWriteFloat(560, parsed_WaterTempP3Heater_OFF);  
        eepromWriteFloat(564, parsed_WaterTempP3AC_ON);
        eepromWriteFloat(568, parsed_WaterTempP3AC_OFF);  

      }
      if(Serial_inString.indexOf("setWaterTempP4") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_WaterTempP4Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_WaterTempP4Value_Low, sizeof(char_WaterTempP4Value_Low));
        float parsed_WaterTempP4Value_Low = atof(char_WaterTempP4Value_Low);

        char char_WaterTempP4Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_WaterTempP4Value_High, sizeof(char_WaterTempP4Value_High));
        float parsed_WaterTempP4Value_High = atof(char_WaterTempP4Value_High);

        char char_WaterTempP4Heater_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_WaterTempP4Heater_ON, sizeof(char_WaterTempP4Heater_ON));
        float parsed_WaterTempP4Heater_ON = atof(char_WaterTempP4Heater_ON);

        char char_WaterTempP4Heater_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_WaterTempP4Heater_OFF, sizeof(char_WaterTempP4Heater_OFF));
        float parsed_WaterTempP4Heater_OFF = atof(char_WaterTempP4Heater_OFF);

        char char_WaterTempP4AC_ON[splitstring[5].length() + 1];
        splitstring[5].toCharArray(char_WaterTempP4AC_ON, sizeof(char_WaterTempP4AC_ON));
        float parsed_WaterTempP4AC_ON = atof(char_WaterTempP4AC_ON);

        char char_WaterTempP4AC_OFF[splitstring[6].length() + 1];
        splitstring[6].toCharArray(char_WaterTempP4AC_OFF, sizeof(char_WaterTempP4AC_OFF));
        float parsed_WaterTempP4AC_OFF = atof(char_WaterTempP4AC_OFF);

        WaterTempP4Value_Low = parsed_WaterTempP4Value_Low;
        WaterTempP4Value_High = parsed_WaterTempP4Value_High;
        WaterTempP4Heater_ON = parsed_WaterTempP4Heater_ON;
        WaterTempP4Heater_OFF = parsed_WaterTempP4Heater_OFF;
        WaterTempP4AC_ON = parsed_WaterTempP4AC_ON;
        WaterTempP4AC_OFF = parsed_WaterTempP4AC_OFF;

        eepromWriteFloat(572, parsed_WaterTempP4Value_Low);
        eepromWriteFloat(576, parsed_WaterTempP4Value_High);  
        eepromWriteFloat(580, parsed_WaterTempP4Heater_ON);
        eepromWriteFloat(584, parsed_WaterTempP4Heater_OFF);  
        eepromWriteFloat(588, parsed_WaterTempP4AC_ON);
        eepromWriteFloat(592, parsed_WaterTempP4AC_OFF);  

      } 
      if(Serial_inString.indexOf("setRH") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[7];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_RHValue_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_RHValue_Low, sizeof(char_RHValue_Low));
        float parsed_RHValue_Low = atof(char_RHValue_Low);

        char char_RHValue_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_RHValue_High, sizeof(char_RHValue_High));
        float parsed_RHValue_High = atof(char_RHValue_High);

        char char_Humidifier_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_Humidifier_ON, sizeof(char_Humidifier_ON));
        float parsed_Humidifier_ON = atof(char_Humidifier_ON);

        char char_Humidifier_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_Humidifier_OFF, sizeof(char_Humidifier_OFF));
        float parsed_Humidifier_OFF = atof(char_Humidifier_OFF);

        char char_Dehumidifier_ON[splitstring[5].length() + 1];
        splitstring[5].toCharArray(char_Dehumidifier_ON, sizeof(char_Dehumidifier_ON));
        float parsed_Dehumidifier_ON = atof(char_Dehumidifier_ON);

        char char_Dehumidifier_OFF[splitstring[6].length() + 1];
        splitstring[6].toCharArray(char_Dehumidifier_OFF, sizeof(char_Dehumidifier_OFF));
        float parsed_Dehumidifier_OFF = atof(char_Dehumidifier_OFF);

        RHValue_Low = parsed_RHValue_Low;
        RHValue_High = parsed_RHValue_High;
        Humidifier_ON = parsed_Humidifier_ON;
        Humidifier_OFF = parsed_Humidifier_OFF;
        Dehumidifier_ON = parsed_Dehumidifier_ON;
        Dehumidifier_OFF = parsed_Dehumidifier_OFF;

        eepromWriteFloat(153, parsed_RHValue_Low);
        eepromWriteFloat(157, parsed_RHValue_High);  
        eepromWriteFloat(161, parsed_Humidifier_ON);
        eepromWriteFloat(165, parsed_Humidifier_OFF);  
        eepromWriteFloat(169, parsed_Dehumidifier_ON);
        eepromWriteFloat(173, parsed_Dehumidifier_OFF);  

      }
      if(Serial_inString.indexOf("setTDS1") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[6];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_TDS1Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_TDS1Value_Low, sizeof(char_TDS1Value_Low));
        float parsed_TDS1Value_Low = atof(char_TDS1Value_Low);

        char char_TDS1Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_TDS1Value_High, sizeof(char_TDS1Value_High));
        float parsed_TDS1Value_High = atof(char_TDS1Value_High);

        char char_NutePump1_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_NutePump1_ON, sizeof(char_NutePump1_ON));
        float parsed_NutePump1_ON = atof(char_NutePump1_ON);

        char char_NutePump1_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_NutePump1_OFF, sizeof(char_NutePump1_OFF));
        float parsed_NutePump1_OFF = atof(char_NutePump1_OFF);

        int parsed_MixPump1_Enabled = splitstring[5].toInt();

        TDS1Value_Low = parsed_TDS1Value_Low;
        TDS1Value_High = parsed_TDS1Value_High;
        NutePump1_ON = parsed_NutePump1_ON;
        NutePump1_OFF = parsed_NutePump1_OFF;

        if (parsed_MixPump1_Enabled == 1) {
          MixPump1_Enabled = true;
          EEPROM.write(193, 1);
        } 
        else if(parsed_MixPump1_Enabled == 0) {
          MixPump1_Enabled = false;
          EEPROM.write(193, 0);            
        }

        eepromWriteFloat(177, parsed_TDS1Value_Low);
        eepromWriteFloat(181, parsed_TDS1Value_High);  
        eepromWriteFloat(185, parsed_NutePump1_ON);
        eepromWriteFloat(189, parsed_NutePump1_OFF);  

      }
      if(Serial_inString.indexOf("setTDS2") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[6];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_TDS2Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_TDS2Value_Low, sizeof(char_TDS2Value_Low));
        float parsed_TDS2Value_Low = atof(char_TDS2Value_Low);

        char char_TDS2Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_TDS2Value_High, sizeof(char_TDS2Value_High));
        float parsed_TDS2Value_High = atof(char_TDS2Value_High);

        char char_NutePump2_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_NutePump2_ON, sizeof(char_NutePump2_ON));
        float parsed_NutePump2_ON = atof(char_NutePump2_ON);

        char char_NutePump2_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_NutePump2_OFF, sizeof(char_NutePump2_OFF));
        float parsed_NutePump2_OFF = atof(char_NutePump2_OFF);

        int parsed_MixPump2_Enabled = splitstring[5].toInt();

        TDS2Value_Low = parsed_TDS2Value_Low;
        TDS2Value_High = parsed_TDS2Value_High;
        NutePump2_ON = parsed_NutePump2_ON;
        NutePump2_OFF = parsed_NutePump2_OFF;

        if (parsed_MixPump2_Enabled == 1) {
          MixPump2_Enabled = true;
          EEPROM.write(208, 1);
        } 
        else if(parsed_MixPump2_Enabled == 0) {
          MixPump2_Enabled = false;
          EEPROM.write(208, 0);            
        }

        eepromWriteFloat(194, parsed_TDS2Value_Low);
        eepromWriteFloat(198, parsed_TDS2Value_High);  
        eepromWriteFloat(202, parsed_NutePump2_ON);
        eepromWriteFloat(206, parsed_NutePump2_OFF);  

      }
      if(Serial_inString.indexOf("setCO2") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[5];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_CO2Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_CO2Value_Low, sizeof(char_CO2Value_Low));
        float parsed_CO2Value_Low = atof(char_CO2Value_Low);

        char char_CO2Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_CO2Value_High, sizeof(char_CO2Value_High));
        float parsed_CO2Value_High = atof(char_CO2Value_High);

        char char_CO2_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_CO2_ON, sizeof(char_CO2_ON));
        float parsed_CO2_ON = atof(char_CO2_ON);

        char char_CO2_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_CO2_OFF, sizeof(char_CO2_OFF));
        float parsed_CO2_OFF = atof(char_CO2_OFF);

        int parsed_CO2_Enabled = splitstring[5].toInt();

        if (parsed_CO2_Enabled == 1) {
          CO2_Enabled = true;
          EEPROM.write(227, 1);
        } 
        else if(parsed_CO2_Enabled == 0) {
          CO2_Enabled = false;
          EEPROM.write(227, 0);            
        }

        CO2Value_Low = parsed_CO2Value_Low;
        CO2Value_High = parsed_CO2Value_High;
        CO2_ON = parsed_CO2_ON;
        CO2_OFF = parsed_CO2_OFF;


        eepromWriteFloat(211, parsed_CO2Value_Low);
        eepromWriteFloat(215, parsed_CO2Value_High);  
        eepromWriteFloat(219, parsed_CO2_ON);
        eepromWriteFloat(223, parsed_CO2_OFF);  

      }
      if(Serial_inString.indexOf("setLight") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[3];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_LightValue_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_LightValue_Low, sizeof(char_LightValue_Low));
        float parsed_LightValue_Low = atof(char_LightValue_Low);

        char char_LightValue_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_LightValue_High, sizeof(char_LightValue_High));
        float parsed_LightValue_High = atof(char_LightValue_High);


        LightValue_Low = parsed_LightValue_Low;
        LightValue_High = parsed_LightValue_High;

        eepromWriteFloat(228, parsed_LightValue_Low);
        eepromWriteFloat(232, parsed_LightValue_High);  

      }
      if(Serial_inString.indexOf("setTank1") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[6];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_Tank1Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_Tank1Value_Low, sizeof(char_Tank1Value_Low));
        float parsed_Tank1Value_Low = atof(char_Tank1Value_Low);

        char char_Tank1Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_Tank1Value_High, sizeof(char_Tank1Value_High));
        float parsed_Tank1Value_High = atof(char_Tank1Value_High);

        char char_Tank1Pump_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_Tank1Pump_ON, sizeof(char_Tank1Pump_ON));
        float parsed_Tank1Pump_ON = atof(char_Tank1Pump_ON);

        char char_Tank1Pump_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_Tank1Pump_OFF, sizeof(char_Tank1Pump_OFF));
        
        float parsed_Tank1Pump_OFF = atof(char_Tank1Pump_OFF);
        int parsed_Tank1MixPump_Enabled = splitstring[5].toInt();

        Tank1Value_Low = parsed_Tank1Value_Low;
        Tank1Value_High = parsed_Tank1Value_High;
        Tank1Pump_ON = parsed_Tank1Pump_ON;
        Tank1Pump_OFF = parsed_Tank1Pump_OFF;

        if (parsed_Tank1MixPump_Enabled == 1) {
          Tank1MixPump_Enabled = true;
          EEPROM.write(252, 1);
        } 
        else if(parsed_Tank1MixPump_Enabled == 0) {
         Tank1MixPump_Enabled = false;
          EEPROM.write(252, 0);            
        }

        eepromWriteFloat(236, parsed_Tank1Value_Low);
        eepromWriteFloat(240, parsed_Tank1Value_High);  
        eepromWriteFloat(244, parsed_Tank1Pump_ON);
        eepromWriteFloat(248, parsed_Tank1Pump_OFF);  

      }
      if(Serial_inString.indexOf("setTank2") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[6];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_Tank2Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_Tank2Value_Low, sizeof(char_Tank2Value_Low));
        float parsed_Tank2Value_Low = atof(char_Tank2Value_Low);

        char char_Tank2Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_Tank2Value_High, sizeof(char_Tank2Value_High));
        float parsed_Tank2Value_High = atof(char_Tank2Value_High);

        char char_Tank2Pump_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_Tank2Pump_ON, sizeof(char_Tank2Pump_ON));
        float parsed_Tank2Pump_ON = atof(char_Tank2Pump_ON);

        char char_Tank2Pump_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_Tank2Pump_OFF, sizeof(char_Tank2Pump_OFF));
        
        float parsed_Tank2Pump_OFF = atof(char_Tank2Pump_OFF);
        int parsed_Tank2MixPump_Enabled = splitstring[5].toInt();

        Tank2Value_Low = parsed_Tank2Value_Low;
        Tank2Value_High = parsed_Tank2Value_High;
        Tank2Pump_ON = parsed_Tank2Pump_ON;
        Tank2Pump_OFF = parsed_Tank2Pump_OFF;

        if (parsed_Tank2MixPump_Enabled == 1) {
          Tank2MixPump_Enabled = true;
          EEPROM.write(269, 1);
        } 
        else if(parsed_Tank2MixPump_Enabled == 0) {
         Tank2MixPump_Enabled = false;
          EEPROM.write(269, 0);            
        }

        eepromWriteFloat(253, parsed_Tank2Value_Low);
        eepromWriteFloat(257, parsed_Tank2Value_High);  
        eepromWriteFloat(261, parsed_Tank2Pump_ON);
        eepromWriteFloat(265, parsed_Tank2Pump_OFF);  

      }
      if(Serial_inString.indexOf("setTank3") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[6];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_Tank3Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_Tank3Value_Low, sizeof(char_Tank3Value_Low));
        float parsed_Tank3Value_Low = atof(char_Tank3Value_Low);

        char char_Tank3Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_Tank3Value_High, sizeof(char_Tank3Value_High));
        float parsed_Tank3Value_High = atof(char_Tank3Value_High);

        char char_Tank3Pump_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_Tank3Pump_ON, sizeof(char_Tank3Pump_ON));
        float parsed_Tank3Pump_ON = atof(char_Tank3Pump_ON);

        char char_Tank3Pump_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_Tank3Pump_OFF, sizeof(char_Tank3Pump_OFF));
        
        float parsed_Tank3Pump_OFF = atof(char_Tank3Pump_OFF);
        int parsed_Tank3MixPump_Enabled = splitstring[5].toInt();

        Tank3Value_Low = parsed_Tank3Value_Low;
        Tank3Value_High = parsed_Tank3Value_High;
        Tank3Pump_ON = parsed_Tank3Pump_ON;
        Tank3Pump_OFF = parsed_Tank3Pump_OFF;

        if (parsed_Tank3MixPump_Enabled == 1) {
          Tank3MixPump_Enabled = true;
          EEPROM.write(286, 1);
        } 
        else if(parsed_Tank3MixPump_Enabled == 0) {
         Tank3MixPump_Enabled = false;
          EEPROM.write(286, 0);            
        }

        eepromWriteFloat(270, parsed_Tank3Value_Low);
        eepromWriteFloat(274, parsed_Tank3Value_High);  
        eepromWriteFloat(278, parsed_Tank3Pump_ON);
        eepromWriteFloat(282, parsed_Tank3Pump_OFF);  

      }
      if(Serial_inString.indexOf("setTank4") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[6];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }

        char char_Tank4Value_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_Tank4Value_Low, sizeof(char_Tank4Value_Low));
        float parsed_Tank4Value_Low = atof(char_Tank4Value_Low);

        char char_Tank4Value_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_Tank4Value_High, sizeof(char_Tank4Value_High));
        float parsed_Tank4Value_High = atof(char_Tank4Value_High);

        char char_Tank4Pump_ON[splitstring[3].length() + 1];
        splitstring[3].toCharArray(char_Tank4Pump_ON, sizeof(char_Tank4Pump_ON));
        float parsed_Tank4Pump_ON = atof(char_Tank4Pump_ON);

        char char_Tank4Pump_OFF[splitstring[4].length() + 1];
        splitstring[4].toCharArray(char_Tank4Pump_OFF, sizeof(char_Tank4Pump_OFF));
        
        float parsed_Tank4Pump_OFF = atof(char_Tank4Pump_OFF);
        int parsed_Tank4MixPump_Enabled = splitstring[5].toInt();

        Tank4Value_Low = parsed_Tank4Value_Low;
        Tank4Value_High = parsed_Tank4Value_High;
        Tank4Pump_ON = parsed_Tank4Pump_ON;
        Tank4Pump_OFF = parsed_Tank4Pump_OFF;

        if (parsed_Tank4MixPump_Enabled == 1) {
          Tank4MixPump_Enabled = true;
          EEPROM.write(303, 1);
        } 
        else if(parsed_Tank4MixPump_Enabled == 0) {
         Tank4MixPump_Enabled = false;
          EEPROM.write(303, 0);            
        }

        eepromWriteFloat(287, parsed_Tank4Value_Low);
        eepromWriteFloat(291, parsed_Tank4Value_High);  
        eepromWriteFloat(295, parsed_Tank4Pump_ON);
        eepromWriteFloat(299, parsed_Tank4Pump_OFF);  

      }
      if(Serial_inString.indexOf("setTankTotal") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[3];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
             tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }
        char char_TankTotalValue_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_TankTotalValue_Low, sizeof(char_TankTotalValue_Low));
        float parsed_TankTotalValue_Low = atof(char_TankTotalValue_Low);

        char char_TankTotalValue_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_TankTotalValue_High, sizeof(char_TankTotalValue_High));
        float parsed_TankTotalValue_High = atof(char_TankTotalValue_High);

        TankTotalValue_Low = parsed_TankTotalValue_Low;
        TankTotalValue_High = parsed_TankTotalValue_High;

        eepromWriteFloat(304, parsed_TankTotalValue_Low);
        eepromWriteFloat(308, parsed_TankTotalValue_High);  

      }
      if(Serial_inString.indexOf("setWater") >=0) {
        char serialchar[Serial_inString.length()+1];
        Serial_inString.toCharArray(serialchar, Serial_inString.length()+1);

        int i;
        String splitstring[3];
        String tmpBuffer;
        int parsecount = 0;
        for (i=0;i<(Serial_inString.length()+1);i++){
          if (serialchar[i] == ',') {
            tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
            tmpBuffer = "";
            parsecount++;
          }
          if (i == Serial_inString.length()){
             tmpBuffer.replace(",", "");
            splitstring[parsecount] = tmpBuffer;
          }
          tmpBuffer += serialchar[i];
        }
        char char_WaterValue_Low[splitstring[1].length() + 1];
        splitstring[1].toCharArray(char_WaterValue_Low, sizeof(char_WaterValue_Low));
        float parsed_WaterValue_Low = atof(char_WaterValue_Low);

        char char_WaterValue_High[splitstring[2].length() + 1];
        splitstring[2].toCharArray(char_WaterValue_High, sizeof(char_WaterValue_High));
        float parsed_WaterValue_High = atof(char_WaterValue_High);

        WaterValue_Low = parsed_WaterValue_Low;
        WaterValue_High = parsed_WaterValue_High;

        eepromWriteFloat(312, parsed_WaterValue_Low);
        eepromWriteFloat(316, parsed_WaterValue_High);  
      }


      Serial_inString = "";
      serialcounter = 1;
      sendserialmessages();
    } 
    else {
      // add it to the inputString:
      Serial_inString += inChar;  
    }
  }
}


