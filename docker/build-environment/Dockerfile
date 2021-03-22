FROM php:7.4-fpm-alpine

RUN apk update \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apk add sqlite \
    && apk add socat \
    && apk add php7-sqlite3