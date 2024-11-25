<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class DashboardRepository extends EntityRepository
{
    public function getLastFiveOrders()
    {
        return $this->createQueryBuilder('o')
            ->select('o', 'u')  
            ->join('o.user', 'u')  
            ->orderBy('o.createAT', 'DESC') 
            ->setMaxResults(5)  
            ->getQuery()
            ->getResult();
    }

    public function getProductAvailabilityRatio()
    {

        return $this->createQueryBuilder('p')
            ->select('p.stock, COUNT(p.id) AS productCount')
            ->where('p.stock > 0') 
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }

    public function getSalesByMonth()
    {
        return $this->createQueryBuilder('oi')
            ->select('MONTH(o.createAT) AS month, SUM(oi.productPrice * oi.quantity) AS totalSales')
            ->join('oi.order1', 'o') 
            ->groupBy('month') 
            ->orderBy('month', 'DESC')  
            ->getQuery()
            ->getResult();
    }

    public function getProductsByCategory()
    {
        return $this->createQueryBuilder('p')
            ->select('p.category, COUNT(p.id) AS productCount')
            ->join('p.category', 'c') 
            ->groupBy('p.category')
            ->getQuery()
            ->getResult();
    }

    public function getTotalProductsByCategory()
    {
        return $this->createQueryBuilder('p')
            ->select('c.name AS categoryName, COUNT(p.id) AS totalProducts')  
            ->join('p.category', 'c')  
            ->groupBy('c.name')  
            ->getQuery()
            ->getResult();  
    }

}