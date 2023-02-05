<?php
$ROOT_DIR = dirname(__DIR__, 2);
require_once $ROOT_DIR . '/vendor/autoload.php';

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
$app = new Application($ROOT_DIR, $config);

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT');

header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Auth-Token, Origin ");

$app->router->put('/users/create', [ApiController::class, 'register']);

$app->router->post('/users/login', [ApiController::class, 'login']);

$app->router->post('/users/logout', [ApiController::class, 'logout']);

$app->router->put('/seats/reserve', [ApiController::class, 'reserve']);

$app->router->delete('/seats/cancel', [ApiController::class, 'cancelReserve']);

$app->router->get('/seats/get', [ApiController::class, 'getSeats']);

$app->router->get('/users/get-info', [ApiController::class, 'getUserInfo']);

if($app->request->method() === 'options'){
    http_response_code(200);
    return;
}
$app->run();