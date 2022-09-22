#!/bin/bash
./wait-for-it.sh db:5436 -t 30 #ensure db connection
bin/console d:m:m --no-interaction # execute db migrations
php-fpm -F # keep php process running