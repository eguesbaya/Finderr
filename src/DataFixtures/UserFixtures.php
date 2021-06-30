<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public const LOOPNUMBER = 20;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public const LINK_IMAGE = 'public/build/images/photos/';
    public const CITY = ['Biarritz',
    'Bordeaux',
    'La Loupe',
    'Lille',
    'Lyon',
    'Marseille',
    'Nantes',
    'Orléans',
    'Paris',
    'Reims',
    'Saintes',
    'Strasbourg',
    'Toulouse',
    'Tours'];



    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $coworker = new User();

            $coworker->setSex($this->getReference('sex_' . rand(0, 2)));
            $coworker->setMemberSince($faker->dateTimeBetween('2021-01-01 00:00:00', 'now'));
            $coworker->setAge(rand(20, 80));
            $coworker->setLastname($faker->firstName());
            $coworker->setSkill($this->getReference('skill_' . rand(0, 8)));
            $coworker->setEmail($faker->email());
            $coworker->setRoles(['ROLE_CONTRIBUTOR']);
            $coworker->setCountry('France');
            $coworker->setCity(self::CITY[rand(0, count(self::CITY) - 1)]);
            $urlImage = self::LINK_IMAGE . rand(1, 33) . '.jpg';
            $path = uniqid() . '.jpg';
            copy($urlImage, 'public/uploads/' . $path);
            $imagePath = $path;
            $coworker->setPicture($imagePath);
            $coworker->setPassword($this->passwordEncoder->encodePassword(
                $coworker,
                '12345'
            ));

            $manager->persist($coworker);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          SexFixtures::class,
          SkillFixtures::class,
          LevelFixtures::class,
        ];
    }
}
