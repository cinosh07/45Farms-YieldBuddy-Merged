/*
 *  OpenAquarium platform for Arduino and Raspberry from Cooking-hacks.
 *
 *  Description: "The OpenAquarium Shield allows Arduino and Raspberry Pi 
 *  users to perform ..."
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
 *  Version 1.0
 *  Author: Marcos Martínez
 */


// Ensure this library description is only included once
#ifndef OpenAquariumClass_included
#define OpenAquariumClass_included

#include "Arduino.h"
#include "Wire.h"
#include "RemoteReceiver.h"
#include "RemoteSwitch.h"
#include "OneWire.h"
#include "RTClib.h"
#include "DallasTemperature.h"
#include "filter.h"

#define pHPowerPin 8
#define ecPowerPin 9

#define FILTER_SAMPLES   7

#define RF			  2
#define pump2 	      3
#define pump1  		  4
#define buzzer 		  5
#define light  		  6
#define level1 		  7
#define level2		  8
#define dpump3 		  9
#define dpump2 		 10
#define dpump1 		 11
#define ONE_WIRE_BUS 12
#define feeder		 13
#define pHLevelPin   A1
#define ecLevelPin 	 A0
#define feederpos	 16
#define AnalogPin 	  3
#define RTC4		  4
#define RTC5		  5

//Number of drops of each peristaltic pump
#define dosingdrop1 5
#define dosingdrop2 10
#define dosingdrop3 15

//RF Codes
#define codeon1   1597145202
#define codeoff1  1597145204
#define codeon2   1597145220
#define codeoff2  1597145222
#define codeon3   1597145112
#define codeoff3  1597145114
#define codeon4   1597144950
#define codeoff4  1597144952
#define codeon5   1597144464
#define codeoff5  1597144466

//Conductive Fluid Sensing Cable
#define voltage 5.0
#define R1 1500.0

#define MON 1
#define TUE 2
#define WED 3
#define THU 4
#define FRI 5
#define SAT 6
#define SUN 7	

//Buzzer Notes
#define  c3    7634
#define  d3    6803
#define  e3    6061
#define  f3    5714
#define  g3    5102
#define  a3    4545
#define  b3    4049
#define  c4    3816    // 261 Hz 
#define  d4    3401    // 294 Hz 
#define  e4    3030    // 329 Hz 
#define  f4    2865    // 349 Hz 
#define  g4    2551    // 392 Hz 
#define  a4    2272    // 440 Hz 
#define  a4s   2146
#define  b4    2028    // 493 Hz 
#define  c5    1912    // 523 Hz
#define  d5    1706
#define  d5s   1608
#define  e5    1517    // 659 Hz
#define  f5    1433    // 698 Hz
#define  g5    1276
#define  a5    1136
#define  a5s   1073
#define  b5    1012
#define  c6    955
#define  R     0      // Define a special note, 'R', to represent a rest


// Library interface description
class OpenAquariumClass {
	
	public: 
  
	//***************************************************************
	// Constructor of the class										*
	//***************************************************************
  
		//! Class constructor.
		OpenAquariumClass();
		 
	//***************************************************************
	// Public Methods												*
	//***************************************************************

		//Initialize all
		void init(void);
		
		//Initialize all ports
		void initports(void);
		
		//Initializing necessary for sensor DS18B20
		void initDS18B20(void);    
		
		void welcome(void);
  
		//RTC 	
		void initRTC(void);	      //Initializing necessary for the RTC
		void setTime(void); 	      //Get the computer's time and date
		DateTime getTime(void);		  //Get a struct with current time and date
		void printTime(DateTime now); //Serial print the struct obtained with getTime
										
		// Send RF code
		void sendPowerStrip(unsigned long plug); //Send a signal to turn on or off a plug	
		

		float readtemperature(void );				//Read temperature values
		void lighting(DateTime now);				//Lighting program depending on day's hour
		void fadelight(void);						//Fade light program
		void lightON(void);						//Turn ON the light
		void lightOFF(void);						//Turn OFF the light
		void tempcontrol(float temperature);		//Temperature program between 25º-27º
		void leak(void);							//Warning water leak message with alarm
		void alarm(void);							//Amarm sound
		void newday(void);							//Delete variables
		void readyforfeeding(void);				//Prepare for feeding
		void feedfish(void);						//Make a rotation of the fish feeder
		void empty(void);							//water empty program
		void fill(void);							//Water fill program
		void waterlevel1(void);					//Message with water level 1 status
		void waterlevel2(void);					//Message with water level 2 status
		int readwaterlevel(int out);				//Read water level status
		void playTone(void);						//Play melody
		void openingsong(void);					//Opening melody
		void pumpON(int out);						//Turn OFF pump 1 or 2
		void pumpOFF(int out);						//Turn OFF pump 1 or 2
		void perpumpON(int out);					//Turn ON peristaltic pump 1,2 or 3
		void perpumpOFF(int out);					//Turn OFF peristaltic pump 1,2 or 3
				
		void calibratepH(int _calibration_point_4,int _calibration_point_7,int _calibration_point_10);
		int readpH();
		float pHConversion(int _mvpH);

		void calibrateEC(float _point_1_cond,float _point_1_cal,float _point_2_cond,float _point_2_cal);
		float readResistanceEC();
		float ECConversion(unsigned long _resistanceEC);

	private:

	//***************************************************************
	// Private Methods												*
	//***************************************************************


	float calculateResistanceEC(void);


	//***************************************************************
	// Private Variables											*
	//***************************************************************

	unsigned long plug;
	
	
	int EC;
	int pH;
	float resistance;
	
	float calibration_point_10;
	float calibration_point_7;
	float calibration_point_4;

	float point_1_cond;
	float point_1_cal;
	float point_2_cond;
	float point_2_cal;
	
	//Conductive Fluid Sensing Cable
	long medianvalue;
	float voltageR2;
	float resistor;
	
	
	//Float Switches
	int levelstatus1;
	int levelstatus2;
	
	//Fish Feeder
	int feederstatus;
	int feed;
	bool aux;
	
	// Initialize core variables
	int toneM;
	int beat;
	long duration;
	long tempo; // Set overall tempo
	int pause; // Set length of pause between notes
	int rest_count; // Loop variable to increase Rest length (BLETCHEROUS HACK; See NOTES)
	
	//Water changes
	int waterchange;
	int enteragain;
	int dosingpump;
	int refill;
	

};

extern OpenAquariumClass OpenAquarium;

#endif
