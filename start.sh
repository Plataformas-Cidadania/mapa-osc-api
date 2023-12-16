#!/bin/sh
cd /app/
composer install
composer dump-autoload
#php artisan passport:install
#php artisan passport:keys
#php artisan key:generate --force
#php artisan config:clear
#php artisan config:cache
php artisan migrate
php -S 0.0.0.0:8000 -t public/