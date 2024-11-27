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
        $adress3->setUser($this->getReference('user3'));
        $manager->persist($adress3);

        $adress4 = new Adress();
        $adress4->setStreet('102 Boulevard des Moulins');
        $adress4->setPostalCode(13008);
        $adress4->setCity('Marseille');
        $adress4->setCountry('France');
        $adress4->setUser($this->getReference('user4'));
        $manager->persist($adress4);

        $adress5 = new Adress();
        $adress5->setStreet('87 Rue du Château');
        $adress5->setPostalCode(75012);
        $adress5->setCity('Paris');
        $adress5->setCountry('France');
        $adress5->setUser($this->getReference('user5'));
        $manager->persist($adress5);

        $adress6 = new Adress();
        $adress6->setStreet('55 Avenue des Cèdres');
        $adress6->setPostalCode(69001);
        $adress6->setCity('Lyon');
        $adress6->setCountry('France');
        $adress6->setUser($this->getReference('user6'));
        $manager->persist($adress6);

        $adress7 = new Adress();
        $adress7->setStreet('12 Impasse des Vins');
        $adress7->setPostalCode(31000);
        $adress7->setCity('Toulouse');
        $adress7->setCountry('France');
        $adress7->setUser($this->getReference('user7'));
        $manager->persist($adress7);

        $adress8 = new Adress();
        $adress8->setStreet('33 Rue du Parc');
        $adress8->setPostalCode(54000);
        $adress8->setCity('Nancy');
        $adress8->setCountry('France');
        $adress8->setUser($this->getReference('user8'));
        $manager->persist($adress8);

        $adress9 = new Adress();
        $adress9->setStreet('98 Rue des Lilas');
        $adress9->setPostalCode(75013);
        $adress9->setCity('Paris');
        $adress9->setCountry('France');
        $adress9->setUser($this->getReference('user1'));
        $manager->persist($adress9);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
