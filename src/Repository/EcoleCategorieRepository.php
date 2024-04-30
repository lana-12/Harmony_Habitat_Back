<?php

namespace App\Repository;

use App\Entity\EcoleCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EcoleCategorie>
 *
 * @method EcoleCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcoleCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcoleCategorie[]    findAll()
 * @method EcoleCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcoleCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EcoleCategorie::class);
    }

//    /**
//     * @return EcoleCategorie[] Returns an array of EcoleCategorie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EcoleCategorie
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
