#!/bin/bash

#1 - Set Apache group to worldapi/storage folder
chgrp -R www-data /opt/www/worldapi/storage

#2 - Set write access for group to worldapi/storage folder
chmod -R g+rw /opt/www/worldapi/storage

#3 - Waiting to MySQL container, has been initialized.
#
#    A good practice here, could be to try to find a command to check the MySQL status 
#    and avoid use the sleep command since it is not a synchronization guarantee.
#
sleep 30

#4 - Run database migration
php /opt/www/worldapi/artisan migrate

#5 - Populate Country Table
php /opt/www/worldapi/artisan db:seed --class=CountryTableSeeder

exec "$@"