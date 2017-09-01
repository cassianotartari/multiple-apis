<?php

require_once __DIR__ . '/../vendor/autoload.php';

define("ROOT_PATH", __DIR__ . "/..");

$app = new Silex\Application();

$app['debug'] = true;
$app['log.level'] = Monolog\Logger::DEBUG;

$app['db.options'] = array(
    'driver'    => 'pdo_pgsql',
    'dbname'    => 'postgres',
    'user'      => 'postgres',   
    'password'  => 'postgres',
    'host'      => 'destination-db',
    'port'      => '5432'
);

require __DIR__ . '/../src/app.php';

$app->run();