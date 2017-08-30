#!/bin/bash

rm -rf /var/www/symfony/var/logs/* /var/www/symfony/var/cache/* /var/www/symfony/var/sessions/*
chown -R www-data:www-data /var/www/symfony/var/cache
chown -R www-data:www-data /var/www/symfony/var/logs
chown -R www-data:www-data /var/www/symfony/var/sessions