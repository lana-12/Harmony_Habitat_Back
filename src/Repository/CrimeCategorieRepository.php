<?php

namespace App\Repository;

use App\Entity\CrimeCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CrimeCategorie>
 *
 * @method CrimeCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrimeCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrimeCategorie[]    findAll()
 * @method CrimeCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrimeCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrimeCategorie::class);
    }

//    /**
//     * @return CrimeCategorie[] Returns an array of CrimeCategorie objects
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

//    public function findOneBySomeField($value): ?CrimeCategorie
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
