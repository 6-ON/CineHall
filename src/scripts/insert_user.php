<?php

use sixon\hwFramework\Application;
use Yc\CineHallBackend\models\User;

$ROOT_DIR = dirname(__DIR__, 2);

require_once $ROOT_DIR . '/vendor/autoload.php';

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
$app = new Application($ROOT_DIR, $config);


$user = new User();

$user->loadData([
    'firstName' => 'test',
    'lastName' => 'test',
    'email' => 'test@mail.com',
    'token' => 'jglgjlhhljhljhljh',
    'image' => 'url'
]);

if ($user->validate() && $user->save()) {
    echo 'user inserted';
} else {
    echo '<pre>';
    var_dump($user->errors);
    echo '</pre>';
    exit;
}
echo PHP_EOL . 'done.';
