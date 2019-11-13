<?php

namespace App\Repository;

use App\Entity\Voters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Voters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voters[]    findAll()
 * @method Voters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VotersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voters::class);
    }

    // /**
    //  * @return Voters[] Returns an array of Voters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voters
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
