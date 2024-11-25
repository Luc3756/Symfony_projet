<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Enum\Order1;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }
    
    public function getSalesByMonth()
    {
        $date = new \DateTime('-12 months');
    
        return $this->createQueryBuilder('o')
            ->select('YEAR(o.createAT) AS year, MONTH(o.createAT) AS month, SUM(oi.productPrice * oi.quantity) AS totalSales')
            ->join('o.orderitem', 'oi')
            ->where('o.createAT >= :date')
            ->andWhere('o.status != :cancelledStatus')  
            ->groupBy('year, month')
            ->setParameter('date', $date)
            ->setParameter('cancelledStatus', Order1::annule) 
            ->getQuery()
            ->getResult();
    }
}
