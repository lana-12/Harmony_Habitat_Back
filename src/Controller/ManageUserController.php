<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//
//
// 

/**
 * TODO 
 *   => Voir method createUser
 *   => Create method for
 *      -> updateUser
 *      -> deleteuser
 *   => For add Favorite peut-être un contoller FavoriteController pour gérer le crud
 * 
 */


class ManageUserController extends AbstractController
{
    #[Route('/manageUser', name: 'app_user')]
    public function createUser(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
    ): Response
    {


//TODO 
    // => Vérification des champ du formulaire + gérer error si email + pseudo pris

        $data = json_decode($request->getContent(), true);

        

        $user = new User();
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setEmail($data['email']);
        $user->setPseudo($data['firstname']);
        $user->setRoles(["ROLE_USER"]);

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password']
        );
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'user'=> $user
        ]);
    }



}
