<?php

namespace App\Repository;

use App\Entity\Ticketing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ticketing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticketing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticketing[]    findAll()
 * @method Ticketing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ticketing::class);
    }

    // /**
    //  * @return Ticketing[] Returns an array of Ticketing objects
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
    public function findOneBySomeField($value): ?Ticketing
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
