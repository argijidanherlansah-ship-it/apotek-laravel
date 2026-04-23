FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

RUN php artisan config:clear
RUN php artisan cache:clear

RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]