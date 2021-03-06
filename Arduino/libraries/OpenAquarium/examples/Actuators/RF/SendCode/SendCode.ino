/*
 *  OpenAquarium sensor platform for Arduino from Cooking-hacks.
 *
 *  Description: Open Aquarium platform for Arduino control several
 *  parameters in order to make a standalone aquarium. Sensors gather     
 *  information and correct possible errors with different actuators.  
 *
 *  In this example we turn on and off all the plugs in the RF power strip
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

//Power strip codes. Please insert here your own codes generated with 
//RF_Receive_remoteControl_codes
unsigned long on1 = 1613922418;   
unsigned long off1 = 1613922420;
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
}


void loop() {
   OpenAquarium.sendPowerStrip(on1); //Turn ON plug 1
   Serial.println("Plug 1: ON");
   delay(3000); //Wait five seconds
   OpenAquarium.sendPowerStrip(off1);//Turn OFF plug 1
   Serial.println("Plug 1: OFF");
   delay(3000); //Wait five seconds
   
   
   OpenAquarium.sendPowerStrip(on2); //Turn ON plug 2
   Serial.println("Plug 2: ON");
   delay(3000); //Wait five seconds
   OpenAquarium.sendPowerStrip(off2);//Turn OFF plug 2
   Serial.println("Plug 2: OFF");
   delay(3000); //Wait five seconds


   OpenAquarium.sendPowerStrip(on3); //Turn ON plug 3
   Serial.println("Plug 3: ON");
   delay(3000); //Wait five seconds
   OpenAquarium.sendPowerStrip(off3);//Turn OFF plug 3
   Serial.println("Plug 3: OFF");
   delay(3000); //Wait five seconds


   OpenAquarium.sendPowerStrip(on4); //Turn ON plug 4
   Serial.println("Plug 4: ON");
   delay(3000); //Wait five seconds
   OpenAquarium.sendPowerStrip(off4);//Turn OFF plug 4
   Serial.println("Plug 4: OFF");
   delay(3000); //Wait five seconds


   OpenAquarium.sendPowerStrip(on5); //Turn ON plug 5
   Serial.println("Plug 5: ON");
   delay(3000); //Wait five seconds
   OpenAquarium.sendPowerStrip(off5);//Turn OFF plug 5
   Serial.println("Plug 5: OFF");
   delay(3000); //Wait five seconds
}
