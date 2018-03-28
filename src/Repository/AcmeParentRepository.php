<?php

namespace App\Repository;

use App\Entity\AcmeParent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AcmeParent|null find($id, $lockMode = null, $lockVersion = null)
 * @method AcmeParent|null findOneBy(array $criteria, array $orderBy = null)
 * @method AcmeParent[]    findAll()
 * @method AcmeParent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcmeParentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AcmeParent::class);
    }

//    /**
//     * @return AcmeParent[] Returns an array of AcmeParent objects
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
    public function findOneBySomeField($value): ?AcmeParent
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
