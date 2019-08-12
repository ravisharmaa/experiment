#!/bin/bash
# Script to add a user to Linux system
USERNAME=$1
PWD=$2
DIR_PATH="/var/www/html/uptimemonitor/public/home/$USERNAME"
#echo $DIR_PATH
#die()
if [ -n "$USERNAME" ] && [ -n "$PWD" ]; then
if [ $(id -u) -eq 0 ]; then
	egrep "^$USERNAME" /etc/passwd >/dev/null
	if [ $? -eq 0 ]; then
		echo "$USERNAME exists!"
		exit 1
	else
		pass=$(perl -e 'print crypt($ARGV[0], "password")' $PWD)
		useradd -m -d $DIR_PATH -p $PWD $USERNAME
		[ $? -eq 0 ] && echo "User has been added to system!" || echo "Failed to add a user!"
		chmod -R 775 $DIR_PATH
		chown -R $USERNAME:apache  $DIR_PATH
		ln -s $DIR_PATH /home/$USERNAME
	fi
else
	echo "Only root may add a user to the system"
	exit 2
fi
else
 echo "Please provide username and pwd"
fi
