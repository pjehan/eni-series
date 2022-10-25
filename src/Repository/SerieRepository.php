<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function save(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllBetweenDates(\DateTime $start, \DateTime $end): array
    {
        // DQL
        /*
        $entityManager = $this->getEntityManager();
        $dql = "
            SELECT s
            FROM App\Entity\Serie s
            WHERE s.firstAirDate > '2019-01-01'
            AND s.firstAirDate < '2020-01-01'
        ";
        $query = $entityManager->createQuery($dql);

        return $query->getResult();
        */

        // Query Builder
        $qb = $this->createQueryBuilder('s');

        $qb->andWhere('s.firstAirDate >= :start')
            ->andWhere('s.firstAirDate <= :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end);

        return $qb->getQuery()->getResult();
    }

    public function findAllWithSeasons()
    {
        $qb = $this->createQueryBuilder('serie');

        $qb->addSelect('seasons')
            ->leftJoin('serie.seasons', 'seasons')
            ->orderBy('serie.firstAirDate', 'DESC')
            ->addOrderBy('serie.name', 'ASC');

        $query = $qb->getQuery();
        $query->setMaxResults(20);

        return new Paginator($query);
    }

//    /**
//     * @return Serie[] Returns an array of Serie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Serie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
