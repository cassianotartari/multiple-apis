FROM debian:jessie

MAINTAINER Maxence POUTORD <maxence.poutord@gmail.com>

RUN apt-get update && apt-get install -y \
    nginx

ADD nginx.conf /etc/nginx/
ADD symfony.conf /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/symfony.conf /etc/nginx/sites-enabled/symfony
RUN rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data

CMD ["nginx"]

#RUN rm -rf /var/www/symfony/var/logs/* /var/www/symfony/var/cache/* /var/www/symfony/var/sessions/*
#RUN chown -R www-data:www-data /var/www/symfony/var/cache
#RUN chown -R www-data:www-data /var/www/symfony/var/logs
#RUN chown -R www-data:www-data /var/www/symfony/var/sessions

EXPOSE 80
EXPOSE 443
