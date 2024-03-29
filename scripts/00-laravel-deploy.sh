#!/usr/bin/env bash
echo "Running composer"
composer install --working-dir=/var/www/html
composer composer require fakerphp/faker

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force --seed

echo "Installing npm packages..."
npm install
npm run production

