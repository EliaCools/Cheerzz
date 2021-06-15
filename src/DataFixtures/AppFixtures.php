<?php

namespace App\DataFixtures;

<<<<<<< HEAD
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

=======
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager):void
    {
        $user = new User();

        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail('test@cocktail.com');
        $user->setUsername('Johny Booze Legs');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $user->setPhone('0000000000');
        $user->setDateOfBirth(new \DateTime('2000-01-01'));

        $manager->persist($user);
>>>>>>> main
        $manager->flush();
    }
}
