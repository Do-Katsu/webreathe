<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use App\Entity\Modules;
use App\Entity\Tempratures;
use App\Entity\Positions;
use App\Entity\Consommations;
use App\Entity\Vitesses;
use App\Entity\Uptime;
use App\Entity\Mesures;
use Monolog\DateTimeImmutable;

class ModulesFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        $module = new Modules;
        $module->setNom('First Module!');
        $manager->persist($module);

        for($j=0; $j < 10; $j++) {
            //Fixtures for velocity
            $mesureVit = new Mesures;
            $mesureVit
                ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                ->setModules($module)
                ->setType('vitesse')
                ;
            $manager->persist($mesureVit);

            $vitesse = new Vitesses;
            $vitesse
                ->setValeur(rand(10,100))
                ->setMesure($mesureVit)
                ;
            $manager->persist($vitesse);
            
            //Fixtures for Temprature
            $mesureTemp = new Mesures;
            $mesureTemp
                ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                ->setModules($module)
                ->setType('temprature')
                ;
            $manager->persist($mesureTemp);

            $temprature = new Tempratures;
            $temprature
                ->setValeur(rand(10,100))
                ->setMesure($mesureTemp)
                ;
            $manager->persist($temprature);

            //Fixtures for consumation
            $mesureCon = new Mesures;
            $mesureCon
                ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                ->setModules($module)
                ->setType('consommation')
                ;
            $manager->persist($mesureCon);

            $consommation = new Consommations;
            $consommation
                ->setValeur(rand(10,100))
                ->setMesure($mesureCon)
                ;
            $manager->persist($consommation);

            //Fixtures for positions
            $mesurePos = new Mesures;
            $mesurePos
                ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                ->setModules($module)
                ->setType('position')
                ;
            $manager->persist($mesurePos);

            $position = new Positions;
            $position
                ->setLng(rand(10,100))
                ->setLat(rand(10,100))
                ->setMesure($mesurePos)
                ;
            $manager->persist($position);

            //Fixtures for Uptime
            $uptime = new Uptime;
            $uptime
                ->setDateValue(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-5 week', '-1 week')))
                ->setActive($faker->boolean())
                ->setModules($module)
                ;
            $manager->persist($uptime);
        }

        for($i=0; $i < 20; $i++) {
            $module = new Modules;
            $module->setNom($faker->words(2, true));
            $manager->persist($module);
            for($j=0; $j < 10; $j++) {
                //Fixtures for velocity
                $mesureVit = new Mesures;
                $mesureVit
                    ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                    ->setModules($module)
                    ->setType('vitesse')
                    ;
                $manager->persist($mesureVit);
    
                $vitesse = new Vitesses;
                $vitesse
                    ->setValeur(rand(10,100))
                    ->setMesure($mesureVit)
                    ;
                $manager->persist($vitesse);
                
                //Fixtures for Temprature
                $mesureTemp = new Mesures;
                $mesureTemp
                    ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                    ->setModules($module)
                    ->setType('temprature')
                    ;
                $manager->persist($mesureTemp);
    
                $temprature = new Tempratures;
                $temprature
                    ->setValeur(rand(10,100))
                    ->setMesure($mesureTemp)
                    ;
                $manager->persist($temprature);
    
                //Fixtures for consumation
                $mesureCon = new Mesures;
                $mesureCon
                    ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                    ->setModules($module)
                    ->setType('consommation')
                    ;
                $manager->persist($mesureCon);
    
                $consommation = new Consommations;
                $consommation
                    ->setValeur(rand(10,100))
                    ->setMesure($mesureCon)
                    ;
                $manager->persist($consommation);
    
                //Fixtures for positions
                $mesurePos = new Mesures;
                $mesurePos
                    ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 week', '-5 week')))
                    ->setModules($module)
                    ->setType('position')
                    ;
                $manager->persist($mesurePos);
    
                $position = new Positions;
                $position
                    ->setLng(rand(10,100))
                    ->setLat(rand(10,100))
                    ->setMesure($mesurePos)
                    ;
                $manager->persist($position);
    
                //Fixtures for Uptime
                $uptime = new Uptime;
                $uptime
                    ->setDateValue(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-5 week', '-1 week')))
                    ->setActive($faker->boolean())
                    ->setModules($module)
                    ;
                $manager->persist($uptime);
            }
        }

        $manager->flush();
    }

}