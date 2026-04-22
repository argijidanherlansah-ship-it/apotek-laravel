FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy semua file project
COPY . .

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Install & build frontend (Vite)
RUN npm install
RUN npm run build

# Clear cache Laravel
RUN php artisan config:clear
RUN php artisan cache:clear

# Permission (biar gak error storage)
RUN chmod -R 777 storage bootstrap/cache

# Jalankan server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]