#!/bin/bash
# Run from the folder that contains this file. Needs PHP 8.2+, Composer, MySQL running.
set -e
OVERLAY="$(cd "$(dirname "$0")" && pwd)"
composer create-project laravel/laravel ../student-management
cd ../student-management
composer require laravel/breeze --dev
php artisan breeze:install blade
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
# copy project files over the fresh install
cp -r "$OVERLAY/app" "$OVERLAY/bootstrap" "$OVERLAY/database" "$OVERLAY/routes" "$OVERLAY/resources" .
echo ">> Now edit .env (DB_CONNECTION=mysql, DB_DATABASE, DB_USERNAME, DB_PASSWORD), create the database, then run:"
echo "   php artisan migrate:fresh --seed && php artisan serve"
