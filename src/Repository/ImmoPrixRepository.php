<?php

namespace App\Repository;

use App\Entity\ImmoPrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImmoPrix>
 *
 * @method ImmoPrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImmoPrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImmoPrix[]    findAll()
 * @method ImmoPrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmoPrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImmoPrix::class);
    }

//    /**
//     * @return ImmoPrix[] Returns an array of ImmoPrix objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImmoPrix
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
