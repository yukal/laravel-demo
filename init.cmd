composer install
php artisan storage:link
php artisan key:generate
php artisan key:generate --env=testing
php artisan migrate --database pgsql --seed
php artisan migrate --database pgsql_testing

npm install
npm run build
