FROM php:8.0-apache
WORKDIR /var/www/html
RUN apt-get update && apt-get upgrade -y
RUN apt-get install libmariadb-dev -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN a2enmod rewrite
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
