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

    public function load(ObjectManager $manager):void
    {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('test@cocktail.com');
        $admin->setUsername('Johny Booze Legs');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
        $admin->setPhone('0000000000');
        $admin->setDateOfBirth(new \DateTime('2000-01-01'));
        $manager->persist($admin);


        $user1 = new User();
        $user1->setRoles(['ROLE_USER']);
        $user1->setEmail('user1@cocktail.com');
        $user1->setUsername('Baba Yaga');
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'password'));
        $user1->setPhone('6666666666');
        $user1->setDateOfBirth(new \DateTime('1999-01-01'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setRoles(['ROLE_USER']);
        $user2->setEmail('user2@cocktail.com');
        $user2->setUsername('Elizabeth');
        $user2->setPassword($this->passwordHasher->hashPassword($user2, 'password'));
        $user2->setPhone('88888888888');
        $user2->setDateOfBirth(new \DateTime('1980-01-01'));
        $manager->persist($user1);
        $manager->flush();

        $bar1 = new User();
        $bar1->setRoles(['ROLE_BARTENDER']);
        $bar1->setEmail('user3@cocktail.com');
        $bar1->setUsername('Bobo');
        $bar1->setPassword($this->passwordHasher->hashPassword($bar1, 'password'));
        $bar1->setPhone('7777777777');
        $bar1->setDateOfBirth(new \DateTime('1970-01-01'));
        $manager->persist($user1);
        $manager->flush();

        $bar2 = new User();
        $bar2->setRoles(['ROLE_BARTENDER']);
        $bar2->setEmail('user4@cocktail.com');
        $bar2->setUsername('Bob Marley');
        $bar2->setPassword($this->passwordHasher->hashPassword($bar2, 'password'));
        $bar2->setPhone('1111111111');
        $bar2->setDateOfBirth(new \DateTime('1996-01-01'));
        $manager->persist($user1);
        $manager->flush();


    }
}
