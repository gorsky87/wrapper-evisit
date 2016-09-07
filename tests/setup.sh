#!/usr/bin/env bash

if [ ! -e "codecept.phar" ]
then
    wget http://codeception.com/codecept.phar
fi

if [ ! -e "selenium-server-standalone.jar" ]
then
    wget -O selenium-server-standalone.jar http://goo.gl/XzdgHy
fi

if [ ! -e "codeception.yml" ]
then
    cp ./templates/codeception.yml ./codeception.yml
    echo "Template codeception.yml copied to ./test root. Edid this to match your environment and restart the script"
    exit
fi


