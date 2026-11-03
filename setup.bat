@echo off
REM Run from the folder containing this file (PHP 8.2+, Composer, MySQL required)
set OVERLAY=%~dp0
call composer create-project laravel/laravel ..\student-management
cd ..\student-management
call composer require laravel/breeze --dev
call php artisan breeze:install blade
call composer require spatie/laravel-permission
call php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
xcopy "%OVERLAY%app" app /E /I /Y
xcopy "%OVERLAY%bootstrap" bootstrap /E /I /Y
xcopy "%OVERLAY%database" database /E /I /Y
xcopy "%OVERLAY%routes" routes /E /I /Y
xcopy "%OVERLAY%resources" resources /E /I /Y
echo Now edit .env (DB settings), create the database, then run: php artisan migrate:fresh --seed ^&^& php artisan serve
