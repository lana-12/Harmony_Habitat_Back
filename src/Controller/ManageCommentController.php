<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Comment;
use App\Services\Validate;
use App\Repository\UserRepository;
use App\Repository\CommuneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Types\DateImmutableType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageCommentController extends AbstractController
{

    public function __construct(

        private EntityManagerInterface $em,
        private UserRepository $userRepo,
        private CommuneRepository $communeRepo,

    )
    {}

    #[Route('/manage/comment/create', name: 'app_manage_comment_create')]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        
        // $user = $userRepo->find(1236988); // user qui n'existe pas
        // $commune = $this->communeRepo->find(00000000000000000); // commune qui n'existe pas
        $user = $this->userRepo->find($data['id_utilisateur']);
        $commune = $this->communeRepo->find($data['id_commune']);


        // Remplacer par le services/Validate
        if($data['texte_commentaire'] === ""){  // test ok
            return $this->json([
                'message' => 'Champs obligatoire ',
            ]);
        }

        // Check if user & commune exists
        if($user && $commune){

            // Remove the spaces $content
            // Validate => src/Services/Validate.php
            $content = Validate::trimField($data['texte_commentaire']);

            //Create comment
            $comment = new Comment();

            $comment->setContent($content);
            $comment->setScore($data['note_commentaire']);
            $comment->setCommune($commune);
            $comment->setUser($user);
            
            $now = new DateTimeImmutable();
            $comment->setCreatedAt($now);

            // Save & send BDD
            $this->em->persist($comment);
            $this->em->flush();

            return $this->json([
                'message' => 'Commentaire créé avec succès',
                'data' => $data,
                'content'=> $content
            ]);
        }

        return $this->json([
            'message' => 'Utilisateur et/ou Commune non reconnu',
        ]);
    }

}
