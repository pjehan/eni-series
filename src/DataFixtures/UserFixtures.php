<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstName('admin');
        $admin->setLastName('admin');
        $manager->persist($admin);

        $john = new User();
        $john->setEmail('john@gmail.com');
        $john->setPassword($this->hasher->hashPassword($john, 'john'));
        $john->setFirstName('John');
        $john->setLastName('Doe');
        $manager->persist($john);

        $manager->flush();
    }
}
