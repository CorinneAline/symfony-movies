<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT = 60;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::COUNT; $i ++) {
            $movie = new Movie();
            $movie->setTitle($faker->sentence);
            $movie->setDate($faker->dateTimeThisCentury);
            
            /*Directors*/
            $randDirector = rand(0,10);
            $nbDirectors = $randDirector < 8 ? 1 : ($randDirector < 10 ? 2 : 3) ;

            for ($j = 0 ; $j < $nbDirectors ; $j ++) {
                $director = $this->getReference('artist'.rand(0, ArtistFixtures::COUNT - 1));
                $movie->addDirector($director);
            }

            /*Actors*/
            $randActor = rand(0,20);
            $nbActors = $randActor < 12 ? 7 : ($randActor < 10 ? 6 : 4) ;
            for ($k = 1 ; $k < $nbActors ; $k ++) {
                $actor = $this->getReference('artist'.rand(0, ArtistFixtures::COUNT - 1));
                $movie->addActor($actor);
            }
            $manager->persist($movie);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            ArtistFixtures::class
        ];
    }
}
