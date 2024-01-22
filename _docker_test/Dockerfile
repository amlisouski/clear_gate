FROM php:8.1-apache

MAINTAINER Andrzej Lisowski

RUN apt-get update \
    && apt-get -y upgrade

RUN apt-get -y install curl \
    software-properties-common \
    dirmngr \
    gnupg2

#RUN curl -LsS https://downloads.mariadb.com/MariaDB/mariadb_repo_setup | bash -s -- --mariadb-server-version=10.7 --skip-maxscale --skip-tools
#RUN apt-key adv --fetch-keys 'https://mariadb.org/mariadb_release_signing_key.asc'
#RUN add-apt-repository 'deb [arch=amd64,i386,arm64,ppc64el] https://mariadb.mirror.liquidtelecom.com/repo/10.7/debian buster main'
#RUN apt-get update \
#    && apt-get -y install mariadb-server mariadb-client

RUN apt-get update \
    && apt-get -y install vim \
    nano \
    wget \
    git \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    freetype* \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libonig-dev \
    libmcrypt-dev

RUN apt-get update \
    && apt-get install -y zlib1g-dev

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip
#RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ --with-webp=/usr/include/
#RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo pdo_mysql


RUN docker-php-ext-install mbstring
#RUN pecl install mcrypt-1.0.4 && docker-php-ext-enable mcrypt

RUN a2enmod rewrite

COPY test.conf /etc/apache2/sites-available/test.conf


RUN a2ensite test.conf

RUN a2enmod headers
RUN a2enmod include
RUN a2enmod ssl

COPY certs/test.crt /etc/ssl/certs/apache-selfsigned.crt
COPY certs/test.key /etc/ssl/private/apache-selfsigned.key

RUN service apache2 start

EXPOSE 80 443