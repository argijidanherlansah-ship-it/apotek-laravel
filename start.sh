#!/bin/bash

echo "STARTING APP..."

# buat sqlite (WAJIB)
touch /tmp/database.sqlite

# migrate database
php artisan migrate --force

# clear cache biar aman
php artisan config:clear
php artisan cache:clear

# jalanin server
php artisan serve --host=0.0.0.0 --port=$PORT