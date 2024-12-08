composer install
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan storage:link
php artisan key:generate
php artisan migrate --seed

npm install
