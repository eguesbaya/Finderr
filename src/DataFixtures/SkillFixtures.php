<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SkillFixtures extends Fixture
{
    public const SKILLS = ['Graphics & Design',
                    'Digital Marketing',
                    'Writing & Translation',
                    'Video & Animation',
                    'Music & Audio',
                    'Programming & Tech',
                    'DataNEW',
                    'Business',
                    'lifestyle',
                    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SKILLS as $key => $skillName) {
            $skill = new Skill();
            $skill->setName($skillName);
            $manager->persist($skill);
            $this->addReference('skill_' . $key, $skill);
        }

        $manager->flush();
    }
}
