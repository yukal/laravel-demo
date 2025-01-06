composer install
php artisan storage:link
php artisan key:generate
php artisan key:generate --env=testing
php artisan migrate --seed
php artisan migrate --env=testing

npm install
npm run build
