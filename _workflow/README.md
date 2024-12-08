## First Init

( ! ) Don't follow this part if you want to initialize clonned part.
Follow these steps only when you plan to create application from scratch.
I just leve this part here to demonstrate what the steps I encountered.

See how [Install](https://laravel.com/docs/11.x#creating-a-laravel-project) PHP and the Laravel Installer before the init. Additional info about how to:
- Creating the [Resource Controllers](https://laravel.com/docs/11.x/controllers#resource-controllers)
- Supplementing the [Resource Controllers](https://laravel.com/docs/11.x/controllers#restful-supplementing-resource-controllers)
- Specifying the [Resource Model](https://laravel.com/docs/11.x/controllers#specifying-the-resource-model)
- Generating the [Form Requests](https://laravel.com/docs/11.x/controllers#generating-form-requests)
- Creating the API [Resource Routes](https://laravel.com/docs/11.x/controllers#api-resource-routes)

```bash
# install app
laravel new app

# link public storage
php artisan storage:link

# Create controllers, models, migrations, and seeders
php artisan make:model Genre --migration --seed --controller --resource --requests
php artisan make:model Movie --migration --seed --controller --resource --requests

# Create pivot model
php artisan make:model GenreMovie --migration --seed

# Create request for publishing a movie
php artisan make:request PublishMovieRequest

# Rise up migrations
php artisan migrate

# Create Views: Genres
php artisan make:view genres.index
php artisan make:view genres.create
php artisan make:view genres.edit
php artisan make:view genres.show

# Create Views: Movies
php artisan make:view movies.index
php artisan make:view movies.create
php artisan make:view movies.edit
php artisan make:view movies.show

# make API available
php artisan install:api

# Create controllers for the API
php artisan make:controller Api\V1\GenreController
php artisan make:controller Api\V1\MovieController

npm install
```

## Additional Info

```bash
# Use rollback if need
php artisan migrate:rollback

# clear cached routes
php artisan route:clear

# clear cached views
php artisan view:clear

# make available API
php artisan install:api
```

## Init <small>(for clonned project)</small>
```bash
# For unix systems start:
./init

# For windows systems start:
init.cmd
```

## Run

```bash
php artisan serve

# or

composer run dev
```
