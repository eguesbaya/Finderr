<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public const LOOPNUMBER = 10;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $coworker = new User();
            $coworker->setUserName($faker->firstName() . $faker->lastName());
            $coworker->setMemberSince($faker->dateTimeBetween('2021-01-01 00:00:00', 'now'));
            $coworker->setEmail($faker->email());
            $coworker->setRoles(['ROLE_coworker']);
            $coworker->setCountry($faker->city());
            $coworker->setPassword($this->passwordEncoder->encodePassword(
                $coworker,
                $faker->password()
            ));

            $manager->persist($coworker);
        }
        $manager->flush();
    }
}
