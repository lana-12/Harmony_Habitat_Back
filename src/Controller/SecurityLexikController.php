<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityLexikController extends AbstractController
{

#[Route('lexik/test', name: 'login_test')]
    public function protectedRoute()
    {
    return $this->json(['message' => 'Cette route est protégée par Lexik JWT Authentication.']);
    }

}
?>