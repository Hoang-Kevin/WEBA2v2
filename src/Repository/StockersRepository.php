<?php

namespace App\Repository;

use App\Entity\Stockers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stockers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stockers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stockers[]    findAll()
 * @method Stockers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stockers::class);
    }

    // /**
    //  * @return Stockers[] Returns an array of Stockers objects
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
    public function findOneBySomeField($value): ?Stockers
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
