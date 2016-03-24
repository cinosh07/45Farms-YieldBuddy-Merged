/*
 *  OpenAquarium sensor platform for Arduino from Cooking-hacks.
 *
 *  Description: Open Aquarium platform for Arduino control several
 *  parameters in order to make a standalone aquarium. Sensors gather     
 *  information and correct possible errors with different actuators.  
 *
 *  This code shows the date and time of RTC.
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
 *  along with this program.  If not, see &#60;http://www.gnu.org/licenses/&#62;.
 *
 *  Version:           0.1 
 *  Design:            David Gascon 
 *  Implementation:    Marcos Martinez, Luis Martin & Jorge Casanova
 */

#include "OpenAquarium.h"
#include "Wire.h"

DateTime now;

void setup() {
  Serial.begin(115200);
  OpenAquarium.initRTC();  
}

void loop() {
    now = OpenAquarium.getTime(); //Get date and time
    
    //First way: Print date and time at once
    Serial.print("1er way: ");
    OpenAquarium.printTime(now);  
    
    
    //Second way: separate variables
    Serial.print("2nd way: ");
    Serial.print(now.month(), DEC);
    Serial.print("/");
    Serial.print(now.day(), DEC);
    Serial.print("/");
    Serial.print(now.year(), DEC);
    Serial.print(" ");
    
     switch (now.dayOfWeek()) // Friendly printout the weekday
    {
		case 1:
		  Serial.print("MON");
		  break;
		case 2:
		  Serial.print("TUE");
		  break;
		case 3:
		  Serial.print("WED");
		  break;
		case 4:
		  Serial.print("THU");
		  break;
		case 5:
		  Serial.print("FRI");
		  break;
		case 6:
		  Serial.print("SAT");
		  break;
		case 7:
		  Serial.print("SUN");
		  break;
	}
	Serial.print(" ");

    Serial.print(now.hour(), DEC);
    Serial.print(":");
    Serial.print(now.minute(), DEC);
    Serial.print(":");
    Serial.println(now.second(), DEC);
     
     
    delay(1000);
}
