FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    nano \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer    

# Install PHP extensions for MySQL and PDO
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
