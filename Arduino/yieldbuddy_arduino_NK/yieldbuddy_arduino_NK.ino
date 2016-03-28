#include <Time.h>
#include <PString.h>
#include <DHT.h>
#include <EEPROM.h>
#include <Wire.h>
#include <OneWire.h>
#include <DS1307RTC.h>
#include <HMC5883L.h>
#include <avr/pgmspace.h>
#include "Arduino.h"

/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!VARIABLES!!VARIABLES!!VARIABLES!!VARIABLES!!VARIABLES!!VARIABLES!!VARIABLES!!VARIABLES!!VARIABLES!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */

String Serial_inString = "";
boolean stringComplete = false;
int serialcounter = 0;

char longdate[25] = "Jan 01, 2012 12:00:00 PM";
char pH1_char[6] = "00.00";
char pH2_char[6] = "00.00";
char Temp_char[8]= "";
char Water_char[8]= "00.00";
char RH_char[7] = "00.00%";
char TDS1_char[11] = "0000.0ppm";
char TDS2_char[11] = "0000.0ppm";
char CO2_char[8] = "00.00%";
char Light_char[7] = "00.00%";

// added dallas temp sensors
char temp_s[8]="-000.0\0"; //dallas temp

//added ulrasonic tank sensors
char tank_1_char[8] = "0000.00";
char tank_2_char[8] = "0000.00";
char tank_3_char[8] = "0000.00";
char tank_4_char[8] = "0000.00";
char tank_total_char[8] = "0000.00";

//Temporary placeholders for Time Settings Screen
int tmp_month;
int tmp_day;
int tmp_year;
int tmp_hour;
int tmp_minute;
int tmp_second;

int last_minute;

//Note: Committed Time Settings are stored as their associated month(), day(), year(), etc... as per <Time.h>

//Hours of the day array
String DayHours[24] = {
  "12:00 AM"," 1:00 AM"," 2:00 AM"," 3:00 AM"," 4:00 AM"," 5:00 AM"," 6:00 AM"," 7:00 AM"," 8:00 AM"," 9:00 AM","10:00 AM","11:00 AM",
  "12:00 PM"," 1:00 PM"," 2:00 PM"," 3:00 PM"," 4:00 PM"," 5:00 PM"," 6:00 PM"," 7:00 PM"," 8:00 PM"," 9:00 PM","10:00 PM","11:00 PM"};

//Temporary placeholders for Light Schedule Screen
int tmp_send;
int tmp_Light_ON_hour;
int tmp_Light_ON_min;
int tmp_Light_OFF_hour;
int tmp_Light_OFF_min;

//Committed Light Settings
int Light_ON_hour = 12;
int Light_ON_min = 0;
int Light_OFF_hour = 23;
int Light_OFF_min = 59;

//Temporary placeholders for Pump Schedule Screen
int tmp_Pump_start_hour;
int tmp_Pump_start_min;
boolean tmp_Pump_start_isAM = true;
int tmp_Pump_every_hours;
int tmp_Pump_every_mins;
int tmp_Pump_for; //In Minutes
int tmp_Pump_times; //Number of times per day

int tmp_Pump_hour_array[16];
int tmp_Pump_min_array[16];
boolean tmp_Pump_isAM_array[16];

//Committed Pump Schedule Settings
int Pump_start_hour = 11;
int Pump_start_min = 45;
boolean Pump_start_isAM = true;
int Pump_every_hours = 2;
int Pump_every_mins = 30;
int Pump_for = 15; //In Minutes
int Pump_times = 1; //Number of times per day

int Pump_hour_array[16];
int Pump_min_array[16];
boolean Pump_isAM_array[16];

int pumpActivityCounter = 10;


/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!SENSOR VARIABLES!!SENSOR VARIABLES!!SENSOR VARIABLES!!SENSOR VARIABLES!!SENSOR VARIABLES!!SENSOR VARIABLES!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */

//Values the arduino sees
int pH1RawValue = 0;
int pH2RawValue = 0;
int TempRawValue = 0;
int RHRawValue = 0;
int TDS1RawValue = 0;
int TDS2RawValue = 0;
int CO2RawValue = 0;
int LightRawValue = 0;
int WaterRawValue = 0;

// added ultrasonic tank sensors
int Tank1RawValue = 0;
int Tank2RawValue = 0;
int Tank3RawValue = 0;
int Tank4RawValue = 0;
int TankTotalRawValue = 0;

//Values the humans see (after it has been calculated using raw values above ^^^ and their respected formulas)
float pH1Value = 0;
float pH2Value = 0;
float TempValue = 0;
float WaterValue = 0;
float RHValue = 0;
float TDS1Value = 0;
float TDS2Value = 0;
float CO2Value = 0;
float LightValue = 0;

// added ultrasonic tank sensors
float Tank1Value = 0;
float Tank2Value = 0;
float Tank3Value = 0;
float Tank4Value = 0;
float TankTotalValue = 0;

// variables used in read_water_sensor function
long duration, distance; // Duration used to calculate distance
float water_height = 0; //water height in inches
float filledvolume = 0; // amount of tank volume filled with water
float water_litres = 0; // amount of tank volume filled in litres
float echo = 0; // returned value in litres 


// variables used in reading magnometer
HMC5883L compass;
int error = 0;

//Tank 1
String Tank1_Status = "OK";
float Tank1Value_Low = 50.00;
float Tank1Value_High = 200.00;
//Accessory ON/OFF Values
float Tank1Pump_ON = 200.00;
float Tank1Pump_OFF = 190.00;
boolean Tank1MixPump_Enabled = true;

//Tank 2
String Tank2_Status = "OK";
float Tank2Value_Low = 50.00;
float Tank2Value_High = 200.00;
//Accessory ON/OFF Values
float Tank2Pump_ON = 200.00;
float Tank2Pump_OFF = 190.00;
boolean Tank2MixPump_Enabled = true;

//Tank 3
String Tank3_Status = "OK";
float Tank3Value_Low = 50.00;
float Tank3Value_High = 200.00;
//Accessory ON/OFF Values
float Tank3Pump_ON = 200.00;
float Tank3Pump_OFF = 190.00;
boolean Tank3MixPump_Enabled = true;

//Tank 4
String Tank4_Status = "OK";
float Tank4Value_Low = 50.00;
float Tank4Value_High = 200.00;
//Accessory ON/OFF Values
float Tank4Pump_ON = 200.00;
float Tank4Pump_OFF = 190.00;
boolean Tank4MixPump_Enabled = true;

//Tank Total
String TankTotal_Status = "OK";
float TankTotalValue_Low = 200.00;
float TankTotalValue_High = 1200.00;


//PH
//Status Indicator Values
String pH1_Status = "OK";
float pH1Value_Low = 5.80;
float pH1Value_High = 6.20;

String pH2_Status = "OK";
float pH2Value_Low = 5.80;
float pH2Value_High = 6.20;

//pH calibration values
float CalPoint_4 = 2221;  //Write here your measured value in mV of pH 4
float CalPoint_7 = 2104;  //Write here your measured value in mV of pH 7
float CalPoint_10 = 2031; //Write here your measured value in mV of pH 10
float pHSlope = 0.0178; //slope from sensor calibration. Calculate from values above in the future (NK)
float pHOffset = 0.0; //slope from sensor calibration. Calculate from values above in the future (NK)


//Temp
String Temp_Status = "OK";
float TempValue_Low = 21.00;
float TempValue_High = 26.00;
//Accessory ON/OFF Values
float Heater_ON = 21.00;
float Heater_OFF = 23.88;
float AC_ON = 26.00;
float AC_OFF = 23.88;

//Level
String Level_Status = "Unknown";
int LevelFull = 0; //0 = empty, 1 = full, 2 = unknown

//Water level float
float WaterLevel_Low = 5.00;
float WaterLevel_High = 95.00;


//Humidty(RH)
String RH_Status = "OK";
float RHValue_Low = 39.00;
float RHValue_High = 46.00;
//Accessory ON/OFF Values
float Humidifier_ON = 40.00;
float Humidifier_OFF = 60.00;
float Dehumidifier_ON = 45.00;
float Dehumidifier_OFF = 40.00;

//TDS1
String TDS1_Status = "OK";
float TDS1Value_Low = 500.0;
float TDS1Value_High = 800.0;

//Accessory ON/OFF Values
float NutePump1_ON = 500.0;
float NutePump1_OFF = 800.0;
boolean MixPump1_Enabled = true;

//TDS2
String TDS2_Status = "OK";
float TDS2Value_Low = 500.0;
float TDS2Value_High = 800.0;

//Accessory ON/OFF Values
float NutePump2_ON = 500.0;
float NutePump2_OFF = 800.0;
boolean MixPump2_Enabled = true;

//CO2
String CO2_Status = "OK";
float CO2Value_Low = 60.00;
float CO2Value_High= 75.00;

//Accessory ON/OFF Values
float CO2_ON = 40.00;
float CO2_OFF = 60.00 ;
boolean CO2_Enabled = true;

//Light
String Light_Status = "OK";
float LightValue_Low = 20.00;
float LightValue_High = 95.00;

  int BH1750_address = 0x23; // i2c Addresse
  byte buff[2];

  void BH1750_Init(int address){
  
  Wire.beginTransmission(address);
  Wire.write(0x10); // 1 [lux] aufloesung
  Wire.endTransmission();
  }

  byte BH1750_Read(int address){
  
  byte i=0;
  Wire.beginTransmission(address);
  Wire.requestFrom(address, 2);
  while(Wire.available()){
    buff[i] = Wire.read(); 
    i++;
  }
  Wire.endTransmission();  
  return i;
}



/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!PIN DEFINITIONS!!PIN DEFINITIONS!!PIN DEFINITIONS!!PIN DEFINITIONS!!PIN DEFINITIONS!!PIN DEFINITIONS!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */

// Dallas Temperature
#define ONE_WIRE_PIN 8
byte TmpE1Add[]={0x28, 0xFF, 0x20, 0x1D, 0x71, 0x15, 0x02, 0xFE};
OneWire  ds(ONE_WIRE_PIN);

//RH
#define DHTPIN 11
#define DHTTYPE DHT22   // DHT 11
//#define DHTTYPE DHT11   // DHT 11
DHT dht(DHTPIN, DHTTYPE);


int TempPin = A0;
int CO2Pin = A1;
int LightPin = A2;
int pH1Pin = A3;
int pH2Pin = A4;
int TDS1Pin = A5;
int TDS2Pin = A6;
int WaterPin = A7;

//added utlrasonic tank sensors
int Tank1TrigPin = A8;
int Tank1EchoPin = A9;
int Tank2TrigPin = A10;
int Tank2EchoPin = A11;
int Tank3TrigPin = A12;
int Tank3EchoPin = A13;
int Tank4TrigPin = A14;
int Tank4EchoPin = A15;

int Relay1_Pin = 22;  //Water Pump
int Relay2_Pin = 23;  //Water Supply
int Relay3_Pin = 24;  //pH down
int Relay4_Pin = 25;  //Nute 1
int Relay5_Pin = 26;  //Nute 2
int Relay6_Pin = 27;  //Dehumidifier
int Relay7_Pin = 28;  //AC
int Relay8_Pin = 29;  //Light

int Relay1_State = 0;
int Relay2_State = 0;
int Relay3_State = 0;
int Relay4_State = 0;
int Relay5_State = 0;
int Relay6_State = 0;
int Relay7_State = 0;
int Relay8_State = 0;

int Relay1_isAuto = 1;  //Water Pump 1
int Relay2_isAuto = 1;  //Water Supply
int Relay3_isAuto = 1;  //pH down
int Relay4_isAuto = 1;  //Nute 1
int Relay5_isAuto = 1;  //Nute 2
int Relay6_isAuto = 1;  //Dehumidifier
int Relay7_isAuto = 1;  //AC
int Relay8_isAuto = 1;  //Light
/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!SETUP!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
void setup()
{
  //Set Pin Modes
  pinMode(Relay1_Pin, OUTPUT);
  pinMode(Relay2_Pin, OUTPUT);
  pinMode(Relay3_Pin, OUTPUT);
  pinMode(Relay4_Pin, OUTPUT);
  pinMode(Relay5_Pin, OUTPUT);
  pinMode(Relay6_Pin, OUTPUT);
  pinMode(Relay7_Pin, OUTPUT);
  pinMode(Relay8_Pin, OUTPUT);

//  //COMMENT OUT THIS SECTION ON FIRST START UP!!-----------------------------------
//  //EEPROM TIME
    int eeprom_hr = EEPROM.read(0);
    int eeprom_min = EEPROM.read(1);
    int eeprom_sec = EEPROM.read(2);
    int eeprom_day = EEPROM.read(3);
    int eeprom_month = EEPROM.read(4);
    int eeprom_yr = EEPROM.read(5);

  compass = HMC5883L(); // Construct a new HMC5883 compass.

  Serial.println("Setting scale to +/- 1.3 Ga");
  error = compass.SetScale(5.6); // Set the scale of the compass.
  if(error != 0) // If there is an error, print it out.
    Serial.println(compass.GetErrorText(error));

  Serial.println("Setting measurement mode to continous.");
  error = compass.SetMeasurementMode(Measurement_Continuous); // Set the measurement mode to Continuous
  if(error != 0) // If there is an error, print it out.
    Serial.println(compass.GetErrorText(error));


   

  //EEPROM RELAYS
  Relay1_State = 0; //EEPROM.read(6);     //Water-Pump 1
  Relay2_State = 0; //EEPROM.read(7);     //Water supply
  Relay3_State = 0; //EEPROM.read(8);     //ph Down
  Relay4_State = 0; //EEPROM.read(9);     //Nute 1
  Relay5_State = 0; //EEPROM.read(10);    //Nute 2
  Relay6_State = 0; //EEPROM.read(11);    //Dehumidifier
  Relay7_State = 0; //EEPROM.read(12);    //AC
  Relay8_State = 0; //EEPROM.read(13);    //Light

  Relay1_isAuto = EEPROM.read(22);  //Water Pump 1
  Relay2_isAuto = EEPROM.read(23);  //Water Pump 2
  Relay3_isAuto = EEPROM.read(24);  //ph down
  Relay4_isAuto = EEPROM.read(25);  //nute 1
  Relay5_isAuto = EEPROM.read(26);   //nute 2
  Relay6_isAuto = EEPROM.read(27);  //dehumid  
  Relay7_isAuto = EEPROM.read(28);  //AC
  Relay8_isAuto = EEPROM.read(29);  //Light

  //Safe-Route ---> Disregard last known states and turn all relays off (auto will take over):
    turnRelay(1, 0);
    turnRelay(2, 0);
    turnRelay(3, 0);
    turnRelay(4, 0);
    turnRelay(5, 0);
    turnRelay(6, 0);
    turnRelay(7, 0);
    turnRelay(8, 0);
    
  //EEPROM Water Pump Schedule
  Pump_start_hour = EEPROM.read(38);
  Pump_start_min = EEPROM.read(39);
  Pump_every_hours = EEPROM.read(40);
  Pump_every_mins = EEPROM.read(41);
  Pump_for = EEPROM.read(42);
  Pump_times = EEPROM.read(43);

  int i = 0;
  for(i = 0; i < 16; i++){
    Pump_hour_array[i] =  EEPROM.read(i+44);
    Pump_min_array[i] = EEPROM.read(i+60);
    Pump_isAM_array[i] = EEPROM.read(i+76);
  }

  //EEPROM Light Schedule
  Light_ON_hour = EEPROM.read(93);
  Light_OFF_hour = EEPROM.read(94);
  
  Light_ON_min = EEPROM.read(95);
  Light_OFF_min = EEPROM.read(96);

  //EEPROM pH1 Settings
  pH1Value_Low = eepromReadFloat(113);
  pH1Value_High = eepromReadFloat(117);

  //EEPROM pH2 Settings
  pH2Value_Low = eepromReadFloat(121);
  pH2Value_High = eepromReadFloat(125);

  //EEPROM Temp Settings
  TempValue_Low  = eepromReadFloat(129);
  TempValue_High = eepromReadFloat(133);
  Heater_ON = eepromReadFloat(137);
  Heater_OFF =eepromReadFloat(141);
  AC_ON = eepromReadFloat(145);
  AC_OFF = eepromReadFloat(149);

  //EEPROM RH Settings
  RHValue_Low = eepromReadFloat(153);
  RHValue_High = eepromReadFloat(157);
  Humidifier_ON = eepromReadFloat(161);
  Humidifier_OFF = eepromReadFloat(165);
  Dehumidifier_ON = eepromReadFloat(169);
  Dehumidifier_OFF = eepromReadFloat(173);

  //EEPROM TDS1 Settings
  TDS1Value_Low = eepromReadFloat(177);
  TDS1Value_High = eepromReadFloat(181);
  NutePump1_ON = eepromReadFloat(185);
  NutePump1_OFF = eepromReadFloat(189);
  if (EEPROM.read(193) == 1){
    MixPump1_Enabled = true;
  } 
  else {
    MixPump1_Enabled = false;
  }

  //EEPROM TDS2 Settings
  TDS2Value_Low = eepromReadFloat(194);
  TDS2Value_High = eepromReadFloat(198);
  NutePump2_ON = eepromReadFloat(202);
  NutePump2_OFF = eepromReadFloat(206);
  if (EEPROM.read(210) == 1){
    MixPump2_Enabled = true;
  } 
  else {
    MixPump2_Enabled = false;
  }


  //EEPROM CO2 Settings
  CO2Value_Low = eepromReadFloat(211);
  CO2Value_High = eepromReadFloat(215);
  CO2_ON = eepromReadFloat(219);
  CO2_OFF = eepromReadFloat(223);
  if (EEPROM.read(227) == 1){
    CO2_Enabled = true;
  } 
  else {
    CO2_Enabled = false;
  }
  //
  //EEPROM Light Settings
  LightValue_Low = eepromReadFloat(228);
  LightValue_High = eepromReadFloat(232);

  //added ultrasonic tank sensors
  //
  //Water Tank 1
  Tank1Value_Low = eepromReadFloat(236);
  Tank1Value_High = eepromReadFloat(240);
  Tank1Pump_ON = eepromReadFloat(244);
  Tank1Pump_OFF = eepromReadFloat(248);
  if (EEPROM.read(252) == 1){
    Tank1MixPump_Enabled = true;
  } 
  else {
    Tank1MixPump_Enabled = false;
  }
  
  //Water Tank 2
  Tank2Value_Low = eepromReadFloat(253);
  Tank2Value_High = eepromReadFloat(257);
  Tank2Pump_ON = eepromReadFloat(261);
  Tank2Pump_OFF = eepromReadFloat(265);
  if (EEPROM.read(269) == 1){
    Tank2MixPump_Enabled = true;
  } 
  else {
    Tank2MixPump_Enabled = false;
  }
  
  //Water Tank 3
  Tank3Value_Low = eepromReadFloat(270);
  Tank3Value_High = eepromReadFloat(274);
  Tank3Pump_ON = eepromReadFloat(278);
  Tank3Pump_OFF = eepromReadFloat(282);
  if (EEPROM.read(286) == 1){
    Tank3MixPump_Enabled = true;
  } 
  else {
    Tank3MixPump_Enabled = false;
  }
  
  //Water Tank 4
  Tank4Value_Low = eepromReadFloat(287);
  Tank4Value_High = eepromReadFloat(291);
  Tank4Pump_ON = eepromReadFloat(295);
  Tank4Pump_OFF = eepromReadFloat(299);
  if (EEPROM.read(303) == 1){
    Tank4MixPump_Enabled = true;
  } 
  else {
    Tank4MixPump_Enabled = false;
  }

  //Water Tank 4
  TankTotalValue_Low = eepromReadFloat(304);
  TankTotalValue_High = eepromReadFloat(308);
  
//  ------------------------------------------------------------------------------

  //Load default time first, then try the RTC.
  //Set-Time  setTime(hr,min,sec,day,month,yr);
  setTime(0,0,0,1,1,2016);
  setSyncProvider(RTC.get);
  
  Serial.begin(115200);
  Serial1.begin(115200);
  
}


/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!LOOP!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
void loop()
{  
  //Clear the EEPROM and then write defaults.
//  for (int i = 0; i < 4096; i++) {
//    EEPROM.write(i, 0);
//  }
//  delay(1000); 
//
//  RestoreDefaults();
//  turnRelay(1,1);
//  delay(1000);
//  turnRelay(1,0);
//  turnRelay(2,1);
//  delay(1000);
//  turnRelay(2,0);
//  turnRelay(3,1);
//  delay(1000);
//  turnRelay(3,0);  
//  turnRelay(4,1);
//  delay(1000);
//  turnRelay(4,0);
//  turnRelay(5,1);
//  delay(1000);
//  turnRelay(5,0);
//  turnRelay(6,1);
//  delay(1000);
//  turnRelay(6,0);
//  turnRelay(7,1);
//  delay(1000);
//  turnRelay(7,0);
//  turnRelay(8,1);
//  delay(1000);
//  turnRelay(8,0);
//  //delay(30000);
//  //delay(30000);
  
  
  
  while (1){
  updatelongdate();
  updateSensorValues();
  serialEvent();
  sendserialmessages();
  CheckTimers();
  serialEvent();
  CheckSetPoints();
  pumpActivityCounter--;
  }
}











