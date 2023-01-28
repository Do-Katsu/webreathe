<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use App\Entity\Modules;

class ModulesFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        $module = new Modules;
        $module->setNom('First Module!');
        $manager->persist($module);

        for($i=0; $i < 100; $i++) {
            $module = new Modules;
            $module->setNom($faker->words(2, true));
            $manager->persist($module);
        }

        $manager->flush();
    }
}
