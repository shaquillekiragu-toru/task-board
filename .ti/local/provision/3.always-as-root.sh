#!/usr/bin/env bash

/usr/bin/env bash /home/vagrant/ti-utils/3.always-as-root.sh

pkill -9 mysql
pkill -9 mysqld
service mysql start

# mount -o exec /dev/cdrom /media/cdrom
# /media/cdrom/install --install-unattended-with-deps