<?php

namespace App\Repository;

use App\Entity\Videostore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Videostore|null find($id, $lockMode = null, $lockVersion = null)
 * @method Videostore|null findOneBy(array $criteria, array $orderBy = null)
 * @method Videostore[]    findAll()
 * @method Videostore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideostoreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Videostore::class);
    }

    // /**
    //  * @return Videostore[] Returns an array of Videostore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Videostore
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
