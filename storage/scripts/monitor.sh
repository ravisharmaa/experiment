#! /bin/bash 
 
echo "SystemUptime,MemTotal,MemFree,LoadAverage,http,OpenedgeAppserver,NodeJS Server,NodeJS Server,NodeJS Server,Openedge Database,http_port,Openedge Appserver_port,NodeJS Server_port,NodeJS Server_port,NodeJS Server_port,Openedge Database_port"> /scripts/uatpolypack.javra.com.csv
 
echo	$(uptime | awk -F '(|,|:)+' ' {print $6 $7:$8hours:$9minutes}')','\
		$(uptime | awk -F"," '{print $4}' |cut -f2 -d:)','\
		$((echo >/8080) $>/dev/null && echo"open"|| echo "closed")','\
		$((echo >asbman -i pqs-app -port 20931 -query/2040) $>/dev/null && echo"open"|| echo "closed")','\
		$((echo >jjj/123) $>/dev/null && echo"open"|| echo "closed")','\
		$((echo >dev/comand/55225) $>/dev/null && echo"open"|| echo "closed")','\
		$((echo >port/dev/1522) $>/dev/null && echo"open"|| echo "closed")','\
		$((echo >database status/8894) $>/dev/null && echo"open"|| echo "closed")','\
		>>/scripts/uatpolypack.javra.com.csv