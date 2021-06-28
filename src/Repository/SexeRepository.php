<?php

namespace App\Repository;

use App\Entity\Sexe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sexe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sexe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sexe[]    findAll()
 * @method Sexe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SexeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sexe::class);
    }

    // /**
    //  * @return Sexe[] Returns an array of Sexe objects
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
    public function findOneBySomeField($value): ?Sexe
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
