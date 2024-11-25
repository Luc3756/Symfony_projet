<?php

namespace App\Repository;

use App\Entity\Product;
use App\Enum\Status;
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

    public function getProductStatusPercentages()
    {

        $totalProducts = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        if ($totalProducts == 0) {
            return [
                Status::dispo->toString() => 0,
                Status::rupture->toString() => 0,
                Status::precommande->toString() => 0,
            ];
        }

        $statusCounts = $this->createQueryBuilder('p')
            ->select('p.status, COUNT(p.id) AS count')
            ->groupBy('p.status')
            ->getQuery()
            ->getResult();

        $percentages = [
            Status::dispo->toString() => 0,
            Status::rupture->toString() => 0,
            Status::precommande->toString() => 0,
        ];

        foreach ($statusCounts as $statusCount) {
            $status = $statusCount['status']->toString(); 
            $count = $statusCount['count'];
            $percentages[$status] = ($count / $totalProducts) * 100;
        }

        return $percentages;
    }
}
