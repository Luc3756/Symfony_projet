<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'Animaux',
            'Machine agricole',
            'Nourriture animale',
            'Equipement agricole',
        ];

        foreach ($categories as $index => $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);

            $this->addReference('category' . ($index + 1), $category);
        }

        $manager->flush();
    }
}
