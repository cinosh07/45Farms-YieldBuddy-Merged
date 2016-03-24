/*
 *  OpenAquarium sensor platform for Arduino from Cooking-hacks.
 *
 *  Description: Open Aquarium platform for Arduino control several
 *  parameters in order to make a standalone aquarium. Sensors gather     
 *  information and correct possible errors with different actuators.  
 *
 *  In this example we receive the codes from the remote control of the
 *  power strip. 
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

void setup() {
  Serial.begin(115200);
  RemoteReceiver::init(0, 2, readCodes);
}


void loop() {
}


void readCodes(unsigned long receivedCode, unsigned int period) { 
  RemoteReceiver::disable();
  interrupts();
  unsigned long code=receivedCode;
  code = code & 0xFFFFF;
  code |= (unsigned long)period << 23;  
  code |= 3L << 20; 
  Serial.println(code);
  RemoteReceiver::enable();
}
