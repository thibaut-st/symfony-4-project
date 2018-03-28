<?php

namespace App\Repository;

use App\Entity\Acme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Acme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acme[]    findAll()
 * @method Acme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcmeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Acme::class);
    }

//    /**
//     * @return Acme[] Returns an array of Acme objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acme
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
