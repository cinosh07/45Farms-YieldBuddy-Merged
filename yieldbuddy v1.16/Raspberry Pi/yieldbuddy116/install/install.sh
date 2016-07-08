#!/bin/sh
echo "Welcome to the yieldbuddy installer."
echo ""
echo "Copying site to /var/www/yieldbuddy..."
sudo cp -R ../../yieldbuddy /var/www/yieldbuddy
echo ""
echo "Copying scripts to /home/pi/scripts..."
sudo mkdir /home/pi/scripts/
sudo cp ./scripts/test_network.sh /home/pi/scripts/test_network.sh
sudo cp ./scripts/test_yb.sh /home/pi/scripts/test_yb.sh
sudo cp ./scripts/ybdaemon.sh /home/pi/scripts/ybdaemon.sh
sudo chmod +x /home/pi/scripts/test_yb.sh
sudo chmod +x /home/pi/scripts/test_network.sh
sudo chmod +x /home/pi/scripts/ybdaemon.sh
echo ""
echo "Installing ybdaemon to /etc/init.d/ybdaemon as start-up daemon"
sudo cp -R ./scripts/yieldbuddy /etc/init.d/yieldbuddy
sudo chmod +x /etc/init.d/yieldbuddy
sudo update-rc.d yieldbuddy defaults
echo ""
echo "Linking /var/www/yieldbuddy to homefolder..."
sudo ln -s /var/www/yieldbuddy /home/pi/www/yieldbuddy
echo ""
echo "Changing file permissions..."
sudo chmod 751 /var/www/yieldbuddy
sudo chmod 750 /var/www/yieldbuddy/*
sudo chmod 777 /var/www/yieldbuddy/Command
sudo chmod 775 /var/www/yieldbuddy/index.html
sudo chmod 751 /var/www/yieldbuddy/restart_mtn
sudo chmod 751 /var/www/yieldbuddy/stop_motion
sudo chmod 751 /var/www/yieldbuddy/start_motion
sudo chmod 751 /var/www/yieldbuddy/yieldbuddy.py
sudo chmod +x /var/www/yieldbuddy/restart_mtn
sudo chmod +x /var/www/yieldbuddy/stop_motion
sudo chmod +x /var/www/yieldbuddy/start_motion
sudo chmod +x /var/www/yieldbuddy/yieldbuddy.py
sudo chmod 751 /var/www/yieldbuddy/www/
sudo chmod 755 /var/www/yieldbuddy/www/*
sudo chmod 751 /var/www/yieldbuddy/www/img/
sudo chmod 751 /var/www/yieldbuddy/www/java/
sudo chmod 751 /var/www/yieldbuddy/www/settings/
sudo chmod 751 /var/www/yieldbuddy/www/sql/
sudo chmod 751 /var/www/yieldbuddy/www/upload
sudo chmod 751 /var/www/yieldbuddy/www/users/
echo ""
read -p "Would you like to patch '/boot/cmdline.txt' (Frees up the serial interface)? (y/n) " REPLY
if [ "$REPLY" == "y" ]; then
sudo cp ./config/cmdline.txt /boot/cmdline.txt
fi
echo ""
read -p "Would you like to patch '/etc/inittab' (Frees up the serial interface)? (y/n) " REPLY
if [ "$REPLY" == "y" ]; then
sudo cp ./config/inittab /etc/inittab
fi
echo ""
read -p "Would you like to setup a wireless network? (y/n) " REPLY
if [ "$REPLY" == "y" ]; then
read -p "To save, use CTRL + O and hit enter, then CTRL + X to exit. Press any key to continue." REPLY
sudo nano ./config/wpa_supplicant.conf

	read -p "Copy wireless settings (the ones you just edited) to /etc/wpa_supplicant/wpa_supplicant.conf' (y/n) " REPLY
	if [ "$REPLY" == "y" ]; then
	sudo cp ./config/wpa_supplicant.conf /etc/wpa_supplicant/wpa_supplicant.conf
	fi
	
	read -p "Attempt to start a wireless connection? (y/n) " REPLY
	if [ "$REPLY" == "y" ]; then
	echo ""
	echo "Bringing wlan0 down"
	sudo ifdown wlan0
	echo ""
	echo "Bringing wlan0 up"
	sudo ifup wlan0
	echo ""
	echo "Attempting to obtain an IP address..."
	sudo dhclient wlan0 &
	sleep 5
	disown
	fi
fi
echo "Setting up serial device..."
sudo apt-get -y install minicom
echo "Going to test serial device..."
read -p "*** You will have to exit this program after a 10 seconds using ***CTRL+A then 'q'***, select 'YES' to NOT reset the device. Press any key to continue. ***" REPLY
minicom -b 115200 -o -D /dev/ttyAMA0
echo ""
echo "Installing more packages - this will take some time!"
echo ""
sudo apt-get -y install apache2 pure-ftpd python-serial python-mysqldb
echo "Installing PHP"
sudo apt-get -y install php5 php5-mysql
echo ""
echo ""
echo ""
echo "Congrats.  You should now see a web interface at <Raspberry Pi's IP Address>/yieldbuddy/www/"
echo ""
echo ""
echo ""
echo "*** FOR YOUR DESKTOP MACHINE (ie. Not the Raspberry Pi): ***"
echo ""
echo "Install the following packages using 'sudo apt-get install <package name>':"
echo "apache2"
echo "php5"
echo "mysql-server"
echo ""
echo "Or install the equivalents on Windows."
echo "Make sure you have apache2 running and install phpMyAdmin. You can get it from their website.  Its as easy as putting it in your /var/www/ folder (with apache2 installed)."
echo ""
echo "Login to phpMyAdmin and create a new user with 'ALL PRIVILEGES'. Create a password."
echo "Then, create a new database.  I call mine 'yieldbuddy-0'.  If you already have another yieldbuddy running, then call it 'yieldbuddy-1' for example."
echo "Select that database and click Import.  Import file the file located within this install (or at /var/www/yieldbuddy/yieldbuddy-0.sql)  This will setup the database for the first time."
echo ""
echo "ON THE PI:"
echo "Now, change the files in the /var/www/yieldbuddy/www/settings/ folder to reflect your mySQL settings.  The webinterface will now be able to connect to your SQL server/database."
echo "type 'cd /var/www/yieldbuddy/www/settings/' to continue.  Use 'nano <filename>' to edit the files.    You will need to type 'cd sql' and nano those files as well."
echo "Change the following files:"
echo "connectback_address  <--  This is the address of your webcam to connect back to your raspberry pi if you are are remotely connecting over the internet"
echo "And in the SQL folder:"
echo "address"
echo "database"
echo "username"
echo "password"
echo ""
echo "^^^ MAKE SURE YOU REBOOT THE PI AFTER READING THIS. ^^^"
echo "Note:"
echo "To Access /var/www/yieldbuddy, type 'sudo su' first, then 'cd /var/www/yieldbuddy'  now run './yieldbuddy.py'"
echo "Once you get everything working the way you want it, type crontab -e AS USER PI (not root) and add '*/2 * * * * /home/pi/scripts/test_network.sh'  and '*/1 * * * * /home/pi/scripts/test_yb.sh'.  These scripts act like daemons; one tests your network connection and the other restarts yieldbuddy.py if it stops running for some reason.   Note: The '*/2' is for running the script every 2 minutes."
