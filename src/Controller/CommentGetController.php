<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CommentGetController extends AbstractController
{
    #[Route('comments/commune/user', name: 'get_comments_by_commune_and_user')]
    public function getByCommuneAndUserId(Request $request, CommentRepository $commentRepo, SerializerInterface $serializer): Response
    {
        $commune_id = (int) $request->query->get('commune');
        $user_id = (int) $request->query->get('user');
        $comments = $commentRepo->findByCommuneAndUserId($commune_id, $user_id);
        $jsonContent = $serializer->serialize($this->getCommentsDto($comments), 'json');
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /*
    #[Route('comments/commune', name: 'get_comments_by_commune')]
    public function getByCommuneId(Request $request, CommentRepository $commentRepo): Response
    {
        $commune_id = (int) $request->query->get('commune');
        $comments = $commentRepo->findByCommuneId($commune_id);
        $response = new Response(json_encode($comments));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
*/
    #[Route('comments/commune', name: 'get_comments_by_commune')]
    public function getByCommuneId(Request $request, CommentRepository $commentRepo, SerializerInterface $serializer): Response
    {
        $commune_id = (int)$request->query->get('commune');
        $comments = $commentRepo->findByCommuneId($commune_id);
        /*
        //dump($comments);
        $commentsToReturn = [];
        foreach ($comments as $comment) {
            $commentsToReturn[] = [
                'id' => $comment->getId(),
                'content' => $comment->getContent(),
                'created_at' => $comment->getCreatedAt(),
                'user' => [
                    'id' => $comment->getUser()->getId()
                ]
            ];
        }

        */
        //dump($commentsToReturn);

        $jsonContent = $serializer->serialize($this->getCommentsDto($comments), 'json');

        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    #[Route('comments/user', name: 'get_comments_by_user')]
    public function getByUserId(Request $request, CommentRepository $commentRepo, SerializerInterface $serializer): Response
    {
        $user_id = (int) $request->query->get('user');
        $comments = $commentRepo->findByUserId($user_id);
        $jsonContent = $serializer->serialize($this->getCommentsDto($comments), 'json');
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    #[Route('user/user', name: 'get_comments_by_user')]
    public function getUserCommentInfos(Request $request, UserRepository $userRepo): Response
    {
        $user_id = (int) $request->query->get('user');
        $user = $userRepo->find($user_id);
        $userToReturn = [
            'id' => $user->getId(),
            'pseudo' => $user->getPseudo()
        ];
        $response = new Response(json_encode($userToReturn));
        return $response;
    }

    function getCommentsDto($comments): array
    {
        $commentsToReturn = [];
        foreach ($comments as $comment) {
            $commentsToReturn[] = [
                'id' => $comment->getId(),
                'content' => $comment->getContent(),
                'created_at' => $comment->getCreatedAt(),
                'score' => $comment->getScore(),
                'user' => [
                    'id' => $comment->getUser()->getId()
                ]
            ];
        }
        return $commentsToReturn;
    }
    
}
