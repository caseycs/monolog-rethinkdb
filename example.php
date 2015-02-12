<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$connection = r\connect('localhost');
$connection->useDb('test');

// create a log channel
$log = new Logger('channel');
$log->pushHandler(new StreamHandler('php://stdout', Logger::INFO));
$log->pushHandler(new MonologRethinkDBHandler\Handler(Logger::INFO, true, $connection, 'log'));

$faker = Faker\Factory::create('en_US');

$levels = [Logger::INFO,Logger::WARNING,Logger::ERROR,Logger::ERROR];
$tags = $faker->words(20);

for ($i = 0; $i <= 5; $i ++) {
    $level = $faker->randomElement($levels);
    $log->addRecord($level, $faker->sentence(), ['tag1' => $faker->randomElement($tags), 'tag2' => $faker->randomElement($tags)]);
}
