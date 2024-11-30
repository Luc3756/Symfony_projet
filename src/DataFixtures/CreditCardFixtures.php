<?php

namespace App\DataFixtures;

use App\Entity\CreditCard;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CreditCardFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $user1 = $this->getReference('user1'); 
        $user2 = $this->getReference('user2'); 
        $user3 = $this->getReference('user3'); 

        $creditCardsData = [
            [
                'number' => '1234567812345678',
                'expirationDate' => '12/25',
                'cvv' => '123',
                'user' => $user1, 
            ],
            [
                'number' => '2345678923456789',
                'expirationDate' => '01/26',
                'cvv' => '456',
                'user' => $user2, 
            ],
            [
                'number' => '3456789034567890',
                'expirationDate' => '11/24',
                'cvv' => '789',
                'user' => $user3, 
            ],
            [
                'number' => '4567890145678901',
                'expirationDate' => '07/27',
                'cvv' => '101',
                'user' => $user1, 
            ]
        ];

        foreach ($creditCardsData as $key => $creditCardData) {
            $creditCard = new CreditCard();
            $creditCard->setNumber($creditCardData['number']);
            $creditCard->setExpirationDate($creditCardData['expirationDate']);
            $creditCard->setCvv($creditCardData['cvv']);
            $creditCard->setUser($creditCardData['user']);

            $manager->persist($creditCard);

            $this->addReference('creditCard' . ($key + 1), $creditCard);
        }

        $manager->flush();
    }
}
