<?php

namespace App\Repository;

use App\Entity\Plat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plat>
 *
 * @method Plat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plat[]    findAll()
 * @method Plat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plat::class);
    }
    public function searchByNameAndPrice($name, $price)
    {
        $queryBuilder = $this->createQueryBuilder('p');
    
        if (!empty($name)) {
            $queryBuilder->andWhere('p.nom LIKE :name')
                ->setParameter('name', '%' . $name . '%');
        }
    
        if (!is_null($price)) {
            $queryBuilder->andWhere('p.prix = :price')
                ->setParameter('price', $price);
        }
    
        return $queryBuilder->getQuery()->getResult();
    }
    
    
    
}
