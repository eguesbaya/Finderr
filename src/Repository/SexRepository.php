<?php

namespace App\Repository;

use App\Entity\Sex;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sex|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sex|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sex[]    findAll()
 * @method Sex[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SexRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sex::class);
    }

    // /**
    //  * @return Sex[] Returns an array of Sex objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sex
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
