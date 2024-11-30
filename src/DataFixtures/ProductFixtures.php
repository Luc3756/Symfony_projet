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
            [
                'name' => 'Lapin nain',
                'price' => '35.00',
                'description' => 'Lapin nain sociable et facile à élever, idéal pour les familles.',
                'stock' => 25,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_8', 
            ],
            [
                'name' => 'Semoir à main manuel',
                'price' => '150.00',
                'description' => 'Semoir manuel ergonomique pour les petites exploitations.',
                'stock' => 10,
                'status' => Status::dispo,
                'category_reference' => 'category2', 
                'reference_key' => 'product_9', 
            ],
            [
                'name' => 'Sac de foin 20kg',
                'price' => '9.50',
                'description' => 'Foin de qualité pour nourrir vos animaux, produit localement.',
                'stock' => 500,
                'status' => Status::dispo,
                'category_reference' => 'category3', 
                'reference_key' => 'product_10', 
            ],
            [
                'name' => 'Abreuvoir automatique 10L',
                'price' => '25.00',
                'description' => 'Abreuvoir automatique pratique pour vos poules et petits animaux.',
                'stock' => 120,
                'status' => Status::dispo,
                'category_reference' => 'category4', 
                'reference_key' => 'product_11', 
            ],
            [
                'name' => 'Vache normande',
                'price' => '1800.00',
                'description' => 'Vache normande laitière de qualité supérieure.',
                'stock' => 2,
                'status' => Status::precommande,
                'category_reference' => 'category1', 
                'reference_key' => 'product_12', 
            ],
            [
                'name' => 'Fertiliseur bio 25kg',
                'price' => '30.00',
                'description' => 'Fertiliseur biologique, idéal pour vos cultures écologiques.',
                'stock' => 300,
                'status' => Status::dispo,
                'category_reference' => 'category2', 
                'reference_key' => 'product_15', 
            ],
            [
                'name' => 'Filet à moutons électrique 50m',
                'price' => '125.00',
                'description' => 'Filet électrifié pour contenir vos moutons et chèvres.',
                'stock' => 40,
                'status' => Status::dispo,
                'category_reference' => 'category4', 
                'reference_key' => 'product_16', 
            ],
            [
                'name' => 'Aliment caprin 25kg',
                'price' => '16.50',
                'description' => 'Sac de 25kg de granulés pour caprins, riche en nutriments.',
                'stock' => 150,
                'status' => Status::precommande,
                'category_reference' => 'category3', 
                'reference_key' => 'product_17', 
            ],
            [
                'name' => 'Poules Araucana',
                'price' => '25.00',
                'description' => 'Poule Araucana célèbre pour ses œufs bleu-vert uniques.',
                'stock' => 30,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_18', 
            ],
            [
                'name' => 'Oie cendrée',
                'price' => '45.00',
                'description' => 'Oie cendrée rustique, parfaite pour l’élevage et l’entretien des espaces.',
                'stock' => 20,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_19', 
            ],
            [
                'name' => 'Canard colvert',
                'price' => '30.00',
                'description' => 'Le Canard colvert, col-vert, ou Canard malard au Canada, est une espèce d’oiseaux de l’ordre des Ansériformes, de la famille des Anatidés et de la sous-famille des Anatinés.',
                'stock' => 40,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_20', 
            ],
            [
                'name' => 'Perdrix rouge',
                'price' => '35.00',
                'description' => 'La Perdrix rouge est une espèce d’oiseaux de la famille des phasianidés.',
                'stock' => 50,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_21', 
            ],
            [
                'name' => 'Faisan Mâle',
                'price' => '70.00',
                'description' => 'Le faisan est le nom vernaculaire de nombreuses espèces d’oiseaux de la sous-famille des Phasianinae même si en Europe, il désigne en premier lieu le Faisan de Colchide Phasianus colchicus',
                'stock' => 15,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_22', 
            ],
            [
                'name' => 'Dindon',
                'price' => '65.00',
                'description' => 'Dindon parfait pour un repas de Noël ou Pâques.',
                'stock' => 25,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_23', 
            ],
            [
                'name' => 'Oeuf plaque de 30',
                'price' => '12',
                'description' => 'Oeuf de la ferme de Luc Bio.',
                'stock' => 80,
                'status' => Status::dispo,
                'category_reference' => 'category1', 
                'reference_key' => 'product_24', 
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
