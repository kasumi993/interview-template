<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
         // create users
         for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setPseudo('pseudo');
            $user->setPassword('password');
            $user->setFirstName('user');
            $user->setLastName('user');
        }
        $manager->flush();
    }
}
