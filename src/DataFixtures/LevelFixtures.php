<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Skill;

class LevelFixtures extends Fixture
{
    private const LEVELS = ['Male', 'female', 'Other'];

    public function load(ObjectManager $manager)
    {
        foreach (self::LEVELS as $key => $levelName) {
            $level = new Level();
            $level->setName($levelName);
            $manager->persist($level);
            $this->addReference('level_' . $key, $level);
        }

        $manager->flush();
    }
}
