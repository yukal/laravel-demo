<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Test Task using Laravel

This is a test task within the Laravel framework usage.
See the [task description](_workflow/task-en.md), and the [workflow](_workflow).

![Laravel app within Vue, Inertia, Tailwind - a test task](/_workflow/07-create-movie.png)

## Init

Before the start, please init the database first and set all the variables with `DB_` suffix, at [.env](.env) and [.env.testing](.env.testing) for tests respectively!

### Init Datbase

```bash
# run psql

psql -U postgres
```

```sql
-- Create Users

CREATE USER "laravel" WITH PASSWORD 'laravel_password';
CREATE USER "tester" WITH PASSWORD 'tester_password';

-- Or just give grant access to an existing user(s)

GRANT ALL PRIVILEGES ON DATABASE "your_db_name" to "your_username";

-- Create Databases

CREATE DATABASE "laravel" OWNER "your_laravel_username";
CREATE DATABASE "laravel_testing" OWNER "your_tester_username";
```

### Install Dependencies

```bash
# For unix systems run bash script
./init

# For windows systems run cmd script:
init.cmd
```

## Run App

```bash
# ( ! ) Make sure you have configured your database and environments before running the application

# To serve in dev mode type
composer run dev
```

## Run Tests

```bash
# ( ! ) Make sure you have configured your DB with environments first

# ( ! ) It is important to clear the configuration before starting testing
php artisan config:clear

# Run all tests
php artisan test --env=testing

# Run specific tests
php artisan test --env=testing --filter GenreTest
php artisan test --env=testing --filter MovieTest
```
