FROM php:7.4-apache
WORKDIR /var/www/html

RUN apt-get update
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.1.1 --install-dir=/usr/local/bin --filename=composer
COPY . .


