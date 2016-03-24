/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH READ AND DOSE PH
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */


void doseAcid() {
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

  pH1Value = (0.0178 * pH1RawValue - 1.889);
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

  pH2Value = (0.0178 * pH2RawValue - 1.889);
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
  
}


void pHUp(){
  
}
void pHDown() {
  
}
  
