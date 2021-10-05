#!/bin.bash
/tmp/starterscripts/start.sh
rm -rf /tmp/starterscripts/start.sh
exec apachectl -D FOREGROUND

