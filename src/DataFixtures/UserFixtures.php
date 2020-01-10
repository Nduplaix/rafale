<?php

namespace App\DataFixtures;

use App\Entity\Basket;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    protected $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $basket = new Basket();

        $basket->setTotalPrice(0)
            ->setUser($user);

        $password = $this->passwordEncoder->encodePassword($user, 'azerty');
        $user->setEmail('nduplaix62@gmail.com')
            ->setPassword($password)
            ->setFirstname('Nicolas')
            ->setLastname('Duplaix')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setBasket($basket);

        $manager->persist($user);
        $manager->persist($basket);

        $manager->flush();
    }
}
