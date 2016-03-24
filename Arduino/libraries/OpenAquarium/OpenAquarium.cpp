/*
 *  OpenAquarium sensor platform for Arduino from Cooking-hacks.
 *
 *  Description: Open Aquarium platform for Arduino control several
 *  parameters in order to make a standalone aquarium. Sensors gather     
 *  information and correct possible errors with different actuators.  
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

// include this library's description file
#include "OpenAquarium.h"
#include "Wire.h"
#include "RemoteReceiver.h"
#include "RemoteSwitch.h"
#include "OneWire.h"
#include "RTClib.h"
#include "DallasTemperature.h"
#include "filter.h"

RTC_DS1307 RTC;
OneWire oneWire(ONE_WIRE_BUS); // Setup a oneWire instance to communicate with any OneWire devices (not just Maxim/Dallas temperature ICs)
DallasTemperature sensors(&oneWire);// Pass our oneWire reference to Dallas Temperature. 

DeviceAddress insideThermometer;


OpenAquariumClass::OpenAquariumClass() 
{ 
 
}
	

//***************************************************************
// Public Methods												*
//***************************************************************
	
	
	 int melody1[] = {  c4, R,  a5, R , a5, R};  //Melody

	 int beats1[]  = {  40, 10, 10, 2, 10, 5};

	 int MAX_COUNT = sizeof(melody1) / 2; // Melody length, for looping.
 


	//!******************************************************************************
	//!	Name:	init()																			*
	//!	Description: Initializes all														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.init();														*
	//!******************************************************************************
	
	void OpenAquariumClass::init(void)
	{
	
	tempo = 10000; // Set overall tempo
 
	pause = 1000; // Set length of pause between notes
 
	rest_count = 50; // Loop variable to increase Rest length (BLETCHEROUS HACK; See NOTES)
	
	//Float Switches
	levelstatus1=0;
	levelstatus2=0;
	
	//Fish Feeder
	feederstatus = 0;
	feed=0;
	aux = false;
	
	// Initialize core variables
	toneM = 0;
	beat = 0;
	duration  = 0;
	
	//Water changes
	waterchange=0;
	enteragain=0;
	dosingpump=0;
	refill=0;
		
	initports();	
	initDS18B20();
	initRTC();
	welcome();		
		
	}

	//!******************************************************************************
	//!	Name:	initports()																	*
	//!	Description: Initializes all ports													*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.initports();													*
	//!******************************************************************************

	void OpenAquariumClass::initports(void)
	{

		pinMode(pump2, OUTPUT);		pinMode(level1, INPUT);		pinMode(dpump1, OUTPUT);	
		pinMode(pump1, OUTPUT);		pinMode(level2, INPUT);		pinMode(feeder, OUTPUT);
		pinMode(buzzer,OUTPUT);		pinMode(dpump3, OUTPUT);	pinMode(feederpos, INPUT);
		pinMode(light, OUTPUT);		pinMode(dpump2, OUTPUT);	
		
	}
	
	//!******************************************************************************
	//!	Name:	initDS18B20()																	*
	//!	Description: Init 18B20 sensor														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.initDS18B20();												*
	//!******************************************************************************	
	
	void OpenAquariumClass::initDS18B20(void){
	if (!sensors.getAddress(insideThermometer, 0)) 
	sensors.setResolution(insideThermometer, 12);  
}		
	
	//!******************************************************************************
	//!	Name:	welcome()																		*
	//!	Description: Welcome message and music												*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.welcome();													*
	//!******************************************************************************

	void OpenAquariumClass::welcome(void)
	{

	openingsong();	
		
	}
	
	//!******************************************************************************
	//!	Name:	initRTC()																		*
	//!	Description: Initialize clock														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.initRTC();													*
	//!******************************************************************************

	void OpenAquariumClass::initRTC(void)
	{

		Wire.begin();
		RTC.begin();	
		
	}
	
	//!******************************************************************************
	//!	Name:	setTime()																		*
	//!	Description: Set up time																*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.setTime();													*
	//!******************************************************************************
	
	void OpenAquariumClass::setTime(void){
		
    RTC.adjust(DateTime(__DATE__, __TIME__));
    
	}
	
	//!******************************************************************************
	//!	Name:	getTime()																		*
	//!	Description: Get time from PC														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.getTime();													*
	//!******************************************************************************
	
	DateTime OpenAquariumClass::getTime(void){
    return  RTC.now(); 
	}
	
	//!******************************************************************************
	//!	Name:	printTime(DateTime now)														*
	//!	Description: Print time on screen													*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.printTime(DateTime now);									*
	//!******************************************************************************
	
	void OpenAquariumClass::printTime(DateTime now){
	
	Serial.print(now.month(), DEC);
    Serial.print("/");
    
	Serial.print(now.day(), DEC);
    Serial.print("/");

    Serial.print(now.year(), DEC);
    Serial.print(" ");

	// Friendly printout the weekday
        switch (now.dayOfWeek()) 
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
	   
    if(now.hour()<10){
	switch (now.hour()) 
    {
		case 0:
		  Serial.print("00");
		  break;
		case 1:
		  Serial.print("01");
		  break;
		case 2:
		  Serial.print("02");
		  break;
		case 3:
		  Serial.print("03");
		  break;
		case 4:
		  Serial.print("04");
		  break;
		case 5:
		  Serial.print("05");
		  break;
		case 6:
		  Serial.print("06");
		  break;
		case 7:
		  Serial.print("07");
		  break;
		case 8:
		  Serial.print("08");
		  break;
		case 9:
		  Serial.print("09");
		  break;	 
	}
	}
	else{
	Serial.print(now.hour(), DEC);
	}

    Serial.print(":");
   
    if(now.minute()<10){
	switch (now.minute()) 
    {
		case 0:
		  Serial.print("00");
		  break;
		case 1:
		  Serial.print("01");
		  break;
		case 2:
		  Serial.print("02");
		  break;
		case 3:
		  Serial.print("03");
		  break;
		case 4:
		  Serial.print("04");
		  break;
		case 5:
		  Serial.print("05");
		  break;
		case 6:
		  Serial.print("06");
		  break;
		case 7:
		  Serial.print("07");
		  break;
		case 8:
		  Serial.print("08");
		  break;
		case 9:
		  Serial.print("09");
		  break;
		 
	}
	}
	else{
	Serial.print(now.minute(), DEC);
	}

    Serial.print(":");
 
    if(now.second()<10){
	switch (now.second()) 
    {
		case 0:
		  Serial.print("00");
		  break;
		case 1:
		  Serial.print("01");
		  break;
		case 2:
		  Serial.print("02");
		  break;
		case 3:
		  Serial.print("03");
		  break;
		case 4:
		  Serial.print("04");
		  break;
		case 5:
		  Serial.print("05");
		  break;
		case 6:
		  Serial.print("06");
		  break;
		case 7:
		  Serial.print("07");
		  break;
		case 8:
		  Serial.print("08");
		  break;
		case 9:
		  Serial.print("09");
		  break;
		 
	}
	}
	else{
	Serial.print(now.second(), DEC);
	}

    Serial.println("");
    
}
	
	//!******************************************************************************
	//!	Name:	readtemperature()																*
	//!	Description: Read temperature														*
	//!	Param : void																			*
	//!	Returns: temperature																	*
	//!	Example: OpenAquarium.readtemperature();											*
	//!******************************************************************************

	float OpenAquariumClass::readtemperature(void)
	{

	//returns the temperature from one DS18S20 in DEG Celsius

	sensors.requestTemperatures(); // Send the command to get temperatures
	return sensors.getTempC(insideThermometer);
		
	}	
		
	//!******************************************************************************
	//!	Name:	sendPowerStrip()																*
	//!	Description: Send RF code															*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.sendPowerStrip(unsigned long plug);						*
	//!******************************************************************************
	void OpenAquariumClass::sendPowerStrip(unsigned long plug){
	//Retransmit the signal on pin 2
	RemoteSwitch::sendTelegram(plug,RF);
	          
	}
	
	//!******************************************************************************
	//!	Name:	lightON()																		*
	//!	Description: Turn ON the light														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.lightON();													*
	//!******************************************************************************
	void OpenAquariumClass::lightON(){
	//Turn ON the light 	
	analogWrite(light, 255);
	          
	}
	
	//!******************************************************************************
	//!	Name:	lightOFF()																		*
	//!	Description: Turn OFF the light														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.lightOFF();													*
	//!******************************************************************************
	void OpenAquariumClass::lightOFF(){
	//Turn OFF the light	
	analogWrite(light, 0);
	          
	}
	
		
	//!******************************************************************************
	//!	Name:	lighting()																		*
	//!	Description: lighting program														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.lighting(DateTime now);										*
	//!******************************************************************************
	//Light control depending on hour of the day
	void OpenAquariumClass::lighting(DateTime now)
	{

	if (now.hour() == 1 || now.hour() ==2 || now.hour() ==23 || now.hour() ==0){
    analogWrite(light, 10);
    delay(15);       
    }     
	if (now.hour() == 3 || now.hour() ==22){
    analogWrite(light, 30);
    delay(15);       
    }   
	if (now.hour() == 4){
    analogWrite(light, 50);
    delay(15);       
    }  
	if (now.hour() == 5){
    analogWrite(light, 60);
    delay(15);       
    }        
	if (now.hour() == 6 || now.hour() ==21){
    analogWrite(light, 70);
    delay(15);       
    }     
	if (now.hour() == 7){
    analogWrite(light, 80);
    delay(15);       
    }        
	if (now.hour() == 8 || now.hour() == 20){
    analogWrite(light, 100);
    delay(15);       
    }  
	if (now.hour() == 9 || now.hour() == 19){
    analogWrite(light, 150);
    delay(15);       
    } 
	if (now.hour() == 10 || now.hour() == 18){
    analogWrite(light, 180);
    delay(15);       
    }  
	if (now.hour() == 11 || now.hour() == 17){
    analogWrite(light, 200);
    delay(15);       
    }  
	if (now.hour() == 12 || now.hour() == 16){
    analogWrite(light, 220);
    delay(15);       
    }  
	if (now.hour() == 13 || now.hour() == 14 || now.hour() == 15){
    analogWrite(light, 255);
    delay(15);      
    }	
		
	}
	
	//!******************************************************************************
	//!	Name:	fadelight()																	*
	//!	Description: Fade the light															*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.fadelight();													*
	//!******************************************************************************
	
	void OpenAquariumClass::fadelight(void){
		
	for(int i = 0; i<360; i++){
    //convert 0-360 angle to radian (needed for sin function)
    float rad = DEG_TO_RAD * i;

    //calculate sin of angle as number between 0 and 255
    int sinOut = constrain((sin(rad) * 128) + 128, 0, 255); 

    analogWrite(light, sinOut);

    delay(15);
		
	}
	
	analogWrite(light, 0);

	}
	
	
	//!******************************************************************************
	//!	Name:	tempcontrol()																	*
	//!	Description: Temperature control program											*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.tempcontrol(float temperature);							*
	//!******************************************************************************

	void OpenAquariumClass::tempcontrol(float temperature)
	{

	Serial.println("------------------------");
	Serial.println("Aquarium Status");

  
	//Heater Control - Heater in socket 5
	if(temperature<25 && temperature>0){ //>0 to avoid -999.00*C error   
    sendPowerStrip(codeon5);
    Serial.println("Heating...");   
     }
      
    if(temperature>26 || temperature<0){ //<0 to avoid -999.00*C error
    sendPowerStrip(codeoff5);
    Serial.println("Heater OFF");
    }
      
	//Cooling Fan Control - Fan in socket 4     
    if(temperature>27){
    sendPowerStrip(codeon4);
    Serial.println("Cooling...");
    }
    
    if(temperature<26){
    sendPowerStrip(codeoff4);
    Serial.println("Fan OFF");
    }
	
	//Alarm if temperature is to high 
	if(temperature>30){
    digitalWrite (buzzer,HIGH);
	delay(100);
	digitalWrite (buzzer,LOW);
	delay(100);
	digitalWrite (buzzer,HIGH);
	delay(100);
	digitalWrite (buzzer,LOW);
	delay(100);
    } 
	          
	}	
	
	//!******************************************************************************
	//!	Name:	leak()																			*
	//!	Description: Water leak program														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.leak();														*
	//!******************************************************************************

	void OpenAquariumClass::leak(void)
	{
	//Read analog pin and take measures
	medianvalue=0;
	for(int i=0;i<5;i++){
    medianvalue+=analogRead(AnalogPin);
	}
	medianvalue=trunc(medianvalue/5);
	//Voltage divider calculation
	voltageR2=(voltage/1023.0)*medianvalue;
	resistor=R1*(voltageR2/(voltage-voltageR2));

	if (voltageR2 < 4.95){
  
	Serial.println("------------------------");
	Serial.println("Water Leak Sensor");  
	Serial.println("Water Detected!");
	//Make alarm sound
	Serial.println("ALARM");
	alarm();
	//Turn Off All Pumps
	digitalWrite(pump2, LOW); 
	digitalWrite(pump1, LOW);
	digitalWrite(dpump3, LOW);
	digitalWrite(dpump2,LOW);
	digitalWrite(dpump1,LOW);
  
	}
	if (voltageR2 >=4.95){
	Serial.println("------------------------");
	Serial.println("Water Leak Sensor");
	Serial.println("NO Water Detected");
	delay(100);
	}
	          
	}	
	
	//!******************************************************************************
	//!	Name:	alarm()																		*
	//!	Description: Alarm																	*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.alarm();														*
	//!******************************************************************************

	void OpenAquariumClass::alarm(void)
	{

	digitalWrite (buzzer,HIGH);
	delay(100);
	digitalWrite (buzzer,LOW);
	delay(100);
	digitalWrite (buzzer,HIGH);
	delay(100);
	digitalWrite (buzzer,LOW);
	delay(100);
	digitalWrite (buzzer,HIGH);
	delay(100);
	digitalWrite (buzzer,LOW);
	delay(100);
	digitalWrite (buzzer,HIGH);
	delay(100);
	digitalWrite (buzzer,LOW);
	          
	}	
	
	//!******************************************************************************
	//!	Name:	newday()																		*
	//!	Description: Initialize all Variables												*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.newday();														*
	//!******************************************************************************

	void OpenAquariumClass::newday(void)
	{
	//Clear variables
	feed=0;
	waterchange=0;
	enteragain=0;
	dosingpump=0; 
	refill=0; 
	          
	}
	
	//!******************************************************************************
	//!	Name:	readyforfeeding()																*
	//!	Description: Initialize all Variables												*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.readyforfeeding();											*
	//!******************************************************************************

	void OpenAquariumClass::readyforfeeding(void)
	{
	//Clear feed variable in order to feed fish again
	feed=0;
		          
	}
	
	//!******************************************************************************
	//!	Name:	feedfish()																		*
	//!	Description: Feeding fish program													*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.feedfish();													*
	//!******************************************************************************

	void OpenAquariumClass::feedfish(void)
	{
  
	if (feed== 0){
    
	Serial.println("Feeding Fish...");
	digitalWrite(feeder, HIGH); //Turn On Fish Feeder
	aux = false;
	feed=1; //Variable to do only one time per day
	delay(2000);
	}
	feederstatus = digitalRead(feederpos); //Test only one Round
	if (feederstatus == LOW && aux){
	digitalWrite(feeder,LOW);
	aux = false;
	}


	aux = true;

	}		
	
	//!******************************************************************************
	//!	Name:	empty()																		*
	//!	Description: Empty the aquarium														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.empty();														*
	//!******************************************************************************

	void OpenAquariumClass::empty(void)
	{

		if (waterchange==0 || enteragain==1){
		enteragain=1; // Variable to allow to enter in this function althoungh the minutes are differents
		digitalWrite(pump1, HIGH); //Turn On Empty Pump 1 
		Serial.println("Removing Aquarium Water...");
		levelstatus2 = digitalRead(level2); //Test Bucket Level
   
	if (levelstatus2==HIGH){   //Empty Level is Correct
		Serial.println("Bucket full");
		digitalWrite(pump1, LOW); //Turn Off Empty Pump
		delay(100);
	if (dosingpump==0){
		for (int i =0; i<dosingdrop1; i++){ 
			digitalWrite(dpump1, HIGH);  //Turn On Dosing Pump 1
			delay(100);
			digitalWrite(dpump1,LOW); 
			delay(1000);
			}
  
		for (int j =0; j<dosingdrop2; j++){ 
			digitalWrite(dpump2, HIGH);  //Turn On Dosing Pump 2
			delay(100);
			digitalWrite(dpump2,LOW); 
			delay(1000);
			}
			
		for (int k =0; k<dosingdrop3; k++){ 
			digitalWrite(dpump3, HIGH);  //Turn On Dosing Pump 2
			delay(100);
			digitalWrite(dpump3,LOW); 
			delay(1000);
			}
				
    dosingpump=1; //Only one time Dosing Pumps
    digitalWrite(pump2, HIGH); //Turn On Pump 2 for Fill the Aquarium
    Serial.println("Returning Clean Water to the Aquarium...");
    refill=1; //Variable for the Fill Function
    waterchange=1; //Water Change Completed
    enteragain=0; //End 
   }  
  }  
}          
}	
	
	//!******************************************************************************
	//!	Name:	fill()																			*
	//!	Description: Fills the aquarium														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.fill();														*
	//!******************************************************************************

	void OpenAquariumClass::fill(void)
	{

	if (refill==1){
    levelstatus1 = digitalRead(level1); //Test Aquarium Level
   
    if (levelstatus1==HIGH){   //Reach Aquarium Level
      Serial.println("Aquarium Full");
      digitalWrite(pump2, LOW); //Turn Off Empty Pump
      delay(500);
      refill=0;
      }        
  }                  
}	


	//!******************************************************************************
	//!	Name:	pumpON()																		*
	//!	Description: Turns ON the pump														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.pumpON();														*
	//!******************************************************************************
	//Turn ON the pump 1 or 2
	void OpenAquariumClass::pumpON(int out)
	{

	if (out == 1) 
	{
		digitalWrite(pump1, HIGH);
	} 
	if (out == 2) 
	{
		digitalWrite(pump2, HIGH);
	}
		
	}
	
	//!******************************************************************************
	//!	Name:	pumpOFF()																		*
	//!	Description: Turns OFF the pump														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.pumpOFF();													*
	//!******************************************************************************
	//Turn OFF the pump 1 or 2
	void OpenAquariumClass::pumpOFF(int out)
	{

	if (out == 1) 
	{
		digitalWrite(pump1, LOW);
	} 
	if (out == 2) 
	{
		digitalWrite(pump2, LOW);
	}
		
	}
	
	//!******************************************************************************
	//!	Name:	perpumpON()																	*
	//!	Description: Turns ON the peristaltic pump										*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.perpumpON();													*
	//!******************************************************************************
	//Turn ON the peristaltic pump 1, 2 or 3
	void OpenAquariumClass::perpumpON(int out)
	{

	if (out == 1) 
	{
		digitalWrite(dpump1, HIGH);
	} 
	if (out == 2) 
	{
		digitalWrite(dpump2, HIGH);
	}
	if (out == 3) 
	{
		digitalWrite(dpump3, HIGH);
	}
		
	}
	
	//!******************************************************************************
	//!	Name:	perpumpOFF()																	*
	//!	Description: Turns OFF the peristaltic pump										*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.perpumpOFF();												*
	//!******************************************************************************
	//Turn OFF the peristaltic pump 1, 2 or 3
	void OpenAquariumClass::perpumpOFF(int out)
	{

	if (out == 1) 
	{
		digitalWrite(dpump1, LOW);
	} 
	if (out == 2) 
	{
		digitalWrite(dpump2, LOW);
	}
	if (out == 3) 
	{
		digitalWrite(dpump3, LOW);
	}
		
	}
	
	
	//!******************************************************************************
	//!	Name:	waterlevel1()																	*
	//!	Description: Reads water level 1													*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.waterlevel1();												*
	//!******************************************************************************
	//Read digital pin of waterlevel 1 and compare
	void OpenAquariumClass::waterlevel1(void)
	{

	Serial.println("------------------------");
	Serial.println("Water Level Control");
	levelstatus1 = digitalRead(level1);
		if (levelstatus1==HIGH){
		Serial.println("Level 1 - Aquarium Full");
		}
 
		if (levelstatus1==LOW){
		Serial.println("Level 1 - Aquarium Empty");
		}
		
	}
	
	//!******************************************************************************
	//!	Name:	waterlevel2()																	*
	//!	Description: Reads water level 2													*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.waterlevel2();												*
	//!******************************************************************************
	//Read digital pin of waterlevel 2 and compare
	void OpenAquariumClass::waterlevel2(void)
	{

	Serial.println("------------------------");
	levelstatus2 = digitalRead(level2);
		if (levelstatus2==HIGH){
		Serial.println("Level 2 - Bucket Full");
		}
 
		if (levelstatus2==LOW){
		Serial.println("Level 2 - Bucket Empty");
		}
 
}

	//!******************************************************************************
	//!	Name:	readwaterlevel()																*
	//!	Description: Reads water level														*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.readwaterlevel();											*
	//!******************************************************************************
	//Read digital pin 1 or 2
	int OpenAquariumClass::readwaterlevel(int out)
	{

	if (out == 1) 
	{
		digitalRead(level1);	
		
	} 
	if (out == 2) 
	{
		digitalRead(level2);
	}
		
		
 
}
	
	//!******************************************************************************
	//!	Name:	playTone()																		*
	//!	Description: Play song tone															*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.playTone();													*
	//!******************************************************************************

	void OpenAquariumClass::playTone(void)
	{

	long elapsed_time = 0;
	if (toneM > 0) { // if this isn't a Rest beat, while the tone has 
    //  played less long than 'duration', pulse speaker HIGH and LOW
    while (elapsed_time < duration) {
 
      digitalWrite(buzzer,HIGH);
      delayMicroseconds(toneM / 2);
 
      // DOWN
      digitalWrite(buzzer, LOW);
      delayMicroseconds(toneM / 2);
 
      // Keep track of how long we pulsed
      elapsed_time += (toneM);
    } 
  
  }
	else { // Rest beat; loop times delay
    for (int j = 0; j < rest_count; j++) { // See NOTE on rest_count
      delayMicroseconds(duration);  
    }                                
  }                                 
}		
		
	//!******************************************************************************
	//!	Name:	openingsong()																	*
	//!	Description: Opening song															*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.openingsong();												*
	//!******************************************************************************

	void OpenAquariumClass::openingsong(void)
	{

	for (int i=0; i<MAX_COUNT; i++) {
    toneM = melody1[i];
    beat = beats1[i];
 
    duration = beat * tempo; // Set up timing
 
    playTone(); // A pause between notes
    delayMicroseconds(pause);
    } 
 
	}

	//!******************************************************************************
	//!	Name:	calibratepH()																	*
	//!	Description: pH calibration															*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.calibratepH();												*
	//!******************************************************************************
	void OpenAquariumClass::calibratepH(int _calibration_point_4,int _calibration_point_7,int _calibration_point_10){
	calibration_point_10 = _calibration_point_10;
	calibration_point_7 = _calibration_point_7;
	calibration_point_4 = _calibration_point_4;
}

	//!******************************************************************************
	//!	Name:	readpH()																		*
	//!	Description: returns pH value														*
	//!	Param : void																			*
	//!	Returns: int																			*
	//!	Example: OpenAquarium.readpH();														*
	//!******************************************************************************

	int OpenAquariumClass::readpH(){

	float value_array[FILTER_SAMPLES];

	pinMode(ecPowerPin,OUTPUT);
	digitalWrite(ecPowerPin,LOW);
	delay(100);
	pinMode(pHPowerPin,OUTPUT);

	digitalWrite(pHPowerPin,HIGH);
	delay(100);

	// Take some measurements to filter the signal noise and glitches
	for(int i = 0; i < FILTER_SAMPLES; i++)
	{
    //Read from the ADC channel selected
    value_array[i] = analogRead(pHLevelPin);
	}

	delay(100);

	pH = myFilter.median(value_array,FILTER_SAMPLES);
  
	digitalWrite(pHPowerPin,LOW);
  
	pinMode(pHPowerPin,INPUT);
	delay(100);

	return (pH*5000.0)/1024.0; 
}

	//!******************************************************************************
	//!	Name:	pHConversion()																*
	//!	Description: pH conversion															*
	//!	Param : void																			*
	//!	Returns: float																		*
	//!	Example: OpenAquarium.pHConversion(int);											*
	//!******************************************************************************

	float OpenAquariumClass::pHConversion(int _mvpH) {
	float sensitivity;
	// Two ranges calibration
	if (_mvpH > calibration_point_7 ) {
    // The sensitivity is calculated using the other two calibration values
    // Asumme that the pH sensor is lineal in the range.
    // sensitivity = pHVariation / volts
    // Divide by 3 = (pH) 7 - (pH) 4
    sensitivity = (calibration_point_4-calibration_point_7)/3;

    // The value at pH 7.0 is taken as reference
    // => Units balance => 7 (pH) + (volts) / ((pH) / (volts))
    return 7.0 + (calibration_point_7-_mvpH) / sensitivity;
    // | |
    // (pH 7 voltage - Measured volts) = Variation from the reference
	} 
	else {
    // The sensitivity is calculated using the other two calibration values
    sensitivity = (calibration_point_7-calibration_point_10) / 3;

    return 7.0 + (calibration_point_7-_mvpH)/sensitivity;
	}

}

	//!******************************************************************************
	//!	Name:	calibrateEC																	*
	//!	Description: EC calibration															*
	//!	Param : void																			*
	//!	Returns: void																			*
	//!	Example: OpenAquarium.calibrateEC(float,float,float,float);						*
	//!******************************************************************************

	void OpenAquariumClass::calibrateEC(float _point_1_cond,float _point_1_cal,float _point_2_cond,float _point_2_cal){
	point_1_cond = _point_1_cond;
	point_1_cal = _point_1_cal;
	point_2_cond = _point_2_cond;
	point_2_cal = _point_2_cal;
	}

	//!******************************************************************************
	//!	Name:	ECConversion																	*
	//!	Description: Makes EC conversion													*
	//!	Param : void																			*
	//!	Returns: float																		*
	//!	Example: OpenAquarium.ECConversion(unsigned long);								*
	//!******************************************************************************

	float OpenAquariumClass::ECConversion(unsigned long _resistanceEC) {
	float value;
	float SW_condK;
	float SW_condOffset;

	// Calculates the cell factor of the conductivity sensor and the offset from the calibration values
	SW_condK = point_1_cond * point_2_cond * ((point_1_cal-point_2_cal)/(point_2_cond-point_1_cond));
	SW_condOffset = (point_1_cond * point_1_cal-point_2_cond*point_2_cal)/(point_2_cond-point_1_cond);

	// Converts the resistance of the sensor into a conductivity value
	value = SW_condK * 1 / (_resistanceEC+SW_condOffset);

	return value;
}

	//!******************************************************************************
	//!	Name:	readResistanceEC																*
	//!	Description: returns EC measure														*
	//!	Param : void																			*
	//!	Returns: float																		*
	//!	Example: OpenAquarium.readResistanceEC();											*
	//!******************************************************************************

	float OpenAquariumClass::readResistanceEC(void) {
	//Check if sensorPowerPin is HIGH or LOW because
	//sensorPowerPin and ecPowerPin NEVER must be connected at the same time
	pinMode(ecPowerPin,OUTPUT);
	pinMode(pHPowerPin,OUTPUT);
	digitalWrite(pHPowerPin,LOW);
	delay(100);
	digitalWrite(ecPowerPin,HIGH);
	delay(100);
    float ecmeasure = calculateResistanceEC();
    digitalWrite(ecPowerPin, LOW);
    digitalWrite(pHPowerPin, HIGH);
    
    pinMode(pHPowerPin,INPUT);
	digitalWrite(ecPowerPin,LOW);
	delay(100);
	  
    return ecmeasure;
  }

	//!******************************************************************************
	//!	Name:	calculateResistanceEC														*
	//!	Description: Calculate EC resistance												*
	//!	Param : void																			*
	//!	Returns: float																		*
	//!	Example: OpenAquarium.calculateResistanceEC();									*
	//!******************************************************************************

	float OpenAquariumClass::calculateResistanceEC(void) {

	float value_array[FILTER_SAMPLES];
	// Take some measurements to filter the signal noise and glitches
	for(int i = 0; i < FILTER_SAMPLES; i++)
	{
    //Read from the ADC channel selected
    value_array[i] = analogRead(ecLevelPin);
	}

	delay(100);

	EC = myFilter.median(value_array,FILTER_SAMPLES);


  if(EC <= 11){
    resistance = EC/0.050;
  }
  else if((EC > 11) && (EC <= 23)){
    resistance = ((EC-0.44)/0.0480);
  }
  else if((EC > 23) && (EC <= 47)){
    resistance = ((EC-1.7170)/0.0453);
  }
  else if((EC > 47) && (EC <= 94)){
    resistance = ((EC-7.8333)/0.0392);
  }
  else if((EC > 94) && (EC <= 162)){
    resistance = ((EC-34.16)/0.0272);
  }
  else if((EC > 162) && (EC <= 186)){
    resistance = ((EC-36.667)/0.0267);
  }
  else if((EC > 186) && (EC <= 259)){
    resistance = ((EC-93.0909)/0.0161);
  }
  else if((EC > 259) && (EC <= 310)){
    resistance = ((EC-157.0)/0.0102);
  }
  else if((EC > 310) && (EC <= 358)){
    resistance = ((EC-207.1429)/0.0069);
  }
  else if((EC > 358) && (EC <= 401)){
    resistance = ((EC-272.0)/0.0039);
  }
  else if((EC > 401) && (EC <= 432)){
    resistance = ((EC-327.9286)/0.0022);
  }
  else if((EC > 432) && (EC <= 458)){
    resistance = ((EC-373.8095)/0.0012);
  }
  else if((EC > 458) && (EC <= 479)){
    resistance = ((EC-413.3750)/0.0007);
  }
  else if((EC > 479) && (EC <= 525)){
    resistance = ((EC-473.8889)/0.0001);
  }
  else if(EC > 525){
    resistance = ((EC-525.7778)/0.00001);
  }

  return resistance;
}

OpenAquariumClass OpenAquarium;
