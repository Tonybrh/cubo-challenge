FROM php:8.3-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql gd zip


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
