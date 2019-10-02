<?php

namespace App\Repository;

use App\Entity\Placekind;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Placekind|null find($id, $lockMode = null, $lockVersion = null)
 * @method Placekind|null findOneBy(array $criteria, array $orderBy = null)
 * @method Placekind[]    findAll()
 * @method Placekind[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlacekindRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Placekind::class);
    }

    // /**
    //  * @return Placekind[] Returns an array of Placekind objects
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
    public function findOneBySomeField($value): ?Placekind
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
