#!/usr/bin/env bash
# exit on error
set -o errexit

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache config
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Generate application key if not set
php artisan key:generate --force

# Run database migrations
php artisan migrate --force

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 775 storage bootstrap/cache
