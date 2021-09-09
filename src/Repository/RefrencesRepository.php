<?php

namespace App\Repository;

use App\Entity\Refrences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Refrences|null find($id, $lockMode = null, $lockVersion = null)
 * @method Refrences|null findOneBy(array $criteria, array $orderBy = null)
 * @method Refrences[]    findAll()
 * @method Refrences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefrencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Refrences::class);
    }

    // /**
    //  * @return Refrences[] Returns an array of Refrences objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Refrences
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
