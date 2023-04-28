FROM php:5.6-fpm-alpine
RUN apk update; \
    apk upgrade; \
    apk add libmcrypt-dev
RUN docker-php-ext-install mysqli mcrypt pdo_mysql
RUN docker-php-ext-enable mcrypt pdo_mysql