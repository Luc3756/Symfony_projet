<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $imageData = [
            ['url' => 'poule.jpg', 'product_ref' => 'product_1'],
            ['url' => 'tracteur_porsche.jpg', 'product_ref' => 'product_2'],
            ['url' => 'sac_blé.jpg', 'product_ref' => 'product_3'],
            ['url' => 'sac_maïs.jpg', 'product_ref' => 'product_4'],
            ['url' => 'couveuse_cimuka_60.jpg', 'product_ref' => 'product_5'],
            ['url' => 'chevre.jpg', 'product_ref' => 'product_6']
        ];

        foreach ($imageData as $data) {
            $image = new Image();
            $image->setUrl($data['url']); 

          
            $product = $this->getReference($data['product_ref']);
            if ($product) {
                $image->setProduct($product); 
            }

            $manager->persist($image);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class, 
        ];
    }
}
