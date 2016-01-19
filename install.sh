#! /bin/bash

echo "You need to run this script as root for the install to succeed!"

echo "Otherwise the install may fail!"

echo "Installing..."


apt-get install python-psutil -y
mkdir /home/pi/PiData
touch /home/pi/PiData/PiData.txt
curl -o /home/pi/PiData/PiData.py https://raw.githubusercontent.com/GustavGenberg/PiData/master/files/PiData.py
mkdir /var/www/html/PiData
curl -o /var/www/html/PiData/index.php https://raw.githubusercontent.com/GustavGenberg/PiData/master/files/www/index.php
curl -o /var/www/html/PiData/PiData.php https://raw.githubusercontent.com/GustavGenberg/PiData/master/files/www/PiData.php

echo "Install Complete!"

echo "**********IMPORTANT**********"
echo "You need to edit this file: /etc/rc.local"
echo "and add this: python /home/pi/PiData1/PiData.py"
echo "just before the exit 0 line in the end of the file"
echo "**********IMPORTANT**********"
