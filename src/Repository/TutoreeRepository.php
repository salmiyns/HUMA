<?php

namespace App\Repository;

use App\Entity\Tutoree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tutoree|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tutoree|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tutoree[]    findAll()
 * @method Tutoree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutoreeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tutoree::class);
    }

    // /**
    //  * @return Tutoree[] Returns an array of Tutoree objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tutoree
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
