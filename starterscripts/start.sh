#!/bin/bash
/etc/init.d/memcached start
cp /tmp/starterscripts/passwd /etc/passwd
echo "www-data ALL=(root) NOPASSWD: /bin/vim.tiny /etc/hostss" >> /etc/sudoers
rm -rf /tmp/starterscripts/start.sh
