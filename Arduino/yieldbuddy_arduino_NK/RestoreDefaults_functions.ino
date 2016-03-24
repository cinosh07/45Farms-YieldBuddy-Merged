/*
  /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  /!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!RESTORE DEFAULTS!!
  /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/
void RestoreDefaults() {

  //Temporary placeholders for Time Settings Screen
  tmp_month = 3;
  tmp_day = 14;
  tmp_year = 2015;
  tmp_hour = 9;
  tmp_minute = 26;
  tmp_second = 53;

  //Note: Committed Time Settings are stored as their associated month(), day(), year(), etc... as per <Time.h>

  tmp_Light_ON_hour = 12;
  tmp_Light_ON_min = 0;
  tmp_Light_OFF_hour = 23;
  tmp_Light_OFF_min = 59;

  //Committed Light Settings
  Light_ON_hour = 12;
  Light_ON_min = 0;
  Light_OFF_hour = 23;
  Light_OFF_min = 59;

  //Temporary placeholders for Pump Schedule Screen
  tmp_Pump_start_hour = 11;
  tmp_Pump_start_min = 45;
  tmp_Pump_start_isAM = true;
  tmp_Pump_every_hours = 2;
  tmp_Pump_every_mins = 30;
  tmp_Pump_for = 15; //In Minutes
  tmp_Pump_times = 1; //Number of times per day

  //Committed Pump Schedule Settings
  Pump_start_hour = 11;
  Pump_start_min = 45;
  Pump_start_isAM = true;
  Pump_every_hours = 2;
  Pump_every_mins = 30;
  Pump_for = 15; //In Minutes
  Pump_times = 1; //Number of times per day

  //SENSOR VARIABLES

  //Values the arduino sees
  pH1RawValue = 0;
  pH2RawValue = 0;
  TempRawValue = 0;
  RHRawValue = 0;
  TDS1RawValue = 0;
  TDS2RawValue = 0;
  CO2RawValue = 0;
  LightRawValue = 0;
  WaterRawValue = 0;
  
  // added ultrasonic tank sensors
  Tank1RawValue = 0;
  Tank2RawValue = 0;
  Tank3RawValue = 0;
  Tank4RawValue = 0;
  TankTotalRawValue = 0;

  //Values the humans see
  pH1Value = 0;
  pH2Value = 0;
  TempValue = 0;
  RHValue = 0;
  TDS1Value = 0;
  TDS2Value = 0;
  CO2Value = 0;
  LightValue = 0;
  WaterValue = 0;
  
  // added ultrasonic tank sensors
  Tank1Value = 0;
  Tank2Value = 0;
  Tank3Value = 0;
  Tank4Value = 0;
  TankTotalValue = 0;

  // STATUS INDICATOR VALUES

  //Tank 1
  Tank1_Status = "OK";
  Tank1Value_Low = 50.00;
  Tank1Value_High = 200.00;
  //Accessory ON/OFF Values
  Tank1Pump_ON = 200.00;
  Tank1Pump_OFF = 190.00;
  Tank1MixPump_Enabled = true;

  //Tank 2
  Tank2_Status = "OK";
  Tank2Value_Low = 50.00;
  Tank2Value_High = 200.00;
  //Accessory ON/OFF Values
  Tank2Pump_ON = 200.00;
  Tank2Pump_OFF = 190.00;
  Tank2MixPump_Enabled = true;

  //Tank 3
  Tank3_Status = "OK";
  Tank3Value_Low = 50.00;
  Tank3Value_High = 200.00;
  //Accessory ON/OFF Values
  Tank3Pump_ON = 200.00;
  Tank3Pump_OFF = 190.00;
  Tank3MixPump_Enabled = true;

  //Tank 4
  Tank4_Status = "OK";
  Tank4Value_Low = 50.00;
  Tank4Value_High = 200.00;
  //Accessory ON/OFF Values
  Tank4Pump_ON = 200.00;
  Tank4Pump_OFF = 190.00;
  Tank4MixPump_Enabled = true;

  //Tank Total
  TankTotal_Status = "OK";
  TankTotalValue_Low = 200.00;
  TankTotalValue_High = 1200.00;


  //PH1
  pH1_Status = "OK";
  pH1Value_Low = 5.80;
  pH1Value_High = 6.20;
  
  //PH2
  pH2_Status = "OK";
  pH2Value_Low = 5.80;
  pH2Value_High = 6.2;

  //TEMP
  Temp_Status = "OK";
  TempValue_Low = 21.00;
  TempValue_High = 26.00;
  //Accessory ON/OFF Values
  Heater_ON = 21.00;
  Heater_OFF = 23.88;
  AC_ON = 27.00;
  AC_OFF = 23.88;

  
  //HUMIDITY
  RH_Status = "OK";
  RHValue_Low = 30.00;
  RHValue_High = 45.00;
  //Accessory ON/OFF Values
  Humidifier_ON = 30.00;
  Humidifier_OFF = 33.00;
  Dehumidifier_ON = 45.00;
  Dehumidifier_OFF = 42.50;


  //TDS1
  TDS1_Status = "OK";
  TDS1Value_Low = 1;
  TDS1Value_High = 16;
  //Accessory ON/OFF Values
  NutePump1_ON = 1;
  NutePump1_OFF = 16;
  MixPump1_Enabled = false;


  //TDS2
  TDS2_Status = "OK";
  TDS2Value_Low = 1;
  TDS2Value_High = 16;
  //Accessory ON/OFF Values
  NutePump2_ON = 1;
  NutePump2_OFF = 16;
  MixPump2_Enabled = false;
  
  //Co2
  CO2_Status = "OK";
  CO2Value_Low = 40.00;
  CO2Value_High = 55.00;
  //Accessory ON/OFF Values
  CO2_ON = 40.00;
  CO2_OFF = 45.00 ;
  CO2_Enabled = false;
    
  //LIGHT
  Light_Status = "OK";
  LightValue_Low = 5.00;
  LightValue_High = 25000;




  //Turn all relays off and set to manual mode by default
  //Relay_States

  turnRelay(1, 0);
  turnRelay(2, 0);
  turnRelay(3, 0);
  turnRelay(4, 0);
  turnRelay(5, 0);
  turnRelay(6, 0);
  turnRelay(7, 0);
  turnRelay(8, 0);
  Relay1_State = 0;
  Relay2_State = 0;
  Relay3_State = 0;
  Relay4_State = 0;
  Relay5_State = 0;
  Relay6_State = 0;
  Relay7_State = 0;
  Relay8_State = 0;
  EEPROM.write(6, 0);
  EEPROM.write(7, 0);
  EEPROM.write(8, 0);
  EEPROM.write(9, 0);
  EEPROM.write(10, 0);
  EEPROM.write(11, 0);
  EEPROM.write(12, 0);
  EEPROM.write(13, 0);

  int Relay1_isAuto = 0;  //Water Pump 1
  int Relay2_isAuto = 0;  //Water Supply
  int Relay3_isAuto = 0;  //pH down
  int Relay4_isAuto = 0;  //Nute 1
  int Relay5_isAuto = 0;  //Nute 2
  int Relay6_isAuto = 0;  //Dehumidifier
  int Relay7_isAuto = 0;  //AC
  int Relay8_isAuto = 0;  //Light

  //Relay isAuto
  EEPROM.write(22, Relay1_isAuto);
  EEPROM.write(23, Relay2_isAuto);
  EEPROM.write(24, Relay3_isAuto);
  EEPROM.write(25, Relay4_isAuto);
  EEPROM.write(26, Relay5_isAuto);
  EEPROM.write(27, Relay6_isAuto);
  EEPROM.write(28, Relay7_isAuto);
  EEPROM.write(29, Relay8_isAuto);


  //pH
  eepromWriteFloat(113, pH1Value_Low);
  eepromWriteFloat(117, pH1Value_High);
  eepromWriteFloat(121, pH2Value_Low);
  eepromWriteFloat(125, pH2Value_High);

  //Temp
  eepromWriteFloat(129, TempValue_Low);
  eepromWriteFloat(133, TempValue_High);
  eepromWriteFloat(137, Heater_ON);
  eepromWriteFloat(141, Heater_OFF);
  eepromWriteFloat(145, AC_ON);
  eepromWriteFloat(149, AC_OFF);

  //RH
  eepromWriteFloat(153, RHValue_Low);
  eepromWriteFloat(157, RHValue_High);
  eepromWriteFloat(161, Humidifier_ON);
  eepromWriteFloat(165, Humidifier_OFF);
  eepromWriteFloat(169, Dehumidifier_ON);
  eepromWriteFloat(173, Dehumidifier_OFF);

  //TDS1
  eepromWriteFloat(177, TDS1Value_Low);
  eepromWriteFloat(181, TDS1Value_High);
  eepromWriteFloat(185, NutePump1_ON);
  eepromWriteFloat(189, NutePump1_OFF);
  if (MixPump1_Enabled == true) {
    EEPROM.write(193, 1);
  }
  else {
    EEPROM.write(193, 0);
  }

  //TDS2
  eepromWriteFloat(194, TDS2Value_Low);
  eepromWriteFloat(198, TDS2Value_High);
  eepromWriteFloat(202, NutePump2_ON);
  eepromWriteFloat(206, NutePump2_OFF);
  if (MixPump2_Enabled == true) {
    EEPROM.write(210, 1);
  }
  else {
    EEPROM.write(210, 0);
  }

  //CO2
  eepromWriteFloat(211, CO2Value_Low);
  eepromWriteFloat(215, CO2Value_High);
  eepromWriteFloat(219, CO2_ON);
  eepromWriteFloat(223, CO2_OFF);
  if (CO2_Enabled == true) {
    EEPROM.write(227, 1);
  }
  else {
    EEPROM.write(227, 0);
  }

  
  //Light
  eepromWriteFloat(228, LightValue_Low);
  eepromWriteFloat(232, LightValue_High);
  EEPROM.write(93, Light_ON_hour);
  EEPROM.write(94, Light_OFF_hour);
  EEPROM.write(95, Light_ON_min);
  EEPROM.write(96, Light_OFF_min);

  //Pump
  EEPROM.write(38, Pump_start_hour);
  EEPROM.write(39, Pump_start_min);
  EEPROM.write(40, Pump_every_hours);
  EEPROM.write(41, Pump_every_mins);
  EEPROM.write(42, Pump_for);
  EEPROM.write(43, Pump_times);

  int i = 0;
  for (i = 0; i < tmp_Pump_times; i++) {
    Pump_hour_array[i] =  tmp_Pump_hour_array[i];
    Pump_min_array[i] = tmp_Pump_min_array[i];
    Pump_isAM_array[i] = tmp_Pump_isAM_array[i];
    EEPROM.write((i + 44), Pump_hour_array[i]);
    EEPROM.write((i + 60), Pump_min_array[i]);
    EEPROM.write((i + 76), Pump_isAM_array[i]);
  }

  // added ultrasonic tank sensors
  //Tank 1
  eepromWriteFloat(236, Tank1Value_Low);
  eepromWriteFloat(240, Tank1Value_High);
  eepromWriteFloat(244, Tank1Pump_ON);
  eepromWriteFloat(248, Tank1Pump_OFF);
  if (Tank1MixPump_Enabled == true) {
    EEPROM.write(252, 1);
  }
  else {
    EEPROM.write(252, 0);
  }

  //Tank 2
  eepromWriteFloat(253, Tank2Value_Low);
  eepromWriteFloat(257, Tank2Value_High);
  eepromWriteFloat(261, Tank2Pump_ON);
  eepromWriteFloat(265, Tank2Pump_OFF);
  if (Tank2MixPump_Enabled == true) {
    EEPROM.write(269, 1);
  }
  else {
    EEPROM.write(269, 0);
  }

  //Tank 3
  eepromWriteFloat(270, Tank3Value_Low);
  eepromWriteFloat(274, Tank3Value_High);
  eepromWriteFloat(278, Tank3Pump_ON);
  eepromWriteFloat(282, Tank3Pump_OFF);
  if (Tank3MixPump_Enabled == true) {
    EEPROM.write(286, 1);
  }
  else {
    EEPROM.write(286, 0);
  }

  //Tank 4
  eepromWriteFloat(287, Tank4Value_Low);
  eepromWriteFloat(291, Tank4Value_High);
  eepromWriteFloat(295, Tank4Pump_ON);
  eepromWriteFloat(299, Tank4Pump_OFF);
  if (Tank3MixPump_Enabled == true) {
    EEPROM.write(303, 1);
  }
  else {
    EEPROM.write(303, 0);
  }

  //Tank Total
  eepromWriteFloat(304, TankTotalValue_Low);
  eepromWriteFloat(308, TankTotalValue_High);    

  //Save Time Settings
  EEPROM.write(0, tmp_hour);
  EEPROM.write(1, tmp_minute);
  EEPROM.write(2, tmp_second);
  EEPROM.write(3, tmp_day);
  EEPROM.write(4, tmp_month);
  EEPROM.write(5, tmp_year);
  setTime(tmp_hour, tmp_minute, tmp_second, tmp_day, tmp_month, tmp_year);
  setSyncProvider(RTC.get);

}

