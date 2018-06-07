<?php

namespace App\Repository;

use App\Entity\Ocr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class OcrRepository
 * @package App\Repository
 *
 * @method Ocr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ocr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ocr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OcrRepository extends ServiceEntityRepository
{
    /**
     * OcrRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ocr::class);
    }

    /**
     * @return Ocr[]|array
     */
    public function findAll(): ?array
    {
        return $this->findBy([], ['createdAt' => 'DESC']);
    }
}
