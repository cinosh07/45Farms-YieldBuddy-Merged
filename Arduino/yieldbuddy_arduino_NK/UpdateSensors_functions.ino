

/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!UPDATE SENSOR VALUES!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
 





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
  duration = pulseIn(epin, HIGH);

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




//READ ALL SENSOR VALUES AND CONVERT FOR LCD DISPLAY
void updateSensorValues() {
 
  analogReference(DEFAULT);  //Seems more accurate.
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!PH SENSORS!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
 
  
  /*PH1------------------------------------------------*/
  
  float pH1Sum = 0;
  int j = 0;
  analogRead(pH1Pin);  //Get ADC to switch to correct pin
  delay(20); //Wait for Pin to Change
  
  while(j<30) {
    pH1Sum = pH1Sum + analogRead(pH1Pin);
    j++;
  }
  pH1RawValue = pH1Sum/30;

//  pH1Value = (pHSlope * pH1RawValue + pHOffset);
  pH1Value = 0;
    
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
  
  float pH2Sum = 0;
  j = 0;
  analogRead(pH2Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change

  while(j<30) {
    pH2Sum = pH2Sum + analogRead(pH2Pin);
    j++;
  }
  pH2RawValue = pH2Sum/30;

//  pH2Value = (pHSlope * pH2RawValue + pHOffset);
  pH2Value = 0;
    
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
  TempRawValue = dht.readTemperature(); //to use the DHT22
  TempValue = TempRawValue;
  if(isnan(TempValue)){
    TempValue = 0;        
  }
  PString my_Temp_string(Temp_char, sizeof(Temp_char));
  my_Temp_string.print(TempValue);
  my_Temp_string.println(" C"); 
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 !!WATER TANK LEVEL SCAN
 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
// delays are needed for testing as i am only using 1 phsical sensor for test. Remove when 4 sensors wired
//  delay(50);
  Tank1RawValue = (read_water_sensor(Tank1TrigPin, Tank1EchoPin));
//  delay(50);
  Tank2RawValue = (read_water_sensor(Tank2TrigPin, Tank2EchoPin));
//  delay(50);
  Tank3RawValue = (read_water_sensor(Tank3TrigPin, Tank3EchoPin));
//  delay(50);
  Tank4RawValue = (read_water_sensor(Tank4TrigPin, Tank4EchoPin));
  
  TankTotalRawValue = Tank1RawValue + Tank2RawValue + Tank3RawValue + Tank4RawValue;
  

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
  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 !!WATER LEVEL SENSOR! WATER LEVEL SENSOR! WATER LEVEL SENSOR! WATER LEVEL SENSOR! WATER LEVEL SENSOR! 
 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
  float WaterSum = 0;
  j = 0;
  analogRead(WaterPin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change

  while(j<10) {
    WaterSum = WaterSum + analogRead(WaterPin);
    j++;
  }
  WaterRawValue = WaterSum/10;
//  WaterRawValue = WaterSum/((j-1) * 2);
//  WaterValue = ((5.00 * WaterRawValue)/1024.0);
//  WaterValue = map(WaterRawValue, 0, 1023, 0, 100);
  WaterValue = 0;
 
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

  dht.readHumidity();  //The DHT11 Sensor works differently, but for 'good measure'.
  delay(15); //Wait for Pin to Change
  RHRawValue = dht.readHumidity();
  RHValue = RHRawValue;
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

  
// ******************magnetometer sensor******************

//  MagnetometerScaled scaled = compass.ReadScaledAxis();
//  
//  MagXRawValue = scaled.XAxis;
//  MagYRawValue = scaled.YAxis;
//  MagZRawValue = scaled.ZAxis;


  MagXValue = 0;
  MagYValue = 0;
  MagZValue = 0;

//  MagXValue = MagXRawValue;
  PString my_MagX_string(MagX_char, sizeof(MagX_char));
  my_MagX_string.print(MagXValue);
  my_MagX_string.println("Guass");
  
//  MagYValue = MagYRawValue;
  PString my_MagY_string(MagY_char, sizeof(MagY_char));
  my_MagY_string.print(MagYValue);
  my_MagY_string.println("Guass");
    
//  MagZValue = MagZRawValue;
  PString my_MagZ_string(MagZ_char, sizeof(MagZ_char));
  my_MagZ_string.print(MagZValue);
  my_MagZ_string.println("Guass");





//******************************************************  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!TDS1 SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
  float TDS1Sum = 0;
  j = 0;
  analogRead(TDS1Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change

  while(j<10) {
    TDS1Sum = TDS1Sum + analogRead(TDS1Pin);
    j++;
  }

  TDS1RawValue = TDS1Sum/((j-1) * 2);
//  TDS1Value = ((TDS1RawValue * 100.0)/1024.0);
  TDS1Value = 0;
  
  if(isnan(TDS1Value)){
    TDS1Value = 0;        
  }
  PString my_TDS1_string(TDS1_char, sizeof(TDS1_char));
  my_TDS1_string.println(TDS1Value);
  my_TDS1_string.println(" ppm"); 
  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!TDS2 SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
  float TDS2Sum = 0;
  j = 0;
  analogRead(TDS2Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change

  while(j<10) {
    TDS2Sum = TDS2Sum + analogRead(TDS2Pin);
    j++;
  }

  TDS2RawValue = TDS2Sum/((j-1) * 2);
//  TDS2Value = ((TDS2RawValue * 100.0)/1024.0);
  TDS2Value = 0;

  if(isnan(TDS2Value)){
    TDS2Value = 0;        
  }
  PString my_TDS2_string(TDS2_char, sizeof(TDS2_char));
  my_TDS2_string.print(TDS2Value);
  my_TDS2_string.println(" ppm"); 
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!CO2 SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
  float CO2Sum = 0;
  j = 0;
  analogRead(CO2Pin);  //Get ADC to switch to correct pin
  delay(15); //Wait for Pin to Change

  while(j<10) {
    CO2Sum = CO2Sum + analogRead(CO2Pin);
    j++;
  }

  CO2RawValue = CO2Sum/((j-1) * 2);
//  CO2Value = ((CO2RawValue * 100.0)/1024.0);
  CO2Value = 0;
  
  if(isnan(CO2Value)){
    CO2Value = 0;        
  }
  PString my_CO2_string(CO2_char, sizeof(CO2_char));
  my_CO2_string.print(CO2Value);
  my_CO2_string.println(" ppm"); 
  
  
 /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   !!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!LIGHT SENSOR!!
   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
 //******************************* GY-30 DIGITAL LIGHT SENSOR ***************************


  Wire.begin();
  BH1750_Init(BH1750_address); 
  delay(200);
  float valf=0;
   
  if(BH1750_Read(BH1750_address)==2){
    
    valf=((buff[0]<<8)|buff[1])/1.2;
    
    if(valf<0){
    valf = 30000;
    }
  }
  
  LightRawValue = (int)valf,DEC;
//  LightValue = LightRawValue;
  LightValue = 0;
  
  if (isnan(LightValue)) {
    LightValue = 0;
  } 
  PString my_Light_string(Light_char, sizeof(Light_char));
  my_Light_string.print(LightValue);
  if (LightValue < 10){
    my_Light_string.println("% "); 
  } 
  else {
    my_Light_string.println("%"); 
  }


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
