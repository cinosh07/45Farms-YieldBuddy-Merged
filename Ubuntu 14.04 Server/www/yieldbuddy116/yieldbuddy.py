#!/usr/bin/python

import serial
import os
import time
from datetime import datetime
import MySQLdb
import smtplib
import random
import string

def update_sql(query):
	try:
		# Execute the SQL command
		cursor.execute(query)
		# Commit changes in the database
		db.commit()
	except:
		# Rollback in case there is any error
		db.rollback()

def fetch_sql(query):
	# Execute the SQL command
	cursor.execute(query)
	#Fetch the data at the cursor
	sql_data = cursor.fetchone()
	#Assign fetched data to variables
	return sql_data


def email_message_tls(login_address,password,to_address,message,smtp_server,smtp_port):
	try:
		subject = 'yieldbuddy Alert'
				 
		body = "" + now.strftime("%b %d %Y %I:%M:%S %p") + "    " + message + ""
		 
		headers = ["From: " + login_address,
			   "Subject: yieldbuddy Alert",
			   "To: " + to_address,
			   "MIME-Version: 1.0",
			   "Content-Type: text/html"]
		headers = "\r\n".join(headers)

		smtpObj = smtplib.SMTP(smtp_server, smtp_port)

		smtpObj.ehlo()
		smtpObj.starttls()
		smtpObj.ehlo
		smtpObj.login(login_address, password)		

		smtpObj.sendmail(login_address, to_address, headers + "\r\n\r\n" + body)         
		return 1
	except smtplib.SMTPException:
		return 0

#Thanks to: http://www.floyd.ch/?p=293 for the encrypt and decrypt functions.
def AESencrypt(password, plaintext, base64=False):
    import hashlib, os
    from Crypto.Cipher import AES
    SALT_LENGTH = 32
    DERIVATION_ROUNDS=1337
    BLOCK_SIZE = 16
    KEY_SIZE = 32
    MODE = AES.MODE_CBC
     
    salt = os.urandom(SALT_LENGTH)
    iv = os.urandom(BLOCK_SIZE)
     
    paddingLength = 16 - (len(plaintext) % 16)
    paddedPlaintext = plaintext+chr(paddingLength)*paddingLength
    derivedKey = password
    for i in range(0,DERIVATION_ROUNDS):
        derivedKey = hashlib.sha256(derivedKey+salt).digest()
    derivedKey = derivedKey[:KEY_SIZE]
    cipherSpec = AES.new(derivedKey, MODE, iv)
    ciphertext = cipherSpec.encrypt(paddedPlaintext)
    ciphertext = ciphertext + iv + salt
    if base64:
        import base64
        return base64.b64encode(ciphertext)
    else:
        return ciphertext.encode("hex")
 
def AESdecrypt(password, ciphertext, base64=False):
    import hashlib
    from Crypto.Cipher import AES
    SALT_LENGTH = 32
    DERIVATION_ROUNDS=1337
    BLOCK_SIZE = 16
    KEY_SIZE = 32
    MODE = AES.MODE_CBC
     
    if base64:
        import base64
        decodedCiphertext = base64.b64decode(ciphertext)
    else:
        decodedCiphertext = ciphertext.decode("hex")
    startIv = len(decodedCiphertext)-BLOCK_SIZE-SALT_LENGTH
    startSalt = len(decodedCiphertext)-SALT_LENGTH
    data, iv, salt = decodedCiphertext[:startIv], decodedCiphertext[startIv:startSalt], decodedCiphertext[startSalt:]
    derivedKey = password
    for i in range(0, DERIVATION_ROUNDS):
        derivedKey = hashlib.sha256(derivedKey+salt).digest()
    derivedKey = derivedKey[:KEY_SIZE]
    cipherSpec = AES.new(derivedKey, MODE, iv)
    plaintextWithPadding = cipherSpec.decrypt(data)
    paddingLength = ord(plaintextWithPadding[-1])
    plaintext = plaintextWithPadding[:-paddingLength]
    return plaintext

#a = AESencrypt("password", "ABC")
#print AESdecrypt("password", a)


try:

	app_path=str( os.path.dirname(os.path.realpath(__file__)) )+"/"
	print app_path

	print 'yieldbuddy v1.16\r\n'
	print 'Checking For Serial Devices:'
	f=os.system("ls /dev/ttyA*")

	print '\r'
	print 'Enter the path to the serial device.  (/dev/ttyAMA0):'
	#device_path=raw_input()
	device_path='/dev/ttyAMA0'    #override device_path (no user input)
	if device_path == '':
		device_path = '/dev/ttyAMA0'
	device_path = device_path.strip("\n")

	ser = serial.Serial(device_path,115200,timeout=10)
	ser.flushInput()

	#Insert datapoint into SQL db after updateDataPoint_Count reaches this number:
	updateDataPoint_Every = 300
	#Start Count at this number:
	updateDataPoint_Count = 295

	#Start initial time sync counter at this number:
	timesync = 20

	startTime = datetime.now()

	os.system('clear')
	os.system('cat splashscreen')
	#time.sleep(3)
	ser.write("\n") #Send blank line to initiate serial communications

	#Load AES key
	f_AESkey=open(app_path+'/www/settings/sql/key','r+')
	AESkey=f_AESkey.readline()
	AESkey=AESkey.rstrip('\n')
	f_AESkey.close()

	#Load SQL Settings
	f_sql_address=open(app_path+'www/settings/sql/address','r+')
	sql_address=f_sql_address.readline()
	sql_address=sql_address.rstrip('\n')
	f_sql_address.close()

	f_sql_username=open(app_path+'www/settings/sql/username','r+')
	sql_username=f_sql_username.readline()
	sql_username=sql_username.rstrip('\n')
	f_sql_username.close()

	f_sql_password=open(app_path+'www/settings/sql/password','r+')
	sql_password=f_sql_password.readline()
	sql_password=sql_password.rstrip('\n')
	f_sql_password.close()

	f_sql_database=open(app_path+'www/settings/sql/database','r+')
	sql_database=f_sql_database.readline()
	sql_database=sql_database.rstrip('\n')
	f_sql_database.close()

	# Open database connection
	db = MySQLdb.connect(sql_address,sql_username,sql_password,sql_database)

	# prepare a cursor object using cursor() method
	cursor = db.cursor()

	#Fetch Email Settings
	f_key=open(app_path+'www/settings/sql/key','r+')
	str_key=f_key.readline()
	str_key=str_key.rstrip('\n')
	f_key.close()
	print "Key: " + str_key
	email_column = fetch_sql("SELECT * FROM Email")
	smtp_server = email_column[0]
	smtp_port  = email_column[1]
	login_address = email_column[2]
	password_hash = email_column[3]
	to_address = email_column[4]
	email_password = AESdecrypt(str_key, password_hash)
	#print email_password
	#time.sleep(10)
		
	while 1:
		try:



			now = datetime.now()
			#Open up the 'Command' file to see if a command has been issued.		
			f_Command=open(app_path+'Command','r+')
      			Command=f_Command.readline()
			Command=Command.rstrip('\n')
      			f_Command.close()
			#If there is a command, do that command.
			if Command != '':
				print("\033[36;0H                                                                                                                       ")
				if 'saveemailsettings' in Command:
					print("\033[36;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Received Command: saveemailsettings")
				else:
					print("\033[36;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Received Command: '" + Command + "'")
				if 'restart cam' in Command:
					f=os.system("sudo " + app_path + "restart_mtn >/dev/null 2>&1")
				elif 'stop cam' in Command:
					f=os.system("sudo " + app_path + "stop_motion >/dev/null 2>&1")
	      			elif 'update' in Command:
	      				print 'Updating!!!!!!!'
	      				ser.close()
					f=os.system("sudo avrdude -V -F -c avrisp2 -p m2560 -P /dev/ttyACM1 -U flash:w:" + app_path + "/upload/firmware.cpp.hex")
	      				serial.Serial(device_path,115200,timeout=10)
				elif 'Set Raspberry Pi\'s Time to Arduino\'s Time' in Command:

					try:
			                	row = fetch_sql("SELECT * FROM Arduino")
						for row in data:
							month = row[1]
							day = row[2]
							year = row[3]
							hour = row[4]
							minute = row[5]
							sec = row[6]
							print "month=%d,day=%d,year=%d,hour=%d,minute=%d,sec=%d" % (month, day, year, hour, minute, sec)
							f=os.system("sudo date " + month + day + hour + minute + year + "." + sec)
							print f

					except:
							print "Cannot fetch data from database:  Arduino Table"

				elif 'setraspberrypi' in Command:
					try:
						setraspberrypi,month,day,year,hour,minute,sec=Command.split(",")
						print("%s%s%s%s%s%s%s%s"%("sudo date ", month, day, hour, minute, year, ".", sec))
						f=os.system("sudo date " + month + day + hour + minute + year + "." + sec)
					except:
						print "Error updating Raspberry Pi Time."
				elif 'saveemailsettings' in Command:
					try:
						saveemailsettings,login_address,email_password,to_address,smtp_server,smtp_port=Command.split(",")
						print("%s,<password>,%s,%s,%s"%(login_address,to_address,smtp_server,smtp_port))
						chars=string.ascii_uppercase + string.digits + string.ascii_lowercase
						#print "Generating new key...\n"
						new_key = ''.join(random.choice(chars) for x in range(64))
						#print "Key: " + new_key + "\n"
						app_path=str( os.path.dirname(os.path.realpath(__file__)) )+"/"
						#print "Saving key to path: " + app_path + "www/settings/sql/key\n"
						os.system("echo '" + new_key + "' > '" + app_path + "www/settings/sql/key'")
						#print "Encrypting Password...\n"
						password_hash = AESencrypt(new_key, email_password)
						#print "Saving Hash to SQL Database.\n"
						email_sql_query = "UPDATE `Email` SET smtp_server = '" + smtp_server + "', smtp_port = '" + smtp_port + "', login_email_address = '" + login_address + "', password_hash='" + password_hash + "', recipient = '" + to_address + "'"
						#print "SQL Query: " + email_sql_query
						update_sql(email_sql_query)
						#print "Successfully saved e-mail settings."
						#time.sleep(20)
					except:
						print "Error setting email settings."
				elif Command not in '':
	      				ser.write(Command)
	      				ser.write("\n")
					#time.sleep(5)
					print("\033[37;0H                                                                                                                       ")
	      				print("\033[37;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") %s'%s'"%("Sent Command: ",Command))
					if os.path.exists(device_path):
						ser.readline()
						ser.readline()
						ser.readline()
						ser.readline()
					else:
						print 'Breaking'
						break
	      			f_Command=open(app_path + 'Command','w+')
	      			f_Command.write('')
	      			f_Command.close()
#				time.sleep(2)


		#Read Serial Device and Update according to the information that was received.

			if os.path.exists(device_path):
				line=ser.readline()
			else:
				print 'Breaking'
				break
			#print("\v%s"%(line))
			
			now = datetime.now()
			if 'Time' in line:
				print("\r")
				#print("\v%s"%(line))
				T,longdate,longdate2,Arduino_month,Arduino_day,Arduino_year,Arduino_hour,Arduino_min,Arduino_sec=line.split(",")
				T = T.replace("Readfail", "")
				Arduino_sec = Arduino_sec.rstrip()
				ArduinoTime = longdate + longdate2
				if len(Arduino_month) < 2:
					Arduino_month='0'+Arduino_month
				if len(Arduino_day) < 2:
					Arduino_day='0'+Arduino_day
				if len(Arduino_year) < 2:
					Arduino_year='0'+Arduino_year
				if len(Arduino_hour) < 2:
					Arduino_hour='0'+Arduino_hour
				if len(Arduino_min) < 2:
					Arduino_min='0'+Arduino_min
				if len(Arduino_sec) < 2:
					Arduino_sec='0'+Arduino_sec
				if ArduinoTime != '':
					print("\033[34;0H                                                                                                                       ")
					print("\033[19;0H                                                                                                                       ")
					print("\033[19;0HArduino Time: " + ArduinoTime)
					update_sql("UPDATE `Arduino` SET `Time` = '" + ArduinoTime + "' , Month=" + Arduino_month + ", Day=" + Arduino_day + ", Year=" + Arduino_year + ", Hour=" + Arduino_hour + ", Minute=" + Arduino_min + ", Second=" + Arduino_sec)
			#If the 'timesync' counter value goes over 20, then update the Raspberry Pi's time to be that of the Arduino's.
				if timesync > 20:
					try:
						f=os.system("sudo date " + Arduino_month + Arduino_day + Arduino_hour + Arduino_min + Arduino_year + "." + Arduino_sec + " >/dev/null 2>&1")
					except:
						print "Error updating Raspberry Pi Time."
					time.sleep(1) #Let the poor Raspberry Pi have some down time
					timesync = 0
				timesync = timesync + 1
			elif 'Sensors' in line:
				Sensors,pH1,pH2,Temp,RH,TDS1,TDS2,CO2,Light=line.split(",")
  				Sensors = Sensors.replace("Read fail", "")
  				Light = Light.rstrip()
        			elapsedTime = now-startTime
        			elapsedSeconds = (elapsedTime.microseconds+(elapsedTime.days*24*3600+elapsedTime.seconds)*10**6)/10**6
				print("\033[20;0H                                                                                                                       ")
        			print("\033[20;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Sensors: %s,%s,%s,%s,%s,%s,%s,%s"%(pH1,pH2,Temp,RH,TDS1,TDS2,CO2,Light))
  				if updateDataPoint_Count >= updateDataPoint_Every:
					print("\033[35;0H                                                                                                                       ")
 					print("\033[35;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Taking a Data Point...")
					update_sql("INSERT INTO  Sensors_Log (pH1,pH2,Temp,RH,TDS1,TDS2,CO2,Light) VALUES (" + pH1 + "," + pH2+ "," + Temp + "," + RH + "," + TDS1 + "," + TDS2 + "," + CO2 + "," + Light + ")")
  					updateDataPoint_Count = 0
					timesync = 0   #do a timesync
  
  				#SENSOR VALUES
				update_sql("UPDATE `Sensors` SET pH1 = " + pH1 + ", pH2 = " + pH2+ ", Temp = " + Temp + ", RH = " + RH + ", TDS1 =" + TDS1 + ", TDS2 =" + TDS2 + ", CO2 = " + CO2 + ", Light = " + Light)
                		#sql = "UPDATE `Sensors` SET pH1 = " + pH1 + ", pH2 = " + pH2+ ", Temp = " + Temp + ", RH = " + RH + ", TDS1 =" + TDS1 + ", TDS2 =" + TDS2 + ", CO2 = " + CO2 + ", Light = " + Light
               			#try:
		                	# Execute the SQL command
                			#cursor.execute(sql)
					# Commit changes in the database
					#db.commit()
				#except:
					# Rollback in case there is any error
					#db.rollback()

				updateDataPoint_Count = updateDataPoint_Count + 1
  			elif 'Relays' in line:
				#print("%s"%(line))  For Debugging
				Relays,Relay1,Relay2,Relay3,Relay4,Relay5,Relay6=line.split(",")
  				Relays = Relays.replace("Read fail", "")
  				Relay6 = Relay6.rstrip()
				print("\033[21;0H                                                                                                                       ")
        			print("\033[21;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Relays: %s,%s,%s,%s,%s,%s"%(Relay1,Relay2,Relay3,Relay4,Relay5,Relay6))
				#RELAYS
                		update_sql("UPDATE `Relays` SET Relay1 = " + Relay1 + ", Relay2 = " + Relay2 + ", Relay3 = " + Relay3 + ", Relay4 = " + Relay4 + ", Relay5 =" + Relay5 + ", Relay6 =" + Relay6)
  			elif 'Relay_isAuto' in line:
				#print("%s"%(line))  For Debugging
				Relay_isAuto,Relay1_isAuto,Relay2_isAuto,Relay3_isAuto,Relay4_isAuto,Relay5_isAuto,Relay6_isAuto=line.split(",")
  				Relay_isAuto = Relay_isAuto.replace("Read fail", "")
  				Relay6_isAuto = Relay6_isAuto.rstrip()
				print("\033[22;0H                                                                                                                       ")
        			print("\033[22;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Relay_isAuto: %s,%s,%s,%s,%s,%s"%(Relay1_isAuto,Relay2_isAuto,Relay3_isAuto,Relay4_isAuto,Relay5_isAuto,Relay6_isAuto))
				#RELAYS
                		update_sql("UPDATE `Relays` SET Relay1_isAuto = " + Relay1_isAuto + ", Relay2_isAuto = " + Relay2_isAuto + ", Relay3_isAuto = " + Relay3_isAuto + ", Relay4_isAuto = " + Relay4_isAuto + ", Relay5_isAuto =" + Relay5_isAuto + ", Relay6_isAuto =" + Relay6_isAuto)
  			elif 'Lighting' in line:
				#print("%s"%(line))  For Debugging
				Lighting,Light_ON_hour,Light_ON_min,Light_OFF_hour,Light_OFF_min=line.split(",")
  				Lighting = Lighting.replace("Read fail", "")
  				Light_OFF_min = Light_OFF_min.rstrip()
				print("\033[23;0H                                                                                                                       ")
        			print("\033[23;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Lighting: %s,%s,%s,%s"%(Light_ON_hour,Light_ON_min,Light_OFF_hour,Light_OFF_min))
				#LIGHTING
				update_sql("UPDATE `Lighting` SET Light_ON_hour = " + Light_ON_hour + ", Light_ON_min = " + Light_ON_min + ", Light_OFF_hour = " + Light_OFF_hour + ", Light_OFF_min = " + Light_OFF_min)
  			elif 'Watering' in line:
				#print("%s"%(line))  For Debugging
				Watering,Pump_start_hour,Pump_start_min,Pump_start_isAM,Pump_every_hours,Pump_every_mins,Pump_for,Pump_times=line.split(",")
  				Watering = Watering.replace("Read fail", "")
  				Pump_times = Pump_times.rstrip()
				print("\033[24;0H                                                                                                                       ")
        			print("\033[24;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") Watering: %s,%s,%s,%s,%s,%s,%s"%(Pump_start_hour,Pump_start_min,Pump_start_isAM,Pump_every_hours,Pump_every_mins,Pump_for,Pump_times))
		
				#WATERING
				update_sql("UPDATE `Watering` SET Pump_start_hour = " + Pump_start_hour + ", Pump_start_min = " + Pump_start_min + ", Pump_start_isAM = " + Pump_start_isAM + ", Pump_every_hours = " + Pump_every_hours + ", Pump_every_mins =" + Pump_every_mins + ", Pump_for =" + Pump_for + ", Pump_times =" + Pump_times)
			elif 'SetPoint_pH1' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_pH1,pH1Value_Low,pH1Value_High,pH1_Status=line.split(",")
  				SetPoint_pH1 = SetPoint_pH1.replace("Read fail", "")
  				pH1_Status = pH1_Status.rstrip()
				print("\033[25;0H                                                                                                                       ")
        			print("\033[25;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_pH1: %s,%s,%s"%(pH1Value_Low,pH1Value_High,pH1_Status))
				#SetPoint_pH
				update_sql("UPDATE `pH1` SET Low='" + pH1Value_Low + "', High='" + pH1Value_High + "', Status='" + pH1_Status + "'")
				pH1_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM pH1")
				pH1_High_Alarm = fetch_sql("SELECT High_Alarm FROM pH1")
				if pH1_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"pH1 Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `pH1` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if pH1_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"pH1 High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `pH1` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in pH1_Status and pH1_Low_Alarm[0] == 0:
					update_sql("UPDATE `pH1` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in pH1_Status and pH1_High_Alarm[0] == 0:
					update_sql("UPDATE `pH1` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
			elif 'SetPoint_pH2' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_pH2,pH2Value_Low,pH2Value_High,pH2_Status=line.split(",")
  				SetPoint_pH2 = SetPoint_pH2.replace("Read fail", "")
  				pH2_Status = pH2_Status.rstrip()
				print("\033[26;0H                                                                                                                       ")
        			print("\033[26;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_pH2: %s,%s,%s"%(pH2Value_Low,pH2Value_High,pH2_Status))
				#SetPoint_pH
				update_sql("UPDATE `pH2` SET Low='" + pH2Value_Low + "',High='" + pH2Value_High + "',Status='" + pH2_Status + "'")
				pH2_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM pH2")
				pH2_High_Alarm = fetch_sql("SELECT High_Alarm FROM pH2")
				if pH2_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"pH2 Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `pH2` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if pH2_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"pH2 High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `pH2` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in pH2_Status and pH2_Low_Alarm[0] == 0:
					update_sql("UPDATE `pH2` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in pH2_Status and pH2_High_Alarm[0] == 0:
					update_sql("UPDATE `pH2` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
			elif 'SetPoint_Temp' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_Temp,TempValue_Low,TempValue_High,Heater_ON,Heater_OFF,AC_ON,AC_OFF,Temp_Status=line.split(",")
  				SetPoint_Temp = SetPoint_Temp.replace("Read fail", "")
  				Temp_Status = Temp_Status.rstrip()
				print("\033[27;0H                                                                                                                       ")
        			print("\033[27;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_Temp: %s,%s,%s,%s,%s,%s,%s"%(TempValue_Low,TempValue_High,Heater_ON,Heater_OFF,AC_ON,AC_OFF,Temp_Status))
				#SetPoint_pH
				update_sql("UPDATE `Temp` SET Low = " + TempValue_Low + ", High = " + TempValue_High + ", Heater_ON = " + Heater_ON + ", Heater_OFF = " + Heater_OFF + ", AC_ON =" + AC_ON + ", AC_OFF =" + AC_OFF + ", Status ='" + Temp_Status + "'")
				Temp_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM Temp")
				Temp_High_Alarm = fetch_sql("SELECT High_Alarm FROM Temp")
				if Temp_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"Temp Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `Temp` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if Temp_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"Temp High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `Temp` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in Temp_Status and Temp_Low_Alarm[0] == 0:
					update_sql("UPDATE `Temp` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in Temp_Status and Temp_High_Alarm[0] == 0:
					update_sql("UPDATE `Temp` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
			elif 'SetPoint_RH' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_RH,RHValue_Low,RHValue_High,Humidifier_ON,Humidifier_OFF,Dehumidifier_ON,Dehumidifier_OFF,RH_Status=line.split(",")
  				SetPoint_RH = SetPoint_RH.replace("Read fail", "")
  				RH_Status = RH_Status.rstrip()
				print("\033[28;0H                                                                                                                       ")
        			print("\033[28;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_RH: %s,%s,%s,%s,%s,%s,%s"%(RHValue_Low,RHValue_High,Humidifier_ON,Humidifier_OFF,Dehumidifier_ON,Dehumidifier_OFF,RH_Status))
				#SetPoint_RH
				update_sql("UPDATE `RH` SET Low = " + RHValue_Low + ", High = " + RHValue_High + ", Humidifier_ON = " + Humidifier_ON + ", Humidifier_OFF = " + Humidifier_OFF + ", Dehumidifier_ON =" + Dehumidifier_ON + ", Dehumidifier_OFF =" + Dehumidifier_OFF + ", Status ='" + RH_Status + "'")
				RH_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM RH")
				RH_High_Alarm = fetch_sql("SELECT High_Alarm FROM RH")
				if RH_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"RH Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `RH` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if RH_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"RH High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `RH` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in RH_Status and RH_Low_Alarm[0] == 0:
					update_sql("UPDATE `RH` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in RH_Status and RH_High_Alarm[0] == 0:
					update_sql("UPDATE `RH` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
			elif 'SetPoint_TDS1' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_TDS1,TDS1Value_Low,TDS1Value_High,NutePump1_ON,NutePump1_OFF,MixPump1_Enabled,TDS1_Status=line.split(",")
  				SetPoint_TDS1 = SetPoint_TDS1.replace("Read fail", "")
  				TDS1_Status = TDS1_Status.rstrip()
				print("\033[29;0H                                                                                                                       ")
        			print("\033[29;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_TDS1: %s,%s,%s,%s,%s,%s"%(TDS1Value_Low,TDS1Value_High,NutePump1_ON,NutePump1_OFF,MixPump1_Enabled,TDS1_Status))
				#SetPoint_TDS1
				update_sql("UPDATE `TDS1` SET Low = " + TDS1Value_Low + ", High = " + TDS1Value_High + ", NutePump1_ON = " + NutePump1_ON + ", NutePump1_OFF = " + NutePump1_OFF + ", MixPump1_Enabled =" + MixPump1_Enabled + ", Status ='" + TDS1_Status + "'")
				TDS1_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM TDS1")
				TDS1_High_Alarm = fetch_sql("SELECT High_Alarm FROM TDS1")
				if TDS1_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"TDS1 Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `TDS1` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if TDS1_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"TDS1 High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `TDS1` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in TDS1_Status and TDS1_Low_Alarm[0] == 0:
					update_sql("UPDATE `TDS1` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in TDS1_Status and TDS1_High_Alarm[0] == 0:
					update_sql("UPDATE `TDS1` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
			elif 'SetPoint_TDS2' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_TDS2,TDS2Value_Low,TDS2Value_High,NutePump2_ON,NutePump2_OFF,MixPump2_Enabled,TDS2_Status=line.split(",")
  				SetPoint_TDS2 = SetPoint_TDS2.replace("Read fail", "")
  				TDS2_Status = TDS2_Status.rstrip()
				print("\033[30;0H                                                                                                                       ")
        			print("\033[30;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_TDS2: %s,%s,%s,%s,%s,%s"%(TDS2Value_Low,TDS2Value_High,NutePump2_ON,NutePump2_OFF,MixPump2_Enabled,TDS2_Status))
				#SetPoint_TDS2
				update_sql("UPDATE `TDS2` SET Low = " + TDS2Value_Low + ", High = " + TDS2Value_High + ", NutePump2_ON = " + NutePump2_ON + ", NutePump2_OFF = " + NutePump2_OFF + ", MixPump2_Enabled =" + MixPump2_Enabled + ", Status ='" + TDS2_Status + "'")
				TDS2_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM TDS2")
				TDS2_High_Alarm = fetch_sql("SELECT High_Alarm FROM TDS2")
				if TDS2_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"TDS2 Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `TDS2` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if TDS2_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"TDS2 High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `TDS2` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in TDS2_Status and TDS2_Low_Alarm[0] == 0:
					update_sql("UPDATE `TDS2` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in TDS2_Status and TDS2_High_Alarm[0] == 0:
					update_sql("UPDATE `TDS2` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
			elif 'SetPoint_CO2' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_CO2,CO2Value_Low,CO2Value_High,CO2_ON,CO2_OFF,CO2_Enabled,CO2_Status=line.split(",")
  				SetPoint_CO2 = SetPoint_CO2.replace("Read fail", "")
  				CO2_Status = CO2_Status.rstrip()
				print("\033[31;0H                                                                                                                       ")
        			print("\033[31;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_CO2: %s,%s,%s,%s,%s,%s"%(CO2Value_Low,CO2Value_High,CO2_ON,CO2_OFF,CO2_Enabled,CO2_Status))
				#SetPoint_CO2'
				update_sql("UPDATE `CO2` SET Low = " + CO2Value_Low + ", High = " + CO2Value_High + ", CO2_ON = " + CO2_ON + ", CO2_OFF = " + CO2_OFF + ", CO2_Enabled =" + CO2_Enabled + ", Status = '" + CO2_Status + "'")
				CO2_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM CO2")
				CO2_High_Alarm = fetch_sql("SELECT High_Alarm FROM CO2")
				if CO2_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"CO2 Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `CO2` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if CO2_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"CO2 High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `CO2` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in CO2_Status and CO2_Low_Alarm[0] == 0:
					update_sql("UPDATE `CO2` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in CO2_Status and CO2_High_Alarm[0] == 0:
					update_sql("UPDATE `CO2` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
			elif 'SetPoint_Light' in line:
				#print("%s"%(line))  For Debugging
				SetPoint_Light,LightValue_Low,LightValue_High,Light_Status=line.split(",")
  				SetPoint_Light = SetPoint_Light.replace("Read fail", "")
  				Light_Status = Light_Status.rstrip()
				print("\033[32;0H                                                                                                                       ")
        			print("\033[32;0H(" + now.strftime("%Y/%m/%d %H:%M:%S") + ") SetPoint_Light: %s,%s,%s"%(LightValue_Low,LightValue_High,Light_Status))
				#SetPoint_pH
				update_sql("UPDATE `Light` SET Low = '" + LightValue_Low + "', High = '" + LightValue_High + "', Status = '" + Light_Status + "'")
				Light_Low_Alarm = fetch_sql("SELECT Low_Alarm FROM Light")
				Light_High_Alarm = fetch_sql("SELECT High_Alarm FROM Light")
				if Light_Low_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"Light Low",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `Light` SET Low_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if Light_High_Alarm[0] == 1:
					if email_message_tls(login_address,email_password,to_address,"Light High",smtp_server, smtp_port) == 1:
						update_sql("UPDATE `Light` SET High_Alarm = 2, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'LOW' in Light_Status and Light_Low_Alarm[0] == 0:
					update_sql("UPDATE `Light` SET Low_Alarm = 1, Low_Time = '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
				if 'HIGH' in Light_Status and Light_High_Alarm[0] == 0:
					update_sql("UPDATE `Light` SET High_Alarm = 1, High_Time= '" + now.strftime("%b %d %Y %I:%M:%S %p") + "'")
		except ValueError as detail:
			print "\nError: ", detail
#			time.sleep(5)
except IOError as e:
	print "\nIOError. "
except KeyboardInterrupt:
	os.system("clear")
	print "\nKeyboardInterrupt."
