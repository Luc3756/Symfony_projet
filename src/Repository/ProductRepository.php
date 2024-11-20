<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getTotalProductsByCategory()
    {
        return $this->createQueryBuilder('p')
            ->select('c.name AS categoryName', 'COUNT(p.id) AS productCount')  
            ->join('p.category', 'c')  
            ->groupBy('c.id') 
            ->getQuery()
            ->getResult();  
    }
}
