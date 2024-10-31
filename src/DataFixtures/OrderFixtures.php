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
                'createAT' => '2023-10-01 14:00',
                'status' => Order1::preparation,
                'user' => $user1, 
                'reference_key' => 'order_1',
            ],
            [
                'reference' => 'ORD002',
                'createAT' => '2023-10-05 11:30',
                'status' => Order1::expediee,
                'user' => $user2, 
                'reference_key' => 'order_2', 
            ],
            [
                'reference' => 'ORD003',
                'createAT' => '2023-10-07 09:00',
                'status' => Order1::annule,
                'user' => $user3,
                'reference_key' => 'order_3', 
            ],
        ];

        foreach ($ordersData as $data) {
            $order = new Order();
            $order->setReference($data['reference']);
            $order->setCreateAT($data['createAT']);
            $order->setStatus($data['status']);
            $order->setUser($data['user']);

            // Ajouter la référence
            $this->addReference($data['reference_key'], $order);

            $manager->persist($order);
        }

        $manager->flush();
    }
}
