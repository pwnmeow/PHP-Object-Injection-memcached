#!/bin/bash
/etc/init.d/memcached start
cp /tmp/passwd /etc/passwd
echo "www-data ALL=(root) NOPASSWD: /bin/vim.tiny /etc/hostss" >> /etc/sudoers
exec apachectl -D FOREGROUND
rm -rf /tmp/starterscripts
