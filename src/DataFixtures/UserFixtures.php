<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoder $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('test@test.com')
            ->setRoles([
                'ROLE_USER',
                'ROLE_ADMIN'
            ]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test'
        ));
        // $product = new Product();
         $manager->persist($user);

        $manager->flush();
    }
}
