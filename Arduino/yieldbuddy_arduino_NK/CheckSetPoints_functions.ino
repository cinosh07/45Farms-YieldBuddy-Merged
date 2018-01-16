/*
  /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  /!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!
  /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

  Here you can create different statements to control your various devices/equipment with the relays.

*/


void CheckSetPoints() {

  // Open fresh water solenoid on relay 2 to Tank 1
  #if defined(tank1_limit_switch_on)
    #if defined(tank1_on)
       if (Relay2_isAuto == 1) {
         if (Tank1_Status == "OK") {
             turnRelay(2, 0);
           } else {
             turnRelay(2, 1);
           }
         }
      #endif
  #endif

  // Close Tap Water Revese Osmosis solenoid on relay 4 to Tank 2
  #if defined(tank2_limit_switch_on)
    #if defined(tank2_on)
       if (Relay4_isAuto == 1) {
         if (Tank2_Status == "OK") {
             turnRelay(4, 1);
           } else {
             turnRelay(4, 0);
           }
         }
    #endif
  #endif

  //  if(pumpActivityCounter <= 0){
  //
  //    if (pH1_Status == "LOW"){
  //     turnRelay(3,1);
  //     delay (1000);
  //     turnRelay(3,0);
  //   }
  //    if (LevelFull == 0){
  //     turnRelay(2,1);
  //     delay (10000);
  //     turnRelay(2,0);
  //   }
  //  }

  // Tank2 xfer to Tank3

//  if ((Relay2_isAuto == 1) && (Tank2MixPump_Enabled == true)) {
//    if ((Tank2Value >= Tank2Pump_ON) || (Tank2Value <= Tank2Pump_OFF)) {
//      if ((Tank2Value <= Tank2Pump_OFF - 1) || (Tank3Value >= 180)) {
//        turnRelay(2, 0);
//      }
//      if ((Tank2Value >= Tank2Pump_ON + 1) || (Tank3Value < 180)) {
//        turnRelay(2, 1);
//      }
//    }
//  }
//
//  // Tank3 xfer to Tank1
//  if ((Relay3_isAuto == 1) && (Tank3MixPump_Enabled == true)) {
//    if ((Tank3Value >= Tank3Pump_ON) || (Tank3Value <= Tank3Pump_OFF)) {
//      if ((Tank3Value <= Tank3Pump_OFF - 1) && (Tank1Value >= 180)) {
//        turnRelay(3, 0);
//      }
//      if ((Tank3Value >= Tank3Pump_ON + 1) && (Tank3Value <= 180)) {
//        turnRelay(3, 1);
//      }
//    }
//  }
//
//  // Tank4 xfer to Tank2
//  if ((Relay4_isAuto == 1) && (Tank4MixPump_Enabled == true)) {
//    if ((Tank4Value >= Tank4Pump_ON) || (Tank4Value <= Tank4Pump_OFF)) {
//      if (Tank4Value <= Tank4Pump_OFF - 1) {
//        turnRelay(4, 0);
//      }
//      if (Tank4Value >= Tank4Pump_ON + 1) {
//        turnRelay(4, 1);
//      }
//    }
//  }

  // Demumidifier
//  if (Relay6_isAuto == 1) {
//    if ((RHValue >= Dehumidifier_ON) || (RHValue <= Dehumidifier_OFF)) {
//
//      if (RHValue <= Dehumidifier_OFF - 1) {
//        turnRelay(6, 0);
//      }
//      if (RHValue >= Dehumidifier_ON + 1) {
//        turnRelay(6, 1);
//      }
//    }
//  }

  //Humidifier
 if (Relay6_isAuto == 1) {
   if ((RHValue >= Humidifier_ON) || (RHValue <= Humidifier_OFF)) {

     if (RHValue <= Humidifier_OFF - 1) {
       turnRelay(6, 0);
     }
     if (RHValue >= Humidifier_ON + 1) {
       turnRelay(6, 1);
     }
   }
 }

}
