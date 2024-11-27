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
                ['url' => 'chevre.jpg', 'product_ref' => 'product_6'],
                ['url' => 'cloture_electrique.jpg', 'product_ref' => 'product_7'],
                ['url' => 'lapin.jpg', 'product_ref' => 'product_8'],
                ['url' => 'semoir.jpg', 'product_ref' => 'product_9'],
                ['url' => 'sac_foin.jpg', 'product_ref' => 'product_10'],
                ['url' => 'abreuvoir_automatique.jpg', 'product_ref' => 'product_11'],
                ['url' => 'vache_normande.jpg', 'product_ref' => 'product_12'],
                ['url' => 'fertiliseur_bio.jpg', 'product_ref' => 'product_15'],
                ['url' => 'filet_mouton.jpg', 'product_ref' => 'product_16'],
                ['url' => 'aliment_caprin.jpg', 'product_ref' => 'product_17'],
                ['url' => 'poule_araucana.jpg', 'product_ref' => 'product_18'],
                ['url' => 'oie_cendree.jpg', 'product_ref' => 'product_19'],
                ['url' => 'canard_colvert.jpg', 'product_ref' => 'product_20'],
                ['url' => 'perdrix_rouge.jpg', 'product_ref' => 'product_21'],
                ['url' => 'faisan_male.jpg', 'product_ref' => 'product_22'],
                ['url' => 'dindon.jpg', 'product_ref' => 'product_23'],
                ['url' => 'oeuf_plaque_30.jpg', 'product_ref' => 'product_24']
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
