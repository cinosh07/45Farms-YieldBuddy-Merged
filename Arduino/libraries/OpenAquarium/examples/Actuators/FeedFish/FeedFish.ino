/*
 *  OpenAquarium sensor platform for Arduino from Cooking-hacks.
 *
 *  Description: Open Aquarium platform for Arduino control several
 *  parameters in order to make a standalone aquarium. Sensors gather     
 *  information and correct possible errors with different actuators.  
 *
 *  In this example we activate the fish feeder.
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
DateTime now;

void setup(){
  Serial.begin(115200);
  OpenAquarium.init();
}

void loop(){
  
  now =OpenAquarium.getTime();
  OpenAquarium.printTime(now);
    	   
  if (now.hour() == 11 && now.minute() == 30){
  OpenAquarium.feedfish(); 
  }
 if (now.hour() == 23 && now.minute() == 29){
  OpenAquarium.readyforfeeding(); 
  }
 if (now.hour() == 23 && now.minute() == 30){
  OpenAquarium.feedfish(); 
  }
 if (now.hour() == 23 && now.minute() == 59){
  OpenAquarium.newday(); 
  }
 
}
