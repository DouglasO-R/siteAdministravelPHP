FROM php:7.2.0-fpm-alpine
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql