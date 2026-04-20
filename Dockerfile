FROM php:8.2-cli

WORKDIR /app

COPY . .

# install dependency
RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_sqlite

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# install laravel dependency
RUN composer install --no-dev --optimize-autoloader

# 🔥 buat database sqlite
RUN mkdir -p database && touch database/database.sqlite

# 🔥 set permission (wajib di railway)
RUN chmod -R 777 storage bootstrap/cache database

# 🔥 clear cache laravel
RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# 🔥 migrate database
RUN php artisan migrate --force || true

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080