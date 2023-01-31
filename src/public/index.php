<?php
$ROOT_DIR = dirname(__DIR__, 2);
require_once $ROOT_DIR .'/vendor/autoload.php';
use sixon\hwFramework\Application;
use Yc\CineHallBackend\controllers\ApiController;


$dotenv = Dotenv\Dotenv::createImmutable($ROOT_DIR);
$dotenv->load();
$config = [
    'userClass' => Yc\CineHallBackend\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'usr' => $_ENV['DB_USR'],
        'psd' => $_ENV['DB_PSD'],

    ]
];
$app = new Application($ROOT_DIR,$config);


$app->router->put('/users/create',[ApiController::class,'test']);







$app->run();