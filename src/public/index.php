<?php
$ROOT_DIR = dirname(dirname(__DIR__));
require_once $ROOT_DIR .'/vendor/autoload.php';
use sixon\hwFramework\Application;


$dotenv = Dotenv\Dotenv::createImmutable($ROOT_DIR);
$dotenv->load();
$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'usr' => $_ENV['DB_USR'],
        'psd' => $_ENV['DB_PSD'],

    ]
];
$app = new Application($ROOT_DIR,$config);