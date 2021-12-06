<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('brendadu' . $i . '@gmail.com');
            $user->setPassword($this->encoder->hashPassword($user, 'password'));
            $user->setRoles(['ROLE_USER']);
            $user->setApiKey('apiKeyTest');

            $manager->persist($user);
        }

        $manager->flush();
    }
}
