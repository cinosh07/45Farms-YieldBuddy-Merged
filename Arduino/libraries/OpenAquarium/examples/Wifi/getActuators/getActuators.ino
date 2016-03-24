#include "OpenAquarium.h"
#include "Wire.h"

char recv[512];
int cont;

char pump1_wf;
char pump2_wf;

char peristalticPump1_wf;
char peristalticPump2_wf;
char peristalticPump3_wf;

char socket1_wf;
char socket2_wf;
char socket3_wf;
char socket4_wf;
char socket5_wf;

char feederFish_wf;

char ledLight_wf;


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
  OpenAquarium.init();    //Initialize sensors power 
  cleanVector();
  wificonfig();

}

void loop() {
  
 
  getActuators();

  Serial.println();
  
   if (pump1_wf == '0'){
    OpenAquarium.pumpOFF(1); //Turn OFF the pump number 1
    Serial.print(F("Pump 1: OFF"));
  }
  else if (pump1_wf == '1'){
    OpenAquarium.pumpON(1); //Turn ON the pump number 1
    Serial.print(F("Pump 1: ON"));
  }
  else{
    Serial.print(F("Pump 1 BAD DATA"));
  }
  
  if (pump2_wf == '0'){
    OpenAquarium.pumpOFF(1); //Turn OFF the pump number 2
    Serial.print(F("Pump 2: OFF"));
  }
  else if (pump2_wf == '1'){
    OpenAquarium.pumpON(2); //Turn ON the pump number 2
   Serial.print(F("Pump 2: ON"));
  }
  else{
    Serial.print(F("Pump 2 BAD DATA"));
  }
    
  if (peristalticPump1_wf == '0'){
    OpenAquarium.perpumpOFF(1); //Turn OFF the peristaltic pump number 1 
    Serial.print(F("Peristaltic pump 1: OFF"));
  }
  else if (peristalticPump1_wf == '1'){
    OpenAquarium.perpumpON(1); //Turn ON the peristaltic pump number 1 
    Serial.print(F("Peristaltic pump 1: ON"));
  }
  else{
    Serial.print(F("Peristaltic pump 1 BAD DATA"));
  }


  if (peristalticPump2_wf == '0'){
    OpenAquarium.perpumpOFF(2); //Turn OFF the peristaltic pump number 2
    Serial.print(F("Peristaltic pump 2: OFF"));
  }
  else if (peristalticPump2_wf == '1'){
    OpenAquarium.perpumpON(2); //Turn ON the peristaltic pump number 2
   Serial.print(F("Peristaltic pump 2: ON"));
  }
  else{
    Serial.print(F("Peristaltic pump 2 BAD DATA"));
  }


  if (peristalticPump3_wf == '0'){
    OpenAquarium.perpumpOFF(3); //Turn OFF the peristaltic pump number 3
     Serial.print(F("Peristaltic pump 3: OFF"));
  }
  else if (peristalticPump3_wf == '1'){
    OpenAquarium.perpumpON(3); //Turn ON the peristaltic pump number 3
    Serial.print(F("Peristaltic pump 3: ON"));
  }
  else{
    Serial.print(F("Peristaltic pump 3 BAD DATA"));
  }
  
  if (socket1_wf == '0'){
    OpenAquarium.sendPowerStrip(off1); //Turn OFF plug 1
    Serial.print(F("Socket 1: OFF"));
  }
  else if (socket1_wf == '1'){
    OpenAquarium.sendPowerStrip(on1); //Turn ON plug 1
   Serial.print(F("Socket 1: ON"));
  }
  else{
    Serial.print(F("Socket 1 BAD DATA"));
  }
  
  if (socket2_wf == '0'){
    OpenAquarium.sendPowerStrip(off2); //Turn OFF plug 2
    Serial.print(F("Socket 2: OFF"));
  }
  else if (socket2_wf == '1'){
    OpenAquarium.sendPowerStrip(on2); //Turn ON plug 2
    Serial.print(F("Socket 2: ON"));
  }
  else{
   Serial.print(F("Socket 2 BAD DATA"));
  }
  
  if (socket3_wf == '0'){
    OpenAquarium.sendPowerStrip(off3); //Turn OFF plug 3
    Serial.print(F("Socket 3: OFF"));
  }
  else if (socket3_wf == '1'){
    OpenAquarium.sendPowerStrip(on3); //Turn ON plug 3
    Serial.print(F("Socket 3: ON"));
  }
  else{
    Serial.print(F("Socket 3 BAD DATA"));
  }
  
  if (socket4_wf == '0'){
    OpenAquarium.sendPowerStrip(off4); //Turn OFF plug 4
    Serial.print(F("Socket 4: OFF"));
  }
  else if (socket4_wf == '1'){
    OpenAquarium.sendPowerStrip(on4); //Turn ON plug 4
    Serial.print(F("Socket 4: ON"));
  }
  else{
    Serial.print(F("Socket 4 BAD DATA"));
  }
  
  if (socket5_wf == '0'){
    OpenAquarium.sendPowerStrip(off5); //Turn OFF plug 5
    Serial.print(F("Socket 5: OFF"));
  }
  else if (socket5_wf == '1'){
    OpenAquarium.sendPowerStrip(on5); //Turn ON plug 5
    Serial.print(F("Socket 5: ON"));
  }
  else{
    Serial.print(F("Socket 5 BAD DATA"));
  }
  
  
  
  if (ledLight_wf == '0'){
    OpenAquarium.lightOFF(); //Turn OFF plug 5
    Serial.print(F("Light: OFF"));
  }
  else if (ledLight_wf == '1'){
    OpenAquarium.lightON(); //Turn ON plug 5
    Serial.print(F("Light: ON"));
  }
  else{
    Serial.print(F("Led Light BAD DATA"));
  }
  
  if (feederFish_wf == '1'){
    OpenAquarium.feedfish();
    Serial.print(F("Feeding fishes"));
    enterCMD();
    sendfeederstatus();
    delay(500);
  }
  else if (feederFish_wf == '0'){
    OpenAquarium.readyforfeeding();    
    Serial.print(F("Feeder OFF"));
  }
  else{
    Serial.print(F("Fish Feeder BAD DATA"));
  }
    
  
  cleanVector();
  enterCMD();

  delay(5000);
}

void cleanVector(){
  recv[0] = 0; 
  recv[1] = 0;
  recv[2] = 0;
  recv[3] = 0; 
  recv[4] = 0;
  recv[5] = 0;
  recv[6] = 0;
  recv[7] = 0;
  recv[8] = 0;
  recv[9] = 0;
  recv[10] = 0;
  recv[11] = 0;
 
 
  
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

void getActuators(){
  Serial.print("set dns name 192.168.1.64\r");
  check(); //Insert here your IP
  //Configures HTTP connection
  Serial.print("set ip adress 0\r"); 
  check();

  Serial.print("set i r 80\r"); 
  check();
  Serial.print("set com remote 0\r"); 
  check();
  Serial.print("open\r"); 
  check();
  Serial.flush(); 
  Serial.print("GET /OpenAquarium/get_actuators.php\r"); 
  checkData();


}

void enterCMD(){
  Serial.println(""); //To see clearer when debugging
  // Enters in command mode
  Serial.print(F("$$$")); 
  delay(100);
  check();
  Serial.flush();
}

void check(){
  delay(1000);
  autoflush(); 
}


void checkData(){
  cont=0;   
  delay(3000);
  while (Serial.available()>0)
  {
    recv[cont]=Serial.read(); 
    delay(10);
    cont++;
  }
  recv[cont]='\0';

  pump1_wf= recv[0]; 
  pump2_wf= recv[1];
  peristalticPump1_wf= recv[2];
  peristalticPump2_wf= recv[3]; 
  peristalticPump3_wf= recv[4];
  socket1_wf= recv[5];
  socket2_wf= recv[6];
  socket3_wf= recv[7];
  socket4_wf= recv[8];
  socket5_wf= recv[9];
  feederFish_wf= recv[10]; 
  ledLight_wf= recv[11];

  
  

  //Serial.print("Received:");
  //Serial.print(recv);

  autoflush(); 
  delay(100);
}


void autoflush()
{
  while (Serial.available()>0)
  {
    Serial.read(); 
  }
}

void sendfeederstatus(){
  Serial.print(F(" set i h 0\r"));
  check();
  Serial.print(F("set d n 192.168.1.64\r"));
  check(); //Insert here your IP

  //Configures HTTP connection
  Serial.print(F("set i r 80\r")); 
  check();

  Serial.print(F("set o f 1\r")); 
  check();

 
  Serial.print(F("set c r GET$/OpenAquarium/stop_feeder.php\r"));
  check();

  // Calls open to launch the configured connection.
  Serial.print(F("open\r")); 
  check();
}

