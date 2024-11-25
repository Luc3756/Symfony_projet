<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\User; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Enum\Order1;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = $this->getReference('user1'); 
        $user2 = $this->getReference('user2'); 
        $user3 = $this->getReference('user3'); 

        $ordersData = [
            [
                'reference' => 'ORD001',
                'createAT' => '2024-10-01',
                'status' => Order1::preparation,
                'user' => $user1, 
                'reference_key' => 'order_1',
            ],
            [
                'reference' => 'ORD002',
                'createAT' => '2024-10-05',
                'status' => Order1::expediee,
                'user' => $user2, 
                'reference_key' => 'order_2', 
            ],
            [
                'reference' => 'ORD003',
                'createAT' => '2024-09-20',
                'status' => Order1::expediee,
                'user' => $user3,
                'reference_key' => 'order_3', 
            ],
            [
                'reference' => 'ORD004',
                'createAT' => '2024-10-10',
                'status' => Order1::expediee,
                'user' => $user1,
                'reference_key' => 'order_4',
            ],
            [
                'reference' => 'ORD005',
                'createAT' => '2024-10-12',
                'status' => Order1::preparation,
                'user' => $user2,
                'reference_key' => 'order_5',
            ],
            [
                'reference' => 'ORD006',
                'createAT' => '2024-10-15',
                'status' => Order1::expediee,
                'user' => $user3,
                'reference_key' => 'order_6',
            ],
            [
                'reference' => 'ORD007',
                'createAT' => '2024-10-18',
                'status' => Order1::expediee,
                'user' => $user1,
                'reference_key' => 'order_7',
            ],
            [
                'reference' => 'ORD008',
                'createAT' => '2024-10-20',
                'status' => Order1::preparation,
                'user' => $user2,
                'reference_key' => 'order_8',
            ],
        ];

        foreach ($ordersData as $data) {
            $order = new Order();
            $order->setReference($data['reference']);
            $order->setCreateAT($data['createAT']);
            $order->setStatus($data['status']);
            $order->setUser($data['user']);

            $this->addReference($data['reference_key'], $order);

            $manager->persist($order);
        }

        $manager->flush();
    }
}
