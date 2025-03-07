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
        $order3 = $this->getReference('order_3');
        $order4 = $this->getReference('order_4');
        $order5 = $this->getReference('order_5');
        $order6 = $this->getReference('order_6');
        $order7 = $this->getReference('order_7');
        $order8 = $this->getReference('order_8');

        $product1 = $this->getReference('product_1'); 
        $product2 = $this->getReference('product_2'); 
        $product3 = $this->getReference('product_3');
        $product4 = $this->getReference('product_4'); 
        $product5 = $this->getReference('product_5');
        $product6 = $this->getReference('product_6');

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
            [
                'order' => $order3,
                'product' => $product2,
                'quantity' => 1, 
                'unitPrice' => $product2->getPrice(), 
            ],

            [
                'order' => $order4,
                'product' => $product1,
                'quantity' => 1, 
                'unitPrice' => $product1->getPrice(), 
            ],
            [
                'order' => $order5,
                'product' => $product4,
                'quantity' => 1,
                'unitPrice' => $product4->getPrice(), 
            ],
            [
                'order' => $order6,
                'product' => $product5,
                'quantity' => 1,
                'unitPrice' => $product5->getPrice(),
            ],
            [
                'order' => $order7,
                'product' => $product6,
                'quantity' => 1,
                'unitPrice' => $product6->getPrice(),
            ],
            [
                'order' => $order8,
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
