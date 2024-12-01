composer install

php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan storage:unlink
php artisan storage:link
php artisan key:generate
php artisan migrate
php artisan config:clear
php artisan config:cache

php artisan db:seed --class GenresSeeder
php artisan db:seed --class MoviesSeeder
php artisan db:seed --class GenresMoviesSeeder

npm install
