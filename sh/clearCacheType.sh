#!/bin/bash

PATH=$1

URL="http://activity.arkadiame.wa/$PATH"

/usr/bin/curl -s -D - $URL -o /dev/null --resolve 'activity.arkadiame.wa:80:127.0.0.1'