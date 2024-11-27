<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            [
                'email' => 'Luc@gmail.com',
                'firstName' => 'Luc',
                'lastName' => 'MANICK',
                'roles' => ['ROLE_ADMIN'],
                'password' => '1234',
            ],
            [
                'email' => 'Matis@gmail.com',
                'firstName' => 'Matis',
                'lastName' => 'DOTTO',
                'roles' => ['ROLE_USER'],
                'password' => '123',
            ],
            [
                'email' => 'Thomas@gmail.com',
                'firstName' => 'Thomas',
                'lastName' => 'DUCRET',
                'roles' => ['ROLE_USER'],
                'password' => '123',
            ],
            [
                'email' => 'Alexis@gmail.com',
                'firstName' => 'Alexis',
                'lastName' => 'CARON',
                'roles' => ['ROLE_USER'],
                'password' => '123',
            ],
            [
                'email' => 'Arthur@gmail.com',
                'firstName' => 'Arthur',
                'lastName' => 'MALORON',
                'roles' => ['ROLE_USER'],
                'password' => '123',
            ],
            [
                'email' => 'Steven@gmail.com',
                'firstName' => 'Steven',
                'lastName' => 'LEFEBVRE',
                'roles' => ['ROLE_USER'],
                'password' => '123',
            ],
            [
                'email' => 'Christophe@gmail.com',
                'firstName' => 'Christophe',
                'lastName' => 'PETRE',
                'roles' => ['ROLE_USER'],
                'password' => '123',
            ],
            [
                'email' => 'Josuke@gmail.com',
                'firstName' => 'Josuke',
                'lastName' => 'HIGASHIKATA',
                'roles' => ['ROLE_USER'],
                'password' => '123',
            ],
        ];

        foreach ($usersData as $key => $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setFirstName($userData['firstName']);
            $user->setLastName($userData['lastName']);
            $user->setRoles($userData['roles']);

            $hashedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);

            
            $this->addReference('user' . ($key + 1), $user);
        }

        $manager->flush();
    }
}
