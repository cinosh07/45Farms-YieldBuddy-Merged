#!/bin/sh
newline='
'
NETWORK=$(ifplugstatus wlan0)
echo "COMMAND: $NETWORK"
RESULT=$(echo $NETWORK | grep "unplugged")
echo ""
echo "RESULT: $RESULT"
echo ""
LEN_RESULT=${#RESULT}
echo "Length of RESULT: $LEN_RESULT"
echo ""
if [ $LEN_RESULT -lt 2 ]
then
echo "Network up!"
else
echo "Network down!"
echo ""
echo "Attempting to restart the network connection..."
echo ""
sudo ifdown --force wlan0
echo ""
sudo ifup --force wlan0
echo "Done."
fi
