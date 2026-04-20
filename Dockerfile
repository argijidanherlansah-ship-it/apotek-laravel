FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev zip \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# 🔥 bikin file sqlite
RUN mkdir -p database && touch database/database.sqlite

# 🔥 permission
RUN chmod -R 775 storage bootstrap/cache database

# 🔥 clear cache laravel
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

# 🔥 migrate database
RUN php artisan migrate --force || true

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080

# force redeploy