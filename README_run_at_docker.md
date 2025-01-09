## Approach

This approach is not suitable for production.

In this approach, I prioritize setting up the **development** infrastructure directly on your workstation.

To minimize disk space usage, I will leverage the [Alpine](https://alpinelinux.org/) Linux distribution. [Alpine](https://hub.docker.com/_/alpine) is known for its lightweight nature, being highly optimized with minimal unnecessary files and services. I will also employ specific [Docker](https://www.docker.com/) features to further reduce the image size.

Development happens directly on your host machine, removing the isolation and file access barriers typically associated with containerized environments.
In this case, we'll use [Docker volumes](https://docs.docker.com/engine/storage/volumes/) to minimize the size of the created image. This ensures that the image size remains consistent unless you explicitly add new files.
Using volumes, we can modify any project file, and these changes are instantly reflected in the running Docker services, providing a seamless and immediate development experience.

### Environment Configuration

Before starting, configure environment variables prefixed with `DB_` in the [.env](.env) (development) and [.env.testing](.env.testing) (testing) files. Ensure these variables match the service names defined in your **docker-compose[-namespace].yml** files (e.g., `DB_HOST=postgres`).

Important: Use distinct `user`, `password`, and `database` credentials for each environment (refer to the [Run Tests](#run-tests) section for details).

To prevent file system access conflicts between the host machine and the container, specify the [user directive](https://docs.docker.com/reference/compose-file/services/#user) in the **docker-compose[-namespace].yml** file. Set the user value to a [user ID](https://linuxhandbook.com/uid-linux/) and [group ID](https://linuxhandbook.com/uid-linux/) (e.g., 1000:1000) that matches your user ID and group ID on the host machine.

### Symbolic Link for Storage

Within your project's public directory on the host machine, create a symbolic link using `ln -s ../storage/app/public/ storage` to ensure proper storage access within the containerized environment.

## Starting the project

To start all project services, run the following command in your terminal:

```bash
docker-compose --file docker-compose-dev.yml up
```

I prefer to run this command interactively (without the `-d` flag), especially during the initial run. This allows me to directly observe the startup process and identify any potential errors in real-time, instead of having to manually check the logs of each container.

If the build and startup process was successful, we can proceed to the next steps. Otherwise, we need to troubleshoot the issues encountered during the startup process.


### Configuring the Database for testing

If you are not planning to run tests, you can skip this step.

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
    # and  docker-compose[-namespace].yml
    psql -U your_postgres_username

    # example
    psql -U laravel
    ```

3. **Create the Testing Database and User**.

    Execute the following SQL commands:

    ```sql
    CREATE USER "your_tester_username" WITH PASSWORD "your_tester_password";

    CREATE DATABASE "your_testing_db" OWNER "your_tester_username";

    GRANT ALL PRIVILEGES ON DATABASE "your_testing_db" to "your_tester_username";
    ```

4. **Exit psql**.

    Type `\q` and press Enter to exit the interactive `psql` mode.

    - `\du`: Lists existing users/roles.
    - `\l`: Lists existing databases.
    - `\?`: Displays a list of available commands.

5. **Exit the Container**.

    To exit the container, press **CTRL**+**D** (for Linux users) or **CMD**+**D** (for Mac users), or just type `exit` and press Enter. This will terminate the current session and return you to the host machine's terminal.


### Install dependencies

1. **Access the PHP Container**.

    Execute the following command in your terminal:

    ```bash
    docker exec -it laravel_php ash
    ```

    This will place you within the running container and provide you with a terminal.

2. **Install dependencies**.

    Install backend dependencies:

    ```bash
    composer install
    ```

    Install frontend dependencies:

    ```bash
    npm install
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
    php artisan config:clear && php artisan test --env=testing
    ```

    Run specific tests:

    ```bash
    # (!) improtant
    php artisan config:clear

    php artisan test --env=testing --filter GenreTest
    php artisan test --env=testing --filter MovieTest
    ```

6. **Exit the Container**.

    To exit the container, press **CTRL**+**D** (for Linux users) or **CMD**+**D** (for Mac users), or type exit and press Enter. This will terminate the current session and return you to the host machine's terminal.


### Run Migrations

(from host machine)

```bash
docker exec your_php_container_name ash -c "php artisan migrate:refresh --seed"

# Example:
docker exec laravel_php ash -c "php artisan migrate:refresh --seed"
docker exec laravel_php ash -c "php artisan migrate:refresh --env=testing"
```

### Run Tests

(from host machine)

**( ! ) Critical**

Avoid running tests against the same database that you specify in the development environment. Running tests will inevitably destroy all existing data and interrupt development work.

```bash
# ( ! ) Make sure you have configured your DB with 
#       environments first

# ( ! ) It is important to clear the configuration 
#       before starting testing

# Run all tests
docker exec laravel_php ash -c "php artisan config:clear && php artisan test --env=testing"

# Run specific tests
docker exec laravel_php ash -c "php artisan config:clear && php artisan test --env=testing --filter GenreTest"

docker exec laravel_php ash -c "php artisan config:clear && php artisan test --env=testing --filter MovieTest"
```
