FROM php:7.0-apache

MAINTAINER Cassiano Tartari <cassioanotartari@gmail.com>

RUN a2enmod rewrite

RUN docker-php-ext-install opcache

COPY server/php.ini /usr/local/etc/php/
ADD server/apache-config.conf /etc/apache2/sites-enabled/000-default.conf

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/html/app