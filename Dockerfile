FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# sqlite
RUN mkdir -p database && touch database/database.sqlite

# permission
RUN chmod -R 777 storage bootstrap/cache database

# clear cache
RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# 🔥 migrate (WAJIB)
RUN php artisan migrate --force || true

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080