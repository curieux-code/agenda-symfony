<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\Rubric;
use App\Entity\EventSearch;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
    * @return Event[] Returns an array of Event objects
    */


    public function findAllEventsByDate($date): array {
        $qb =  $this->createQueryBuilder('e')
                    ->where('e.dateStart = :date')
                    ->setParameter('date', $date)
                    ->orderBy('e.timeEnd', 'ASC')
                    ->orderBy('e.timeStart', 'ASC')
                    ->orderBy('e.dateStart', 'ASC')
                    ->orderBy('e.dateEnd', 'ASC')
                    ->getQuery();
        return $qb->execute();
    }

    public function findAllEventsByDate2($date): array {
        $sql = 'SELECT * FROM event, rubric WHERE date_start = :date';
        $params = array(
            'date' => '$date',ee
        );
        return $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();
    }

    public function findAllEventsByRubric($rubric): array {
        $sql = 'SELECT * FROM event e, rubric r WHERE e.rubric_id = r.id AND r.slug = :rubric';
        $params = array(
            'rubric' => '$rubric',
        );
        return $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();
    }

    public function findAllEventsByRubricMarchePas($rubric): array
    {
        $qb =  $this->createQueryBuilder('e')
                    ->andWhere('e.rubric = :rubric')
                    ->setParameter('rubric', $rubric)
                    ->getQuery();
        return $qb->execute();
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(EventSearch $search)
    {

        $query =  $this->findAll();

        if ($search->getMaxPrice()){
            $query = $this->createQueryBuilder('e')
            ->andWhere('e.price <= :maxprice')
            ->setParameter('maxprice', $search->getMaxPrice())
            ->getQuery()
            ->getResult()
            ;
        }
/*
        if ($search->getSearchDate()){
            $query = $this->createQueryBuilder('e')
            ->andWhere('e.date_start = "2019-05-07" ')
            ->getQuery()
            ->getResult()
            ;
        }

        if ($search->getSearchRubric()){
            $query = $this->createQueryBuilder('e')
            ->andWhere('e.rubric.slug = :searchRubric')
            ->setParameter('searchRubric', $search->getSearchRubric())
            ->getQuery()
            ->getResult()
            ;
        }
        */



        return $query;


        /*
        
        $query =  $this->findAll();

        if ($search->getMaxPrice()){
            $query = $query
                ->where('e.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }
        return $query->getQuery();
        */

    }


  /* 
    public function findByDate($value): array
    {
        return $this->createQueryBuilder('p')
                    ->andWhere('p.price = :val')
                    ->setParameter('val', $value)
                    ->orderBy('p.id', 'ASC')
                    ->setMaxResults(10)
                    ->getQuery()
                    ->getResult()
                    ;
    }

  
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
