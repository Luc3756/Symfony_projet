<?php

namespace App\DataFixtures;

use App\Entity\OrderItem;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $order1 = $this->getReference('order_1'); 
        $order2 = $this->getReference('order_2'); 
        $product1 = $this->getReference('product_1'); 
        $product2 = $this->getReference('product_2'); 
        $product3 = $this->getReference('product_3'); 

        $orderItemsData = [
            [
                'order' => $order1,
                'product' => $product1,
                'quantity' => 1, 
                'unitPrice' => $product1->getPrice(), 
            ],
            [
                'order' => $order2,
                'product' => $product3,
                'quantity' => 1,
                'unitPrice' => $product3->getPrice(), 
            ],
        ];

        foreach ($orderItemsData as $data) {
            $orderItem = new OrderItem();
            $orderItem->setOrder1($data['order']); 
            $orderItem->setProduct($data['product']);
            $orderItem->setQuantity($data['quantity']);
            $orderItem->setProductPrice($data['unitPrice']); 

            $manager->persist($orderItem);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class,  
            ProductFixtures::class, 
        ];
    }
}
