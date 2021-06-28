<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Skill;

class SkillFixtures extends Fixture
{
    private const SKILLS = ['Graphics & Design',
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
