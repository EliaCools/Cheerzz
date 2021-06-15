<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixture extends Fixture
{


    public function load(ObjectManager $manager)
    {

        $firstUser = new User();
        $firstUser->setPassword('123456');
        $firstUser->setFirstName('Huba');
        $firstUser->setLastName('Buba');
        $firstUser->setPhone(0456601224);
        $firstUser->setEmail('hubabuba@gmail.com');

        $secondUser = new User();
        $secondUser->setPassword('username');
        $secondUser->setFirstName('Password');
        $secondUser->setLastName('Password');
        $secondUser->setPhone(04666012246);
        $secondUser->setEmail('password@gmail.com');

        $manager->flush();

        // to add fixture data to database, run:
        // php bin/console doctrine:fixtures:load
    }
}
