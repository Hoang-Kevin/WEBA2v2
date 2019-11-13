<?php

namespace App\Repository;

use App\Entity\Commenters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Commenters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commenters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commenters[]    findAll()
 * @method Commenters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commenters::class);
    }

    // /**
    //  * @return Commenters[] Returns an array of Commenters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commenters
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
