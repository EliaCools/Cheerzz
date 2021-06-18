<?php

namespace App\Repository;

use App\Entity\HomeBrew;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomeBrew|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeBrew|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeBrew[]    findAll()
 * @method HomeBrew[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeBrewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeBrew::class);
    }

    // /**
    //  * @return HomeBrew[] Returns an array of HomeBrew objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomeBrew
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
