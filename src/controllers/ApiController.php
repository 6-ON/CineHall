<?php

namespace Yc\CineHallBackend\controllers;

use sixon\hwFramework\Application;
use sixon\hwFramework\Controller;
use sixon\hwFramework\Request;
use sixon\hwFramework\Response;
use Yc\CineHallBackend\models\Reservation;

class ApiController extends Controller
{
    public function __construct()
    {
        $response = new Response();
        $response->setContentType(Response::TYPE_JSON);
    }



    public function register(Request $request, Response $response)
    {

    }

    public function login(Request $request, Response $response)
    {

    }

    public function logout(Request $request, Response $response)
    {

    }

    public function makeJsonMessage($type, $content): bool|string
    {
        return json_encode(['type' => $type, 'content' => $content]);
    }
}