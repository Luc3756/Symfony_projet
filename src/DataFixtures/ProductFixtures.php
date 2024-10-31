<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enum\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'name' => 'Poule pondeuse',
                'price' => '14.50',
                'description' => 'Poule pondeuse productive',
                'stock' => 150,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_1', 
            ],
            [
                'name' => 'Tracteur Porsche',
                'price' => '33000.00',
                'description' => 'Tracteur agricole robuste et fiable de la série Porsche',
                'stock' => 5,
                'status' => Status::precommande,
                'category_reference' => 'category2', 
                'reference_key' => 'product_2',
            ],
            [
                'name' => 'Aliment pour poules 25kg Blé',
                'price' => '11.90',
                'description' => 'Sac de 25kg d’aliment poules pondeuses, blé produit localement.',
                'stock' => 300,
                'status' => Status::precommande,
                'category_reference' => 'category3',
                'reference_key' => 'product_3', 
            ],
            [
                'name' => 'Aliment pour poules 25kg Maïs',
                'price' => '14.50',
                'description' => 'Sac de 25kg d’aliment poules pondeuses, blé produit localement.',
                'stock' => 300,
                'status' => Status::precommande,
                'category_reference' => 'category3',
                'reference_key' => 'product_4', 
            ],
            [
                'name' => 'Couveuse automatique 60 oeufs Cimuka CT60SH',
                'price' => '599.00',
                'description' => 'Cette couveuse Cimuka est entièrement automatisée.',
                'stock' => 20,
                'status' => Status::precommande,
                'category_reference' => 'category4', 
                'reference_key' => 'product_5',
            ],
            [
                'name' => 'Chèvre alpine',
                'price' => '150.00',
                'description' => 'Chèvre alpine pure race',
                'stock' => 0,
                'status' => Status::rupture,
                'category_reference' => 'category1', 
                'reference_key' => 'product_6', 
            ],
            [
                'name' => 'Clôture électrique',
                'price' => '79.99',
                'description' => 'Kit complet de clôture électrique pour garder vos animaux en sécurité.',
                'stock' => 50,
                'status' => Status::dispo,
                'category_reference' => 'category4', 
                'reference_key' => 'product_7', 
            ],
        ];

        foreach ($products as $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $product->setDescription($data['description']);
            $product->setStock($data['stock']);
            $product->setStatus($data['status']);

            $categoryReference = $this->getReference($data['category_reference']);
            $product->setCategory($categoryReference);

            $this->addReference($data['reference_key'], $product);

            $manager->persist($product);
        }

        $manager->flush(); 
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
