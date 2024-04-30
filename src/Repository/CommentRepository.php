<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }


    // public function sendDataUser($datas): array 
    // {
    //     return $this->createQueryBuilder('u')
    //                 ->andWhere
    // }

//    /**
//     * @return Comment[] Returns an array of Comment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Comment
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    public function findByCommuneAndUserId($commune_id, $user_id): ?array
    {
        return $this->createQueryBuilder('c')
            ->join('c.user', 'u')
            ->join('c.commune', 'co')
            ->andWhere('u.id = :user_id')
            ->andWhere('co.id = :commune_id')
            ->setParameter('user_id', $user_id)
            ->setParameter('commune_id', $commune_id)
            ->getQuery()
            ->getResult();
    }

    public function findByUserId($user_id): ?array
    {
        return $this->createQueryBuilder('c')
            ->join('c.user', 'u')
            ->andWhere('u.id = :user_id')
            ->setParameter('user_id', $user_id)
            ->getQuery()
            ->getResult();
    }

    public function findByCommuneId($commune_id): ?array
    {
        //dump($commune_id);
        return $this->createQueryBuilder('c')
        ->join('c.commune', 'co')
        ->andWhere('co.id = :commune_id')
        ->setParameter('commune_id', $commune_id)
        ->getQuery()
        ->getResult();
    }
}
