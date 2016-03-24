/*
 *  OpenAquarium sensor platform for Arduino from Cooking-hacks.
 *
 *  Description: Open Aquarium platform for Arduino control several
 *  parameters in order to make a standalone aquarium. Sensors gather     
 *  information and correct possible errors with different actuators.  
 *
 *  This is a general example for Open Aquarium Extra accesories
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
float temperature;
DateTime now;

//Power strip codes
unsigned long on1 = 1597145202;
unsigned long off1 = 1597145204;
unsigned long on2 = 1597145220;
unsigned long off2 = 1597145222;
unsigned long on3 = 1597145112;
unsigned long off3 = 1597145114;
unsigned long on4 = 1597144950;
unsigned long off4 = 1597144952;
unsigned long on5 = 1597144464;
unsigned long off5 = 1597144466;

void setup() {
  Serial.begin(115200); 
  OpenAquarium.init();
}
  
void loop() {
  
  now =OpenAquarium.getTime();
  OpenAquarium.printTime(now);
  
  temperature=OpenAquarium.readtemperature();
  Serial.println(temperature);
   
  OpenAquarium.lighting(now);
  	
  OpenAquarium.tempcontrol(temperature);
   
  OpenAquarium.waterlevel1();
  OpenAquarium.waterlevel2();
   
  if (now.hour() == 8 && now.minute() == 30){
  OpenAquarium.feedfish(); 
  }
  if (now.hour() == 22 && now.minute() == 29){
  OpenAquarium.readyforfeeding(); 
  }
  if (now.hour() == 22 && now.minute() == 30){
  OpenAquarium.feedfish(); 
  }
  if (now.hour() == 12 && now.dayOfWeek()==7){
  OpenAquarium.empty(); 
  OpenAquarium.fill();
  }
  
  OpenAquarium.leak();
  
  OpenAquarium.tempcontrol(temperature);
  if (now.hour() == 22 && now.minute() == 15){
   OpenAquarium.sendPowerStrip(on1); //Turn ON plug 1
   Serial.println("RGB ON");
	}
   if (now.hour() == 23 && now.minute() == 59){
   OpenAquarium.sendPowerStrip(off1); //Turn OFF plug 1
   Serial.println("RGB OFF");
   OpenAquarium.newday(); 
	}
  delay(500);
}
