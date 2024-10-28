<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\User; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        
        $ordersData = [
            [
                'reference' => 'ORD001',
                'createAT' => '2023-10-01 14:00',
                'status' => Order::preparation,
                
            ],
            [
                'reference' => 'ORD002',
                'createAT' => '2023-10-05 11:30',
                'status' => Order::expediee,
                
            ],
            [
                'reference' => 'ORD003',
                'createAT' => '2023-10-07 09:00',
                'status' => Order::annule,
               
            ],
        ];

        foreach ($ordersData as $data) {
            $order = new Order();
            $order->setReference($data['reference']);
            $order->setCreateAT($data['createAT']);
            $order->setStatus($data['status']);
            $order->setUser($data['user']);

            $manager->persist($order);
        }

        $manager->flush();
    }
}
