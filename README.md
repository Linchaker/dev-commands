# Laravel DEV Commands

A list of console commands that help in the setup/development of the Laravel project.

## Installation

This package can be installed through Composer.

```bash
composer require linchaker/dev-commands
```

## Usage

### Check Database connection

Check if the database connection is configured correctly.

Default connection is mysql
```bash
php artisan check:db
```

Check connection to another database:
```bash
php artisan check:db pgsql
```

### Check Redis connection

Check if the redis connection is configured correctly.

Default connection is "default"
```bash
php artisan check:redis
```

Check another connection:
```bash
php artisan check:redis cache
```

### Generate PHPDoc for model's table 

Creates a PHPDoc for some table and prints it to the console.

For example, create documentation for the "users" table:
```bash
php artisan gen:phpdoc users
```
Default DB connection is mysql, if you need another connection, pass it as second argument:
```bash
php artisan gen:phpdoc users pgsql
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
