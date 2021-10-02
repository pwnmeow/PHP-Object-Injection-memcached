#!/bin/bash
/etc/init.d/memcached start
exec apachectl -D FOREGROUND
