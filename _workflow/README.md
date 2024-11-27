## Create Migration

```bash
./artisan make:migration create_genres_table --create=genres
./artisan make:migration create_movies_table --create=movies
./artisan make:migration create_genres_movies_table --create=genres_movies
```

## Create Seeders

```bash
./artisan make:seeder GenresSeeder
./artisan make:seeder MoviesSeeder
./artisan make:seeder GenresMoviesSeeder
```

## Create Controllers & Models

```bash
./artisan make:controller GenreController --resource --model=Genre
./artisan make:controller MovieController --resource --model=Movie
```

## Create Requests

```bash
./artisan make:request GenreStoreRequest
./artisan make:request GenreUpdateRequest
./artisan make:request MovieStoreRequest
./artisan make:request MovieUpdateRequest
```

## Create Views

```bash
# Genres
./artisan make:view genres.layout
./artisan make:view genres.index
./artisan make:view genres.create
./artisan make:view genres.edit
./artisan make:view genres.show

# Movies
./artisan make:view movies.layout
./artisan make:view movies.index
./artisan make:view movies.create
./artisan make:view movies.edit
./artisan make:view movies.show
```

## Create API Controllers

```bash
./artisan make:controller Api\V1\GenreController
./artisan make:controller Api\V1\MovieController
```

## Additional Info

```bash
# Use rollback if need
./artisan migrate:rollback

# clear cached routes
./artisan route:clear

# clear cached views
./artisan view:clear
```

## Run

```bash
# Create Tables
./artisan migrate

# Fill in the DB
./artisan db:seed --class GenresSeeder
./artisan db:seed --class MoviesSeeder
./artisan db:seed --class GenresMoviesSeeder

# Serve
./artisan storage:link
./artisan serve
```
