# Book Database

## Requirements
- [Docker](https://docs.docker.com/install)
- [Docker Compose](https://docs.docker.com/compose/install)

## Setup
1. Clone the repository.
2. Start the containers by running the following in the project root:
```
docker-compose up -d
```
3. Install the composer packages by running:
```
docker-compose exec laravel composer install
```
4. Preform migratations by running:
```
docker-compose exec laravel php artisan migrate:refresh --seed
```
5. Access the Laravel instance on `http://localhost`

Note: If there is a `"Permission denied"` error run:
```
docker-compose exec laravel chown -R www-data storage
```

Note that the changes you make to local files will be automatically reflected in the container.

## Testing

Run full test suite:
```
docker-compose exec laravel ./vendor/bin/phpunit
```

To run specific test:
```
docker-compose exec laravel ./vendor/bin/phpunit <nameOfTest>
```

### Code Coverage

To generate a full code coverage report:
```
docker-compose exec laravel ./vendor/bin/phpunit --coverage-html ./coverage
```

In phpunit.xml, I’ve included a commented-out `<exclude>` block inside the `<whitelist>` section. Uncommenting it will restrict coverage reports to code I have written, excluding framework and boilerplate directories:
```
<whitelist processUncoveredFilesFromWhitelist="true">
    <directory suffix=".php">./app</directory>
    <!-- Uncomment for: Test coverage report for code I have implemented -->
    <!-- <exclude>
        <directory suffix=".php">./app/Console</directory>
        <directory suffix=".php">./app/Providers</directory>
        <directory suffix=".php">./app/Http/Middleware</directory>
        <directory suffix=".php">./app/Http/Controllers/Auth</directory>
    </exclude> -->
</whitelist>
```

While I would not do this in a production app, I have add this for convenience so that who ever is testing this can uncomment the `exclude` section and will get an accurate report of the code I have implemented and not the code that was provided.

## Persistent database (Optional)
To persist database data across container rebuilds, add a `docker-compose.override.yml` file:
```
version: "3.7"

services:
  mysql:
    volumes:
    - mysql:/var/lib/mysql

volumes:
  mysql:
```

Then run the following:
```
docker-compose stop \
  && docker-compose rm -f mysql \
  && docker-compose up -d
``` 

## Assumtions

1. For the purpose of this assignment I am assuming that the requirements laid out in the provided `homework.txt` file was the core features to be implemented. As such authentication and authorization have not been implemented in the application.
2. As no UI/UX specifications were provided, I made design and layout decisions independently.
3. All features are implemented on a single route `/books` for simplicity and completeness.

## Notes:

1. I deliberately limited external dependencies to focus on core PHP, Laravel, HTML, and CSS functionality.
2. While `.env` is excluded via `.gitignore` (standard best practice), I’ve included the values below for convenience in running the project:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=secret
```

