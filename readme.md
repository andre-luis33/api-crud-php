# CRUD API using PHP + SQLITE

## Features

- Database manipulation using `PDO`
- REST API concepts respected and honored
- Create, Read, Update and Delete your favorite (or not 😶) cars
- No need to have a complex database installed, since we use `SQLite`

## Prerequisites/Requirements

- pdo_sqlite
- sqlite3
- composer

## Instalation

First of all, you gotta install the required dependency, to handle the API Endpoints

```
composer install
```

Now that you have installed the required dependency, you have to run the script that will create the `db.sqlite3` file, and the `cars` table into it, and also insert two new cars to start.

```
php src/database/table-script.php
```

After theese two steps, you're able to start using the API. To start up the server, run the following command:

```
php -S localhost:8080
```

You should be seeing a welcome message by entering this url, and that's about it, enjoy =)
