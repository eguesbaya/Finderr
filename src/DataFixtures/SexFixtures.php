<?php

namespace App\DataFixtures;

use App\Entity\Sex;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SexFixtures extends Fixture
{
    public const SEX = ['M', 'F'];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEX as $key => $sexName) {
            $sex = new Sex();
            $sex->setName($sexName);
            $manager->persist($sex);
            $this->addReference('sex' . $key, $sex);
        }

        $manager->flush();
    }
}
