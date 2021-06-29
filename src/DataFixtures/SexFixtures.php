<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Sex;

class SexFixtures extends Fixture
{
    private const SEX = ['M', 'F'];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEX as $key => $sexName) {
            $sex = new Skill();
            $sex->setName($sexName);
            $manager->persist($sex);
            $this->addReference('skill_' . $key, $sex);
        }

        $manager->flush();
    }
}
