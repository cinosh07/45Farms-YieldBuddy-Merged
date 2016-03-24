/*
/!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 /!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!CHECK SETPOINTS!!
 /!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 
 Here you can create different statements to control your various devices/equipment with the relays.
 
 */

 
 void CheckSetPoints(){
  
  if(pumpActivityCounter <= 0){
      
    if (pH1_Status == "LOW"){
     turnRelay(3,1);
     delay (1000);
     turnRelay(3,0);
   }
    if (LevelFull == 0){
     turnRelay(2,1);
     delay (10000);
     turnRelay(2,0);
   }

   
   
   
  }
 }
