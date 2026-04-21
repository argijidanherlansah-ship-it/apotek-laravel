FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies & build Vite
RUN npm install
RUN npm run build

# Clear cache
RUN php artisan config:clear
RUN php artisan cache:clear

# Permission
RUN chmod -R 777 storage bootstrap/cache

# Run app
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]