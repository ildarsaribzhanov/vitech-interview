FROM php:7.4-fpm-alpine

RUN apk add --no-cache unzip
RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www

COPY composer.json .
COPY composer.lock .

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer \
    && rm composer-setup.php

RUN composer install --no-dev --prefer-dist --no-scripts --no-autoloader

COPY . /var/www

RUN composer dump-autoload

RUN mv .env.example .env