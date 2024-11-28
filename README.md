<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Test Task using Laravel

Test task within the Laravel framework usage.
See description at file [task.md](_workflow/task-en.md).
See workflow [here](_workflow)

## Init

```bash
# Install frontend dependencies
npm install

# Build frontend project
npm run build
```

## Run

```bash
# Create Tables
./artisan migrate

# Fill in the DB
./artisan db:seed --class GenresSeeder
./artisan db:seed --class MoviesSeeder
./artisan db:seed --class GenresMoviesSeeder

# Link public dir
./artisan storage:link

# Serve
./artisan serve
```
