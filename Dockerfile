FROM php:7.2-fpm-alpine3.8

WORKDIR /app
ADD . .

RUN apk upgrade --update && apk --no-cache add \
    coreutils \
    libltdl \
    bash \
    binutils \
    patch

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS}

COPY config/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/101-xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer