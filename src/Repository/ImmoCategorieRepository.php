<?php

namespace App\Repository;

use App\Entity\ImmoCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImmoCategorie>
 *
 * @method ImmoCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImmoCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImmoCategorie[]    findAll()
 * @method ImmoCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmoCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImmoCategorie::class);
    }

//    /**
//     * @return ImmoCategorie[] Returns an array of ImmoCategorie objects
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

//    public function findOneBySomeField($value): ?ImmoCategorie
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
