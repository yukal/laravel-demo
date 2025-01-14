## Approach

This approach is not suitable for production.

In this approach, I prioritize setting up the **development** infrastructure directly on your workstation.

To minimize disk space usage, I will leverage the [Alpine](https://alpinelinux.org/) Linux distribution. [Alpine](https://hub.docker.com/_/alpine) is known for its lightweight nature, being highly optimized with minimal unnecessary files and services. I will also employ specific [Docker](https://www.docker.com/) features to further reduce the image size.

Development happens directly on your host machine, removing the isolation and file access barriers typically associated with containerized environments.
In this case, we'll use [Docker volumes](https://docs.docker.com/engine/storage/volumes/) to minimize the size of the created image. This ensures that the image size remains consistent unless you explicitly add new files.
Using volumes, we can modify any project file, and these changes are instantly reflected in the running Docker services, providing a seamless and immediate development experience.

### Symbolic Link for Storage

Within your project's `public` directory on the host machine, create a symbolic link using `ln -s ../storage/app/public/ storage` to ensure proper storage access within the containerized environment.

### Environment Configuration

1. Configure Build Environment Variables

    Set the user ID, and database credentials in the [.docker/.env](.docker/.env) file. This is required during the Docker image build process.

2. Configure Application Environment Variables

    Before starting, configure environment variables prefixed with `DB_` in the [.env](.env) (development) and [.env.testing](.env.testing) (testing) files. Ensure these variables match the service names defined in your **compose[-namespace].yml** files (e.g., `DB_HOST=postgres`).

Important: Use distinct `user`, `password`, and `database` credentials for each environment (refer to the [Run Tests](#run-tests) section for details).

## Starting the project

To start all project services, run the following command in your terminal:

```bash
docker compose \
  --file compose.dev.yml \
  --env-file .docker/.env \
  --project-name laravel \
  up
```

*I prefer to run this command interactively (without the `-d` flag), especially during the initial run. This allows me to directly observe the startup process and identify any potential errors in real-time, instead of having to manually check the logs of each container.*

If the build and startup process was successful, we can proceed to the next steps. Otherwise, we need to troubleshoot the issues encountered during the startup process.


### Configuring the Database for testing

If you are not planning to run tests, you can skip this section.

1. **Access the Database Container**.

    Execute the following command in your terminal:

    ```bash
    docker exec -it -u root laravel_db ash
    ```

    This will place you within the running database container and provide you with a terminal.

2. **Connect to the PostgreSQL Database**.

    Invoke the **psql** command to interact with the PostgreSQL database:

    ```bash
    # your database root user defined at .env 
    psql -U $POSTGRES_USER
    ```

3. **Create the Testing Database and User**.

    Execute the following SQL commands:

    ```sql
    CREATE USER "laravel_tester" WITH PASSWORD 'your_password';
    CREATE DATABASE "laravel_testing_db" OWNER 'laravel_tester';
    GRANT ALL PRIVILEGES ON DATABASE "laravel_testing_db" to "laravel_tester";
    ```

4. **Exit psql**.

    Type `\q` and press Enter to exit the interactive `psql` mode.

    - `\du`: Lists existing users/roles.
    - `\l`: Lists existing databases.
    - `\?`: Displays a list of available commands.

5. **Exit the Container**.

    To exit the container, press **CTRL**+**D** (for Linux users) or **CMD**+**D** (for Mac users), or just type `exit` and press Enter. This will terminate the current session and return you to the host machine's terminal.


### Application setup

1. **Access the PHP Container**.

    Execute the following command in your terminal:

    ```bash
    docker exec -ti laravel_php ash
    ```

    This will place you within the running container and provide you with a terminal.

2. **Install dependencies**.

    Install backend dependencies:

    ```bash
    composer install

    # (optional)
    # composer update
    ```

    Install frontend dependencies:

    ```bash
    npm install

    # (optional)
    # npm outdated
    # npm update

    npm run build
    ```

3. **Generate Application Keys**.

    Generate keys for the default environment:

    ```bash
    php artisan key:generate
    ```

    Generate keys for the testing environment:

    ```bash
    php artisan key:generate --env=testing
    ```

4. **Run Migrations**.

    Run migrations for the default environment:

    ```bash
    php artisan migrate --seed
    ```

    Run migrations for the testing environment:

    ```bash
    php artisan migrate --env=testing
    ```

5. **Run Tests**.

    Run all tests:

    ```bash
    php artisan config:clear
    php artisan test --env=testing
    ```

    Run all tests with coverage:

    ```bash
    php artisan config:clear
    XDEBUG_MODE=coverage php artisan test --env=testing --coverage
    ```

    Run specific tests:

    ```bash
    php artisan config:clear

    php artisan test --env=testing --filter GenreTest
    php artisan test --env=testing --filter MovieTest
    ```

6. **Exit the Container**.

    To exit the container, press **CTRL**+**D** (for Linux users) or **CMD**+**D** (for Mac users), or type exit and press Enter. This will terminate the current session and return you to the host machine's terminal.


### Run Migrations

Using an alternative way if you missed running migrations during [application setup](application-setup)

```bash
docker exec your_php_container_name ash -c "php artisan migrate:refresh --seed"

# Example:
docker exec laravel_php ash -c "php artisan migrate:refresh --seed"
docker exec laravel_php ash -c "php artisan migrate:refresh --env=testing"
```

### Run Tests

Using an alternative way if you don't want to enter inside a container and run tests as described at [application setup](application-setup)

**( ! ) Critical**

Avoid running tests against the same database that you specify in the development environment. Running tests will inevitably destroy all existing data and interrupt development work.

Make sure you have configured your DB with environments first.
It is also important to clear (`php artisan config:clear`) the configuration before starting testing.

```bash
# Run all tests
docker exec laravel_php ash -c "php artisan config:clear && php artisan test --env=testing"

# Run specific tests
docker exec laravel_php ash -c "php artisan config:clear && php artisan test --env=testing --filter GenreTest"

docker exec laravel_php ash -c "php artisan config:clear && php artisan test --env=testing --filter MovieTest"
```

## Cleanup

```
docker compose \
  --file compose.dev.yml \
  --env-file .docker/.env \
  --project-name laravel \
  down --volumes --rmi all
```