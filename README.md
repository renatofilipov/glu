# RENATO FILIPOV - REST API

Please reach out at http://renato.filipov.me or renato@filipov.me if you have any questions how to install and use this app =)

## QUICK INSTALL

### Pre Requisite

- Git
- Composer
- PHP 7.3+
- MySQL


### Step by Step

In your terminal, please execute these commands:

```bash
$ git clone https://github.com/renatofilipov/glu.git && cd glu
$ composer install
$ composer start
```


### Configuration

Please update the file `.env` with your database credentials


### Database

- Create a new MySQL database called `rfilipov` (or any other name that matches the `.env` config)

- Extract file `/database/database.sql` into this new database

```bash
$ mysql rfilipov < database/database.sql
```



## DEPENDENCIES

### LIST OF REQUIRE DEPENDENCIES

- [slim/slim](https://github.com/slimphp/Slim): Slim is a PHP micro framework that allows us to quickly write simple yet powerful web applications and APIs.
- [palanik/corsslim](https://github.com/palanik/CorsSlim): Cross-origin resource sharing (CORS) middleware for PHP Slim.
- [respect/validation](https://github.com/Respect/Validation): The most awesome validation engine ever created for PHP.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER`.
- [predis/predis](https://github.com/phpredis/phpredis): A PHP extension for Redis `(not being used in this project)`

### LIST OF DEVELOPMENT DEPENDENCIES

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): The PHP Unit Testing framework.
- [phpstan/phpstan](https://github.com/phpstan/phpstan): PHPStan - PHP Static Analysis Tool.


## TESTING

Run all PHPUnit tests with `composer test`.

```bash
$ composer test
> phpunit
PHPUnit 8.5.2 by Sebastian Bergmann and contributors.

...............................................................                                                                                                        63 / 63 (100%)

Time: 226 ms, Memory: 14.00 MB

OK (19 tests, 79 assertions)
```


## DOCUMENTATION

### ENDPOINTS

- Main Endpoint: `http://localhost:8080`

#### INFO

- Endpoint Summary: `GET /`

- API Status: `GET /status`


#### TASKS

- Get All Tasks: `GET /api/v1/task`

- Get One Task: `GET /api/v1/task/{id}`

- Create Task: `POST /api/v1/task`

- Update Task: `PUT /api/v1/task/{id}`

- Delete Task: `DELETE /api/v1/task/{id}`

- Client to Create Tasks: `http://localhost:8080/client/task/create`
(allows us to simulate an endpoint creating jobs/tasks without using Postman)

- Process Next Task: `GET /api/v1/task/next`