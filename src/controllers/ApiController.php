<?php

namespace Yc\CineHallBackend\controllers;

use Firebase\JWT\Key;
use sixon\hwFramework\Application;
use sixon\hwFramework\Controller;
use sixon\hwFramework\Request;
use sixon\hwFramework\Response;
use Yc\CineHallBackend\models\Reservation;
use Yc\CineHallBackend\models\User;

use Firebase\JWT\JWT;

class ApiController extends Controller
{
    public function __construct()
    {
        $response = new Response();
        $response->setContentType(Response::TYPE_JSON);
    }

    public function reserve(Request $request, Response $response)
    {
        $reservation = new Reservation();

        try {
            if ($request->isPut()) {
                $reservation->loadData($request->getBody());
                if ($reservation->validate() && $reservation->save()) {
                    return $this->makeJsonMessage('success', 'Your Seat is reserved Successfully !');
                } else {
                    return $this->makeJsonMessage('error', 'The Seat did not reserved !');
                }
            }
        } catch (\Exception) {
            return $this->makeJsonMessage('error', 'There was an error while Reserving !');
        }
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();

        try {
            if ($request->isPut()) {
                $user->loadData($request->getBody());
                if ($user->validate() && $user->save()) {
                    return $this->makeJsonMessage('success', 'Your Seat is reserved Successfully !');
                } else {
                    return $this->makeJsonMessage('error', ['message' => 'The User did not created !', 'details' => $user->errors]);
                }
            }
        } catch (\Exception $e) {
            return $this->makeJsonMessage('error', ['message' => 'There was an error while creating the user', 'details' => $e->getMessage()]);
        }
    }

    public function login(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $secretKey = $_ENV['JWT_SECRET'];
            $issuedAt = new \DateTimeImmutable();
            $expire = $issuedAt->modify('+6 minutes')->getTimestamp();
            $serverName = $_ENV['JWT_DOMAIN'];
            $username = 1;
            $data = [
                'iat' => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
                'iss' => $serverName,                       // Issuer
                'nbf' => $issuedAt->getTimestamp(),         // Not before
                'id' => $username,                     // from Request
            ];
            return JWT::encode(
                $data,
                $secretKey,
                'HS512'
            );

        }
    }

    public function logout(Request $request, Response $response)
    {

    }

    public function getUserInfo(Request $request, Response $response)
    {

        try {
            if ($request->isGet()) {
                $auth = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

                if (!preg_match('/Bearer\s(\S+)/', $auth, $matches)) {
                    $response->setStatusCode(401);
                    return $this->makeJsonMessage('error', 'Token not Found !');
                }
                $auth_token = $matches[1];
                if (!$auth_token) {
                    $response->setStatusCode(401);
                    return $this->makeJsonMessage('error', 'Token is not valid !');
                }

                $token = JWT::decode($auth_token, new Key($_ENV['JWT_SECRET'], 'HS512'));
                $now = new \DateTimeImmutable();

                if ($token->iss !== $_ENV['JWT_DOMAIN'] ||
                    $token->nbf > $now->getTimestamp()) {
                    $response->setStatusCode(401);
                    return $this->makeJsonMessage('error', 'Unauthorized !');
                }

                $userId = $token->id;

                $user = User::findOne(['id'=>$userId]);

                return json_encode($user);


            }
        } catch (\Exception $e) {
            return $this->makeJsonMessage('error', ['details' => $e->getMessage()]);

        }
    }

    public function makeJsonMessage($type, $content): bool|string
    {
        return json_encode(['type' => $type, 'content' => $content]);
    }
}