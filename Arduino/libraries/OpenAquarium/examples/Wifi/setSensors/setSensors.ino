/*
 *  OpenAquarium sensor platform for Arduino from Cooking-hacks.
 *
 *  Description: Open Aquarium platform for Arduino control several
 *  parameters in order to make a standalone aquarium. Sensors gather     
 *  information and correct possible errors with different actuators.  
 *
 *  This example send all the sensor data info to a web server
 *
 *  Copyright (C) 2012 Libelium Comunicaciones Distribuidas S.L.
 *  http://www.libelium.com
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  Version:           0.1 
 *  Design:            David Gascon 
 *  Implementation:    Marcos Martinez, Luis Martin & Jorge Casanova
 */


#include "OpenAquarium.h"
#include "Wire.h"

#define point_1_cond 40000   // Write here your EC calibration value of the solution 1 in µS/cm
#define point_1_cal 40       // Write here your EC value measured in resistance with solution 1
#define point_2_cond 10500   // Write here your EC calibration value of the solution 2 in µS/cm
#define point_2_cal 120      // Write here your EC value measured in resistance with solution 2


#define calibration_point_4 2221  //Write here your measured value in mV of pH 4
#define calibration_point_7 2104  //Write here your measured value in mV of pH 7
#define calibration_point_10 2031 //Write here your measured value in mV of pH 10


String wifiString;
char buffer[20];
int flag = 0; // auxiliar variable
DateTime now;
String levelstatus1;
String levelstatus2;
String waterleakstatus;

void setup() {
  Serial.begin(115200);
  OpenAquarium.init();    //Initialize sensors power 
  OpenAquarium.calibrateEC(point_1_cond,point_1_cal,point_2_cond,point_2_cal);
  OpenAquarium.calibratepH(calibration_point_4,calibration_point_7,calibration_point_10);
 
  wificonfig(); 
  
  
}


void loop() {


  now =OpenAquarium.getTime();
  OpenAquarium.printTime(now);
  
  if ( now.second() == 0 && flag == 0  ){ //Only enter 1 time each hour 

    //Get Gateway Sensors
    
    float temperature = OpenAquarium.readtemperature();
    
    
    float resistanceEC = OpenAquarium.readResistanceEC(); //EC Value in resistance
    float EC2 = OpenAquarium.ECConversion(resistanceEC); //EC Value in µS/cm
    
    
    int mvpH = OpenAquarium.readpH(); //Value in mV of pH
    float pH2 = OpenAquarium.pHConversion(mvpH); //Calculate pH value
    
    
    int status1 = OpenAquarium.readwaterlevel(1);
    if(status1==HIGH){
      levelstatus1= "Full";
      
    }
    else if (status1==LOW){
      levelstatus1= "Empty";
      
    }
    int status2 = OpenAquarium.readwaterlevel(2);
    if(status2==HIGH){
      levelstatus2= "Full";
      
    }
    else if (status2==LOW){
      levelstatus2= "Empty";
      
    }
    
    int waterleak = analogRead(3);
    
    if (waterleak>1020){
      waterleakstatus="No";
      
    }
    else if (waterleak<=1020){
      waterleakstatus="Si";
    }

    


    //Create string of the floats to send it
    
    dtostrf(temperature,2,2,buffer);
    String temperature_wf = String (buffer);
    
    dtostrf(EC2,2,2,buffer);
    String EC_wf = String (buffer);
    
    dtostrf(pH2,2,2,buffer);
    String pH_wf = String (buffer);

    /*
   You must create strings with this structure: "node_id:sensor_type:value;node_id2:sensor_type2:value2;...." 
     Note the ";" between different structures
          
     And where sensor_type:
     0 - Temperature 
     1 - EC
     2 - pH
     3 - Waterlevel1
     4 - Waterlevel2 
     5 - waterleak 
          
     For example: "0:0:56;0:1:17.54;0:2:56.45"
     This means that you send data of the gateway: Soil moisture=56, Soil temperature=17.54 and Air humidity=56.45
     
     */

    //Cut data in several string because the wifi module have problems with longer strings
    wifiString= "0:" + temperature_wf + ";1:" + EC_wf + ";2:" + pH_wf; 
    sendwifi();
    enterCMD();
   
        
    wifiString= "3:" + levelstatus1 + ";4:"  + levelstatus2 + ";5:"  + waterleakstatus; 
    sendwifi();
    enterCMD();



    flag = 1;  

  }

  else if (now.second() == 30 && flag == 1){
    flag = 0;
  } 

}



void check(){
  delay(1000);
  autoflush(); 
}


void wificonfig(){
  while (Serial.available()>0){
  }

  enterCMD();
  // Sets DHCP and TCP protocol
  Serial.print(F("set ip dhcp 1\r")); 
  check();
  Serial.print(F("set ip protocol 18\r"));
  check();

  // Configures the way to join the network AP, sets the encryption of the
  // network and joins it
  Serial.print(F("set wlan join 0\r")); //The auto-join feature is disabled 
  check(); 
  Serial.print(F("set wlan phrase libelium.2012_\r")); //Insert here the password of the WLAN
  check(); 
  Serial.print(F("join libelium_wsn2\r")); //Insert here the name of the WLAN
  check(); 
}


void enterCMD(){
  Serial.println(""); //To see clearer when debugging
  // Enters in command mode
  Serial.print(F("$$$")); 
  delay(100);
  check();
  Serial.flush();
}

void sendwifi(){
  Serial.print(F("set i h 0\r"));
  check();
  Serial.print(F("set d n 192.168.1.64\r"));
  check(); //Insert here your IP

  //Configures HTTP connection
  Serial.print(F("set i r 80\r")); 
  check();

  Serial.print(F("set o f 1\r")); 
  check();

  Serial.print(F("set c r GET$/OpenAquarium/set_sensors.php?data="));
  Serial.print(wifiString);
  Serial.print(F("\r"));
  check();

  // Calls open to launch the configured connection.
  Serial.print(F("open\r")); 
  check();
}


void autoflush()
{
  while (Serial.available()>0)
  {
    Serial.read(); 
  }
}




