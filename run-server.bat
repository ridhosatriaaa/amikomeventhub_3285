@echo off
set PHPRC=D:\laragon\bin\php\php\php.ini
echo PHPRC is set to: %PHPRC%
php -r "echo extension_loaded('openssl') ? 'OpenSSL: OK' : 'OpenSSL: FAIL';" && echo.
cd /d D:\laragon\www\amikomeventhub_3285
php artisan serve
