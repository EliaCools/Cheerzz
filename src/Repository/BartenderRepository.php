<?php

namespace App\Repository;

use App\Entity\Bartender;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bartender|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bartender|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bartender[]    findAll()
 * @method Bartender[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BartenderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bartender::class);
    }

    // /**
    //  * @return Bartender[] Returns an array of Bartender objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bartender
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
