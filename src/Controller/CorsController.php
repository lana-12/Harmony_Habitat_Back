<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CorsController extends AbstractController
{
    #[Route('/api/users', name: 'app_api_cors', methods: ["OPTIONS", "POST"])]
    public function handleOptionsRequest(): Response
    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');

        // if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
        //     http_response_code(200);
        //     exit();
        // }


        // if (isset($_SERVER['HTTP_ORIGIN'])) {
        //     // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        //     // you want to allow, and if so:
        //     $response->headers->set("Access-Control-Allow-Origin", $_SERVER['HTTP_ORIGIN']);
        //     $response->headers->set('Access-Control-Allow-Credentials',  true);
        //     $response->headers->set('Access-Control-Max-Age', 86400); // cache for 1 day
        // }

        // if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        //     // Access-Control headers are received during OPTIONS requests
        //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        //         $response->headers->set("Access-Control-Allow-Methods", ['GET', 'POST', 'OPTIONS', 'PUT', 'PATCH', 'DELETE']);
        //     }

        //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        //         $response->headers->set("Access-Control-Allow-Headers",  $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);
        //     }
        //     $response->headers->set('Content-Length', 0);
        //     exit();
        // }

        return $response;
    }
}
