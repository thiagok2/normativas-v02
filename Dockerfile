# our base image
FROM php:7.2-fpm
RUN mkdir -p /usr/share/man/man1 && mkdir -p /usr/share/man/man7 && apt-get update && apt-get install -y apt-utils && apt-get install -y git zip unzip postgresql-client libpq-dev 
RUN docker-php-ext-install pdo_pgsql
WORKDIR /app

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1


COPY . /app
#RUN composer dump-autoload

#RUN composer install

#RUN php artisan key:generate

