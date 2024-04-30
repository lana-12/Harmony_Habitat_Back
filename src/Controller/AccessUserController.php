<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccessUserController extends AbstractController
{
    #[Route('/access/user', name: 'app_access_user')]
    public function index(Request $request, UserRepository $userRepo, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'];
        $password = $data['password'];

        // Recherche de l'utilisateur par e-mail
        $user = $userRepo->findOneBy(['email' => $email]);

        
        if ($user && password_verify($password, $user->getPassword())) {
            $user->setIsConnected(true);
            $userToReturn = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'lastname' => $user->getLastname(),
                'firstname' => $user->getFirstname(),
                'pseudo' => $user->getPseudo()
        ];
            // Retourner une réponse JSON indiquant la connexion réussie
            return $this->json([
                'id' => $user->getId(),
                'user'=> $userToReturn,
                'isConnected' => $user->getIsConnected(),
                'message' => 'Connecté avec succès',
                // 'redirectUrl' => 'http://localhost:3000/home', // L'URL vers laquelle vous souhaitez rediriger dans React
            ]);
        }

        // Retourner une réponse JSON indiquant l'échec de la connexion
        return $this->json([
            'email' => $email,
            'isConnected' => false,
            'message' => 'Identifiants invalides',
        ]);
    }
}
