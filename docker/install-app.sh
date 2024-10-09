#!/bin/bash
echo "Starting app installation"
cd /
cp -r /ownsafe/www/* /var/www/html
cp /ownsafe/docker/nginx-conf/* /docker/nginx-conf/ -r
cp /ownsafe/docker/php/php-logging.conf /docker/php/
echo "App installation finisched"

