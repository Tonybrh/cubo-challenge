FROM php:8.3-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libzip-dev \
    netcat-openbsd \
    && docker-php-ext-install pdo pdo_pgsql gd zip


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data storage bootstrap/cache

COPY .env.example .env
RUN php artisan key:generate

HEALTHCHECK --interval=30s --timeout=3s \
  CMD php -r "try { \$sock=fsockopen('localhost',9000); fclose(\$sock); exit(0); } catch(Exception \$e) { exit(1); }"
