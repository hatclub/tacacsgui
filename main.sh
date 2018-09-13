#!/bin/bash
# TacacsGUI Main Script
# Author: Aleksey Mochalin

####  VARIABLES  ####
####
####  FUNCTIONS ####
ROOT_PATH="/opt/tacacsgui";
source "$ROOT_PATH/scripts/functions/map.sh";
source "$FUN_GENERAL";
####  FUNCTIONS ####  END

if [ $# -eq 0 ]
then
	echo "Error!";
	exit 0;
	#clear;

fi

case $1 in
	ha)
		#echo "${@:2}";
		$HA_SCRIPT_PATH $(printf "%s\n" "${@:2}");
	;;
	check)
		case $2 in
		mavis)
			/usr/local/bin/mavistest $ROOT_PATH/tac_plus.cfg_test tac_plus TACPLUS $3 $4
		;;

		ldapsearch)
			#ldapsearch -x -LLL -h WIN-I8GVEDVHNBK.WIN2008.G33 -D "CN=Alexey AM,CN=Users,DC=win2008,DC=g33" -w cisco123 -b 'CN=Users,DC=win2008,DC=g33' -s sub '(&(objectclass=user)(sAMAccountName=user2))'
		;;

		smpp-client)
			#php $ROOT_PATH/mavis-modules/sms/smpptest.php <type> <ipddr> <port> <debug> <login> <pass> <srcname> <number> <username>
			php $ROOT_PATH/mavis-modules/sms/smpptest.php $3 $4 $5 $6 $7 $8 $9 ${10} ${11}
		;;

		*)
			echo 'Unexpected argument for check. Exit.'
			exit 0
		;;
		esac
	;;
	delete)
		#find $ROOT_PATH/$3 -mmin +15 -exec rm -f {} \;
		DIRECTORY=$2;
		if [[ $DIRECTORY = "temp" ]]; then
			find $ROOT_PATH/temp/ ! -name '.gitkeep' -mmin +15 -type f -exec rm -f {} \;
			echo -n 0;
		else echo 'non ';
		fi
	;;
	network)
		if [[ ! -z $2 ]] && [[ $2 -eq 'save' ]]; then
			#ls -l  $ROOT_PATH/temp/$3.cfg
			if [[ ! -z $3 ]] && [ -f $ROOT_PATH/temp/$3.cfg ]; then
					cp $ROOT_PATH/temp/$3.cfg /etc/network/interfaces.d/$3.cfg
					sudo $ROOT_PATH/interfaces.sh restart $3
					echo -n 1;
					exit 0;
			fi
		fi
	;;
	tac_plus)
		if [[ ! -z $2 ]] || [[ $2 -eq 'start' ]] || [[ $2 -eq 'stop' ]] || [[ $2 -eq 'restart' ]] || [[ $2 -eq 'status' ]]; then
			if [[ ! -f /etc/init/tac_plus.conf ]]; then
touch /etc/init/tac_plus.conf
echo '#tac_plus daemon
description "tac_plus daemon"
author "Marc Huber"
start on runlevel [2345]
stop on runlevel [!2345]
respawn
# Specify working directory
chdir /opt/tacacsgui
exec tac_plus.sh' > /etc/init/tac_plus.conf;
cp $ROOT_PATH/tac_plus.sh /etc/init.d/tac_plus
	sudo systemctl enable tac_plus
			fi

			if [[ ! -z $3 ]] && [[ $3 -eq 'brief' ]]; then
				service tac_plus $2 | grep 'Active:';
			else
				service tac_plus $2
			fi
		fi
	;;
	ntp)
		#sudo systemctl restart ntp.service
		#sudo vim /etc/ntp.conf
		#timedatectl list-timezones
		#ntpq -p
		case $2 in
		get-time)
			date "+%F %T";
		;;
		get-timezone)
			timedatectl | grep -o -P '(?<=Time zone: ).*(?= \(.*\))';
		;;
		timezone)
			timedatectl set-timezone $3
			timedatectl set-ntp 0
		;;
		get-config)
			if [[ ! -f $ROOT_PATH/temp/ntp.conf ]]; then
				echo -n 0;
				exit 0;
			fi
			if [[ $(cat /etc/ntp.conf | grep Tacacs | wc -l) != "1" ]]; then
				mv /etc/ntp.conf /etc/ntp.conf_old
			fi
			mv $ROOT_PATH/temp/ntp.conf /etc/ntp.conf
			sleep 1;
			sudo systemctl restart ntp.service
			echo -n 1
			exit 0
		;;

		*)
			echo 'Unexpected argument for check. Exit.'
			exit 0
		;;
		esac
	;;
	*)
		echo 'Unexpected main argument. Exit.'
		exit 0
	;;
esac

exit 0;
