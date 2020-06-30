# Web Akuntansi
build from `Laravel 6`

## Server Requirements
- MySQL 
- PHP ^7.2
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Gd PHP Extension
- Zip PHP Extension
- Mysql PHP Extension

## Installation
clone this project and run this on console/terminal
```
composer install

cp .env.example .env
(or copy file .env.example to .env in file manager)

php artisan key:generate
```

## Environment Configuration

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={your database}
DB_USERNAME={username for access database}
DB_PASSWORD={password for access database}
```

## Migration
after update enviroment, migrate the database for authentication
`php artisan migrate`

## Run application
```
php artisan serve

or

php -S localhost:8080 -t public
```
running on `localhost:8080`