<?php

namespace Yc\CineHallBackend\controllers;

use Cloudinary\Api\ApiUtils;
use Cloudinary\Configuration\CloudConfig;
use sixon\hwFramework\Controller;
use sixon\hwFramework\Request;
use sixon\hwFramework\Response;

class CloudinaryController extends Controller
{
    public function __construct()
    {
        $response = new Response();
        $response->setContentType(Response::TYPE_JSON);
    }

    public function getCloudinarySignature(Request $request, Response $response)
    {

        $cloudinaryConfig = new CloudConfig([
            "cloud_name" => $_ENV['CLOUD_NAME'],
            "api_key" => $_ENV['API_KEY'],
            "api_secret" => $_ENV['API_SK']
        ]);

        $timestamp = time();
        $params =
            [
                "timestamp" => $timestamp,
                "folder" => 'CineHall'
            ];

        $data = ['signature' => ApiUtils::signParameters($params, $cloudinaryConfig->apiSecret), 'timestamp' => $timestamp];
        return json_encode($data);
    }
}