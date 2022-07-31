FROM php:8.1.3-fpm-alpine3.14

MAINTAINER Marko Vušak <marko.vusak2@gmail.com>

RUN apk update && apk upgrade && \
    apk add --no-cache bash git zlib-dev && \
    apk add --no-cache --virtual .build-deps  libzip-dev && \
    apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS

RUN pecl channel-update pecl.php.net && \
    pecl install xdebug && \
    docker-php-ext-install mysqli pdo_mysql zip && \
    docker-php-ext-enable xdebug

RUN addgroup -g 1000 app && \
    adduser -s /bin/sh -DS -u 1000 -G app app

# Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

RUN mkdir -m 777 -p ~/app/var && \
    mkdir -m 777 -p ~/app/vendor && \
    mkdir -m 777 -p ~/app/var

USER app
WORKDIR /app

CMD  ["php-fpm", "-F"]
