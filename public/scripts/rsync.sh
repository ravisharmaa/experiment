#!/bin/bash
DATE_N_TIME=`date +%y-%m-%d_%H-%M-%S`
LOG_DIR="/var/log"
LOG_FILE="$LOG_DIR/rsync.log"
NAMEHOST="hostnamedefault"
mail="satya.maharjan@javra.com"
SCRIPT_FILE="scriptfiledefault_monitoring.sh"
DIR_PATH="/scripts/jvrscripts"

echo "$DATE_N_TIME Starting executing rsync " > $LOG_FILE
echo "This script will generate csv file for rsync" >> $LOG_FILE
sh $DIR_PATH/$SCRIPT_FILE 

rsync -apvrtog  --rsh='sshpass -p "passworddefault" ssh -l usernamedefault' $DIR_PATH/csv/$NAMEHOST.csv 10.0.2.81:  >> $LOG_FILE
if [ $? -ne 0 ] ; then
	echo 'fail '	
         mail -s "Rsync Fail on $NAMEHOST" "$mail" < "$LOG_FILE"

fi

echo "$DATE_N_TIME Finished executing rsync " >> $LOG_FILE
echo "" >> $LOG_FILE

