FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev zip \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

# generate key
RUN php artisan key:generate

# expose port railway
EXPOSE 8080

# jalanin laravel
CMD php artisan serve --host=0.0.0.0 --port=8080