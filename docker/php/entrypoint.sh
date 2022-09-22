#!/bin/bash
./wait-for-it.sh db:5435 -t 30
/var/www/html/bin/console d:m:m