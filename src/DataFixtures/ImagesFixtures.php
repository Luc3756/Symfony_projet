<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $imageUrls = [
            'poule.jpg',
            'tracteur_porsche.jpg',
            'sac_blé.jpg',
            'sac_maïs.jpg',
            'couveuse_cimuka_60.jpg',
            'chevre.jpg'
        ];

        foreach ($imageUrls as $url) {
            $image = new Image();
            $image->setUrl($url);

            $manager->persist($image);
        }

        $manager->flush();
    }
}
