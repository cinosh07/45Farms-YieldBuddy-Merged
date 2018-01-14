

/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
 

#define NUM_READS 5

//The Arduino Map function but for floats
//From: http://forum.arduino.cc/index.php?topic=3922.0
float mapfloat(float x, float in_min, float in_max, float out_min, float out_max)
{
  return (x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
}


float readTemperature(int sensorpin){
   // read multiple values and sort them to take the mode
   int sortedValues[NUM_READS];
   for(int i=0;i<NUM_READS;i++){
     int value = analogRead(sensorpin);
     int j;
     if(value<sortedValues[0] || i==0){
        j=0; //insert at first position
     }
     else{
       for(j=1;j<i;j++){
          if(sortedValues[j-1]<=value && sortedValues[j]>=value){
            // j is insert position
            break;
          }
       }
     }
     for(int k=i;k>j;k--){
       // move all values higher than current reading up one position
       sortedValues[k]=sortedValues[k-1];
     }
     sortedValues[j]=value; //insert current reading
   }
   //return scaled mode of 10 values
   float returnval = 0;
   for(int i=NUM_READS/2-5;i<(NUM_READS/2+5);i++){
     returnval +=sortedValues[i];
   }
   returnval = returnval/10;
   return returnval*1100/1023;
}



float read_water_sensor (int tpin, int epin) {
  

  pinMode(tpin, OUTPUT);
  pinMode(epin, INPUT);
  
  //send trigger pulse
  digitalWrite(tpin, LOW); 
  delayMicroseconds(2);  
  digitalWrite(tpin, HIGH);
  delayMicroseconds(10); 
  digitalWrite(tpin, LOW);
  
  //measure time back
  duration = pulseIn(epin, HIGH,50000);

  //Calculate the distance (in inches) based on the speed of sound.
  distance = duration/148;

  // cap max distance - depth to bottom of water vessel 
  if (distance > 33){ 
    distance = 33;
  }
  
  else {
  
  // convert air space to water height
  water_height = 33-distance;
  // calculate volume of water in tank
  filledvolume = 132.25*3.14141414*(water_height);
  // convert to litres equivalent
  water_litres = filledvolume*0.01638706;
  // set return value to requirements
  echo = water_litres;

  return echo;
  
 }
}


//*****************************READ ALL SENSOR VALUES AND CONVERT FOR LCD DISPLAY********************************
void updateSensorValues() {
 
  analogReference(DEFAULT);  //Seems more accurate.
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
 
 
  /*PH1------------------------------------------------*/
#if defined(ph1_on)  
  float pH1Sum = 0;
  int j = 0;
  analogRead(pH1Pin);  //Get ADC to switch to correct pin
  delay(20); //Wait for Pin to Change  
  while(j<30) {
    pH1Sum = pH1Sum + analogRead(pH1Pin);
    j++;
  }
  pH1RawValue = pH1Sum/30;
  pH1Value = (pHSlope * pH1RawValue + pHOffset);
#else
  pH1RawValue = 0;
  pH1Value = 0;  
#endif    
  if(isnan(pH1Value)){
    pH1Value = 0;        
  }
  PString my_pH1_string(pH1_char, sizeof(pH1_char));
  if (pH1Value < 10){
    my_pH1_string.print(" "); 
    my_pH1_string.println(pH1Value);
  } 
  else {
    my_pH1_string.println(pH1Value);
  }
 
  /*PH2------------------------------------------------*/
#if defined(ph2_on)   
  float pH2Sum = 0;
  j = 0;
  analogRead(pH2Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change
  while(j<30) {
    pH2Sum = pH2Sum + analogRead(pH2Pin);
    j++;
  }
  pH2RawValue = pH2Sum/30;
  pH2Value = (pHSlope * pH2RawValue + pHOffset);
#else
  pH2RawValue = 0;
  pH2Value = 0;
#endif      
  if(isnan(pH2Value)){
    pH2Value = 0;        
  }
  PString my_pH2_string(pH2_char, sizeof(pH2_char));
  if (pH2Value < 20){
    my_pH2_string.print(" "); 
    my_pH2_string.println(pH2Value);
  } 
  else {
    my_pH2_string.println(pH2Value);
  }
  

 
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!TEMPERATURE SENSOR!!TEMPERATURE SENSOR!!TEMPERATURE SENSOR!!TEMPERATURE SENSOR!!TEMPERATURE SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
#if defined (dht_temp_on)
  TempRawValue = dht.readTemperature(); //to use the DHT22  
#if defined(dht_tempF_on)
  TempValue = (TempRawValue*9+2)/5+32;
#else  
  TempValue = TempRawValue;
#endif
#else
  TempRawValue = 0;
  TempValue = 0;
#endif

  if(isnan(TempValue)){
    TempValue = 0;        
  }
  PString my_Temp_string(Temp_char, sizeof(Temp_char));
  my_Temp_string.print(TempValue);
  my_Temp_string.println(" C"); 


  sensors.requestTemperatures();   
  //********************************WaterTempP1
#if defined (WaterTempP1_on)
  WaterTempP1RawValue = sensors.getTempC(WaterTempP1_addr);  
#if defined(WaterTempP1F_on)
  WaterTempP1Value = (WaterTempP1RawValue*9+2)/5+32;
#else  
  WaterTempP1Value = WaterTempP1RawValue;
#endif
#else
  WaterTempP1RawValue = 0;
  WaterTempP1Value = 0;
#endif

  if(isnan(WaterTempP1Value)){
    WaterTempP1Value = 0;        
  }
  PString my_WaterTempP1_string(WaterTempP1_char, sizeof(WaterTempP1_char));
  my_WaterTempP1_string.print(WaterTempP1Value);
  my_WaterTempP1_string.println(" C"); 

  //********************************WaterTempP2
#if defined (WaterTempP2_on)
  WaterTempP2RawValue = sensors.getTempC(WaterTempP2_addr);  
#if defined(WaterTempP2F_on)
  WaterTempP2Value = (WaterTempP2RawValue*9+2)/5+32;
#else  
  WaterTempP2Value = WaterTempP2RawValue;
#endif
#else
  WaterTempP2RawValue = 0;
  WaterTempP2Value = 0;
#endif

  if(isnan(WaterTempP2Value)){
    WaterTempP2Value = 0;        
  }
  PString my_WaterTempP2_string(WaterTempP2_char, sizeof(WaterTempP2_char));
  my_WaterTempP2_string.print(WaterTempP2Value);
  my_WaterTempP2_string.println(" C"); 

  //*********************************WaterTempP3
#if defined (WaterTempP3_on)
  WaterTempP3RawValue = sensors.getTempC(WaterTempP3_addr);  
#if defined(WaterTempP3F_on)
  WaterTempP3Value = (WaterTempP3RawValue*9+2)/5+32;
#else  
  WaterTempP3Value = WaterTempP3RawValue;
#endif
#else
  WaterTempP3RawValue = 0;
  WaterTempP3Value = 0;
#endif

  if(isnan(WaterTempP3Value)){
    WaterTempP3Value = 0;        
  }
  PString my_WaterTempP3_string(WaterTempP3_char, sizeof(WaterTempP3_char));
  my_WaterTempP3_string.print(WaterTempP3Value);
  my_WaterTempP3_string.println(" C"); 

  //**********************************WaterTempP4
#if defined (WaterTempP4_on)
  WaterTempP4RawValue = sensors.getTempC(WaterTempP4_addr);  
#if defined(WaterTempP4F_on)
  WaterTempP4Value = (WaterTempP4RawValue*9+2)/5+32;
#else  
  WaterTempP4Value = WaterTempP4RawValue;
#endif
#else
  WaterTempP4RawValue = 0;
  WaterTempP4Value = 0;
#endif

  if(isnan(WaterTempP4Value)){
    WaterTempP4Value = 0;        
  }
  PString my_WaterTempP4_string(WaterTempP4_char, sizeof(WaterTempP4_char));
  my_WaterTempP4_string.print(WaterTempP4Value);
  my_WaterTempP4_string.println(" C"); 
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 !!PING ALL WATER TANKS
 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

#if defined(tank1_on)
  Tank1RawValue = (read_water_sensor(Tank1TrigPin, Tank1EchoPin));
#else
  Tank1RawValue = 0;
  Tank1Value =0;
#endif

#if defined(tank2_on)
  Tank2RawValue = (read_water_sensor(Tank2TrigPin, Tank2EchoPin));
#else
  Tank2RawValue = 0;
  Tank2Value =0;
#endif

#if defined(tank3_on)
  Tank3RawValue = (read_water_sensor(Tank3TrigPin, Tank3EchoPin));
#else
  Tank3RawValue = 0;
  Tank3Value =0;
#endif

#if defined(tank4_on)
  Tank4RawValue = (read_water_sensor(Tank4TrigPin, Tank4EchoPin));
#else
  Tank4RawValue = 0;
  Tank4Value =0;
#endif

#if defined(tanktotal_on)  
  TankTotalRawValue = Tank1RawValue + Tank2RawValue + Tank3RawValue + Tank4RawValue;
#else
  TankTotalRawValue = 0;
  TankTotalValue = 0;
#endif  

  Tank1Value = Tank1RawValue;
  PString my_Tank1_string(Tank1_char, sizeof(Tank1_char));
  my_Tank1_string.print(Tank1Value);
  my_Tank1_string.println("L");
  
  Tank2Value = Tank2RawValue;
  PString my_Tank2_string(Tank2_char, sizeof(Tank2_char));
  my_Tank2_string.print(Tank2Value);
  my_Tank2_string.println("L"); 
     
  Tank3Value = Tank3RawValue;
  PString my_Tank3_string(Tank3_char, sizeof(Tank3_char));
  my_Tank3_string.print(Tank3Value);
  my_Tank3_string.println("L");  
  
  Tank4Value = Tank4RawValue;
  PString my_Tank4_string(Tank4_char, sizeof(Tank4_char));
  my_Tank4_string.print(Tank4Value);
  my_Tank4_string.println("L");
      
  TankTotalValue = TankTotalRawValue;
  PString my_TankTotal_string(TankTotal_char, sizeof(TankTotal_char));
  my_TankTotal_string.print(TankTotalValue);
  my_TankTotal_string.println("L");  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

#if defined (co2_on)  
  float CO2Sum = 0;
  int j = 0;
  analogRead(CO2Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change
  while(j<10) {
    CO2Sum = CO2Sum + analogRead(CO2Pin);
    j++;
  }
//  CO2RawValue = CO2Sum/((j-1) * 2);
  CO2RawValue = CO2Sum/(j-1);
//  CO2Value = ((CO2RawValue * 10)/1024.0);
  CO2Value = CO2RawValue;
#else
  CO2RawValue = 0;
  CO2Value = 0;
#endif  
  if(isnan(CO2Value)){
    CO2Value = 0;        
  }
  PString my_CO2_string(CO2_char, sizeof(CO2_char));
  my_CO2_string.print(CO2Value);
  my_CO2_string.println(" ppm"); 

  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 !!WATER LEVEL SENSOR! WATER LEVEL SENSOR! WATER LEVEL SENSOR! WATER LEVEL SENSOR! WATER LEVEL SENSOR! 
 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
#if defined(soilhumidity_on)
  float WaterSum = 0;
  int jj = 0;
  analogRead(WaterPin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change

  while(jj<10) {
    WaterSum = WaterSum + analogRead(WaterPin);
    jj++;
  } 
  WaterRawValue = WaterSum/(jj-1);
  
  if (WaterRawValue < 0){
    WaterRawValue = -WaterRawValue;
  }  
  //Use the 3.3V power pin as a reference to get a very accurate output value from sensor
  //Using Co2 pin for reference voltage input
  float outputVoltage = 3.3 / CO2Value * WaterRawValue;
 
  if (outputVoltage < 0){
    outputVoltage = -outputVoltage;
   } 
     
  float uvIntensity = mapfloat(outputVoltage, 0.99, 2.9, 0.0, 15.0);  

  WaterValue = uvIntensity;
#else
  WaterRawValue = 0;
  WaterValue = 0;
#endif
 
  if(isnan(WaterValue)){
    WaterValue = 0;        
  }
  PString my_water_string(Water_char, sizeof(Water_char));
  my_water_string.print(WaterValue);
  my_water_string.println("Percent"); 

//  if(isnan(WaterValue)){
    LevelFull = 2;        
//  }
//  PString my_level_string(Water_char, sizeof(Water_char));
//  my_level_string.print(WaterValue);
//  my_level_string.println("ohm"); 
   
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!HUMIDITY DHT11 SENSOR!!HUMIDITY DHT11 SENSOR!!HUMIDITY DHT11 SENSOR!!HUMIDITY DHT11 SENSOR!!HUMIDITY DHT11!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
#if defined(dht_humidity_on)
  dht.readHumidity();  //The DHT11 Sensor works differently, but for 'good measure'.
  delay(15); //Wait for Pin to Change
  RHRawValue = dht.readHumidity();
  RHValue = RHRawValue;
#else
  RHRawValue = 0;
  RHValue = 0;
#endif

  
  if (isnan(RHValue)) {
    RHValue = 0;
  } 
  PString my_RH_string(RH_char, sizeof(RH_char));
  my_RH_string.print(RHValue);

  if (RHValue < 10){
    my_RH_string.println("% "); 
  } 
  else {
    my_RH_string.println("%"); 
  }

// ******************AS3935*******************************

 // now get interrupt source
  uint8_t int_src = lightning0.AS3935_GetInterruptSrc();
  if(0 == int_src)
  {
    MagXValue = -1;
  }
  else if(1 == int_src)
  {
    //this value will be magz for now
    uint8_t lightning_dist_km = lightning0.AS3935_GetLightningDistKm();
//    Serial.print("Lightning detected! Distance to strike: ");
//    Serial.print(lightning_dist_km);
//    Serial.println(" kilometers");
    MagXValue = lightning_dist_km;
    // this value will me magY for now
    uint32_t nrgy_val = lightning0.AS3935_GetStrikeEnergyRaw();
//    Serial.print("Raw Energy: ");
//    Serial.println(nrgy_val);
    MagYValue = nrgy_val;
  }
  else if(2 == int_src)
  {
    Serial.println("Disturber detected");
    MagZValue = 63;
  }
  else if(3 == int_src)
  {
    Serial.println("Noise level too high");
    MagXValue = -5;
    MagYValue = -5;
    MagZValue = -5;
  }



  
// ******************magnetometer sensor******************

#if defined(magnetometer_on)
  MagnetometerScaled scaled = compass.ReadScaledAxis();  
  MagXRawValue = scaled.XAxis;
  MagYRawValue = scaled.YAxis;
  MagZRawValue = scaled.ZAxis;
//  MagXValue = MagXRawValue;
//  MagYValue = MagYRawValue;
//  MagZValue = MagZRawValue;
//  MagXValue = 0;
//  MagYValue = 0;
//  MagZValue = 0;  
#else
  MagXRawValue = 0;
  MagYRawValue = 0;
  MagZRawValue = 0;
  MagXValue = 0;
  MagYValue = 0;
  MagZValue = 0;
#endif

  PString my_MagX_string(MagX_char, sizeof(MagX_char));
  my_MagX_string.print(MagXValue);
  my_MagX_string.println("Guass");
  
  PString my_MagY_string(MagY_char, sizeof(MagY_char));
  my_MagY_string.print(MagYValue);
  my_MagY_string.println("Guass");
  
  PString my_MagZ_string(MagZ_char, sizeof(MagZ_char));
  my_MagZ_string.print(MagZValue);
  my_MagZ_string.println("Guass");
//******************************************************  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
#if defined (tds1_on)
  float TDS1Sum = 0;
  j = 0;
  analogRead(TDS1Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change

  while(j<10) {
    TDS1Sum = TDS1Sum + analogRead(TDS1Pin);
    j++;
  }

  TDS1RawValue = TDS1Sum/((j-1) * 2);
  TDS1Value = ((TDS1RawValue * 100.0)/1024.0);
#else
  TDS1RawValue = 0;
  TDS1Value = 0;
#endif
  
  if(isnan(TDS1Value)){
    TDS1Value = 0;        
  }
  PString my_TDS1_string(TDS1_char, sizeof(TDS1_char));
  my_TDS1_string.println(TDS1Value);
  my_TDS1_string.println(" ppm"); 
  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
#if defined (tds2_on)
  float TDS2Sum = 0;
  j = 0;
  analogRead(TDS2Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change
  while(j<10) {
    TDS2Sum = TDS2Sum + analogRead(TDS2Pin);
    j++;
  }
  TDS2RawValue = TDS2Sum/((j-1) * 2);
  TDS2Value = ((TDS2RawValue * 100.0)/1024.0);
#else
  TDS2RawValue = 0;
  TDS2Value = 0;
#endif

  if(isnan(TDS2Value)){
    TDS2Value = 0;        
  }
  PString my_TDS2_string(TDS2_char, sizeof(TDS2_char));
  my_TDS2_string.print(TDS2Value);
  my_TDS2_string.println(" ppm"); 
  

  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
 //******************************* GY-30 DIGITAL LIGHT SENSOR ***************************

#if defined(light_on)
  Wire.begin();
  BH1750_Init(BH1750_address); 
  delay(200);
  long valf=0;   
  if(BH1750_Read(BH1750_address)==2){
    
    valf=((buff[0]<<8)|buff[1])/1.2;
  }
  LightRawValue = valf; 
  if (LightRawValue < 0){
    LightRawValue = 100000;
  }
  if (hour() >= 7 && hour() <= 20 && LightRawValue == 0){
    LightRawValue = 100000;
          }
  if (hour() >= 21 && hour() <= 24 || hour() >= 0 && hour() < 7  && LightRawValue == 0){
    LightRawValue = 0;
          }
  else         
  LightValue = LightRawValue;
#else
  LightRawValue = 0;
  LightValue = 0;
#endif  
  if (isnan(LightValue)) {
    LightValue = 100000;
  } 
  PString my_Light_string(Light_char, sizeof(Light_char));
  my_Light_string.print(LightValue);
  if (LightValue < 10){
    my_Light_string.println("% "); 
  } 
  else {
    my_Light_string.println("%"); 
  }

 /***************************Status Indicator Tests******************************** 
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!ph!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
  

  //pH
  if (pH1Value < pH1Value_Low) {
    pH1_Status = "LOW";
  } 
  else if (pH1Value > pH1Value_Low && pH1Value < pH1Value_High) {
    pH1_Status = "OK";
  } 
  else if (pH1Value > pH1Value_High) {
    pH1_Status = "HIGH";
  }


  if (pH2Value < pH2Value_Low) {
    pH2_Status = "LOW";
  } 
  else if (pH2Value > pH2Value_Low && pH2Value < pH2Value_High) {
    pH2_Status = "OK";
  } 
  else if (pH2Value > pH2Value_High) {
    pH2_Status = "HIGH";
  }
  

   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!temp!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
   

  //Temp
  if (TempValue < TempValue_Low) {
    Temp_Status = "LOW";
  } 
  else if (TempValue > TempValue_Low && TempValue < TempValue_High) {
    Temp_Status = "OK";
  } 
  else if (TempValue > TempValue_High) {
    Temp_Status = "HIGH";
  }


   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!level!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/  
  
  //Level
//  if (WaterValue == 0){
//   Level_Status = "Low"; 
//  }
//  else if (WaterValue == 1){
//   Level_Status = "Full"; 
//  }  
//  else if (WaterValue == 2){
//   Level_Status = "Unknown"; 
//  }

  //Water
  if (WaterValue < WaterValue_Low) {
    Water_Status = "LOW";
  } 
  else if (WaterValue > WaterValue_Low && WaterValue < WaterValue_High) {
    Water_Status = "OK";
  } 
  else if (WaterValue > WaterValue_High) {
    Water_Status = "HIGH";
  }
  

   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!RH!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

  
  //RH
  if (RHValue < RHValue_Low) {
    RH_Status = "LOW";
  } 
  else if (RHValue > RHValue_Low && RHValue < RHValue_High) {
    RH_Status = "OK";
  }
  else if (RHValue > RHValue_High) {
    RH_Status = "HIGH";
  }

    /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!TDS!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/ 
  
  //TDS1
  if (TDS1Value < TDS1Value_Low) {
    TDS1_Status = "LOW";
  } 
  else if (TDS1Value > TDS1Value_Low && TDS1Value < TDS1Value_High) {
    TDS1_Status = "OK";
  } 
  else if (TDS1Value > TDS1Value_High) {
    TDS1_Status = "HIGH";
  }
  
  //TDS2
  if (TDS2Value < TDS2Value_Low) {
    TDS2_Status = "LOW";
  } 
  else if (TDS2Value > TDS2Value_Low && TDS2Value < TDS2Value_High) {
    TDS2_Status = "OK";
  } 
  else if (TDS2Value > TDS2Value_High) {
    TDS2_Status = "HIGH";
  }

   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!CO2!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
  
  //CO2
  if (CO2Value < CO2Value_Low) {
    CO2_Status = "LOW";
  } 
  else if (CO2Value > CO2Value_Low && CO2Value < CO2Value_High) {
    CO2_Status = "OK";
  } 
  else if (CO2Value > CO2Value_High){
    CO2_Status = "HIGH";
  }

   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!LIGHT!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
  
  //Light
  if (LightValue < LightValue_Low) {
    Light_Status = "LOW";
  } 
  else if (LightValue > LightValue_Low && LightValue < LightValue_High) {
    Light_Status = "OK";
  } 
  else if (LightValue > LightValue_High) {
    Light_Status = "HIGH";
  }

  //TankTotal
  if (TankTotalValue < TankTotalValue_Low) {
    TankTotal_Status = "LOW";
  } 
  else if (TankTotalValue > TankTotalValue_Low && TankTotalValue < TankTotalValue_High) {
    TankTotal_Status = "OK";
  } 
  else if (TankTotalValue > TankTotalValue_High) {
    TankTotal_Status = "HIGH";
  }

  //Tank1
  if (Tank1Value < Tank1Value_Low) {
    Tank1_Status = "LOW";
  } 
  else if (Tank1Value > Tank1Value_Low && Tank1Value < Tank1Value_High) {
    Tank1_Status = "OK";
  } 
  else if (Tank1Value > Tank1Value_High) {
    Tank1_Status = "HIGH";
  }

  //Tank2
  if (Tank2Value < Tank2Value_Low) {
    Tank2_Status = "LOW";
  } 
  else if (Tank2Value > Tank2Value_Low && Tank2Value < Tank2Value_High) {
    Tank2_Status = "OK";
  } 
  else if (Tank2Value > Tank2Value_High) {
    Tank2_Status = "HIGH";
  }

  //Tank3
  if (Tank3Value < Tank3Value_Low) {
    Tank3_Status = "LOW";
  } 
  else if (Tank3Value > Tank3Value_Low && Tank3Value < Tank3Value_High) {
    Tank3_Status = "OK";
  } 
  else if (Tank3Value > Tank3Value_High) {
    Tank3_Status = "HIGH";
  }

  //Tank4
  if (Tank4Value < Tank4Value_Low) {
    Tank4_Status = "LOW";
  } 
  else if (Tank4Value > Tank4Value_Low && Tank4Value < Tank4Value_High) {
    Tank4_Status = "OK";
  } 
  else if (Tank4Value > Tank4Value_High) {
    Tank4_Status = "HIGH";
  }

}
