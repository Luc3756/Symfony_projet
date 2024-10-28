<?php

namespace App\DataFixtures;

use App\Entity\Adress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        
        $adress1 = new Adress();
        $adress1->setStreet('123 Rue de la Ferme');
        $adress1->setPostalCode(75001);
        $adress1->setCity('Paris');
        $adress1->setCountry('France');
        $adress1->setUser($this->getReference('user1')); 
        $manager->persist($adress1);

 
        $adress2 = new Adress();
        $adress2->setStreet('456 Route des Champs');
        $adress2->setPostalCode(69002);
        $adress2->setCity('Lyon');
        $adress2->setCountry('France');
        $adress2->setUser($this->getReference('user2'));
        $manager->persist($adress2);

        
        $adress3 = new Adress();
        $adress3->setStreet('789 Avenue des Agriculteurs');
        $adress3->setPostalCode(33000);
        $adress3->setCity('Bordeaux');
        $adress3->setCountry('France');
        $adress3->setUser($this->getReference('user1'));
        $manager->persist($adress3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
