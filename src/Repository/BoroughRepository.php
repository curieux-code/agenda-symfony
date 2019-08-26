<?php

namespace App\Repository;

use App\Entity\Borough;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Borough|null find($id, $lockMode = null, $lockVersion = null)
 * @method Borough|null findOneBy(array $criteria, array $orderBy = null)
 * @method Borough[]    findAll()
 * @method Borough[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoroughRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Borough::class);
    }

    // /**
    //  * @return Borough[] Returns an array of Borough objects
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
    public function findOneBySomeField($value): ?Borough
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
