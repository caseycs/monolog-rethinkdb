# monolog-rethinkdb
RethinkDB handler for Monolog

## Installation

Execute:

```bash
$ composer require caseycs/monolog-rethinkdb
```

Add this lines to your composer.json:

```json
{
    "require": {
        "caseycs/monolog-rethinkdb": "0.1"
    }
}
```

And then execute:

```bash
$ php composer.phar install
```

## Usage

```php
<?php
$connection = r\connect('localhost');
$connection->useDb('test');

$table = 'log';
new MonologRethinkDBHandler\Handler(Logger::INFO, true, $connection, $table);

$log = new Logger('channel');
$log->pushHandler($handler);
```

## Copyright

Copyright (C) 2015 Ilia kondrashov, released under the MIT License.
