FROM php:7.2-fpm


RUN mkdir -p /usr/share/man/man1 && mkdir -p /usr/share/man/man7 && apt-get update && apt-get install -y apt-utils && apt-get install -y libpq-dev dnsutils iputils-ping vim
RUN docker-php-ext-install pdo_pgsql

RUN touch /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize = 5M;" >> /usr/local/etc/php/conf.d/uploads.ini
