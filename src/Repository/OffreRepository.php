<?php
namespace App\Repository;

use App\Entity\OffreResto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreResto::class);
    }

    public function searchByPlatNameAndPercentage($query)
    {
        return $this->createQueryBuilder('o')
            ->join('o.idPlat', 'p')
            ->andWhere('p.nom LIKE :query OR o.pourcentage = :percentage')
            ->setParameter('query', '%' . $query . '%')
            ->setParameter('percentage', (int) $query)
            ->getQuery()
            ->getResult();
    }

}
