FROM ubuntu:18.04

# Install any custom system requirements here

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get -qq update \
  && apt-get -qq -y upgrade \
  && apt-get install -qq -y --no-install-recommends \
                wget \
                curl \
                mc \
                htop \
                git \
                p7zip-full \
                software-properties-common

ENV LC_ALL=C.UTF-8
RUN add-apt-repository ppa:ondrej/php \
 && apt-get -qq update


RUN apt-get -qq -y install  php7.4-cli \
                php7.4-fpm \
                php7.4-curl \
                php7.4-gd \
                php7.4-memcache \
                php7.4-memcached \
                php7.4-mysql \
                php7.4-sqlite3 \
                php7.4-json \
                php7.4-intl \
                php7.4-xdebug \
                php7.4-xsl \
                php7.4-zip \
                php7.4-mbstring \
        && apt-get -qq autoclean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN sed -i -e "s/DAEMON_ARGS=\"/DAEMON_ARGS=\"--allow-to-run-as-root /g" /etc/init.d/php7.4-fpm

RUN mkdir /run/php

WORKDIR /var/www
EXPOSE 9010-9015

CMD ["php-fpm7.4", "--nodaemonize"]
