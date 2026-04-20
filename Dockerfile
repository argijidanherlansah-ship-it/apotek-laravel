FROM php:8.2-cli

WORKDIR /app

COPY . .

# install dependency php
RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_sqlite

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# install laravel dependency
RUN composer install --no-dev --optimize-autoloader --no-interaction

# buat sqlite
RUN mkdir -p database
RUN touch database/database.sqlite

# permission (AMAN)
RUN chmod -R 777 storage bootstrap/cache database || true

# ❌ JANGAN ADA ARTISAN DI BUILD
# (ini penyebab build lu gagal tadi)

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080