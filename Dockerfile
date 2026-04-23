FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN cp .env.example .env || true

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

# 🔥 APP KEY
RUN php artisan key:generate

# 🔥 SQLITE
RUN mkdir -p database && touch database/database.sqlite

# 🔥 CLEAR CACHE
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan route:clear
RUN php artisan view:clear

RUN chmod -R 777 storage bootstrap/cache database

EXPOSE 8080

# 🔥 MIGRATE DI RUNTIME + START SERVER
CMD php artisan migrate --force && php -S 0.0.0.0:${PORT} -t public