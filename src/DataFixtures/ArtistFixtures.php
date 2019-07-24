<?php


namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Artist;

class ArtistFixtures extends Fixture
{
    const COUNT = 200;
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::COUNT; $i ++) {
            $artist = new Artist();
            $firstname = $faker->firstName;
            $lastname = $faker->lastName;
            $usagename = $faker->userName;

            $artist->setFirstname($firstname);
            $artist->setLastname($lastname);
            $artist->setUsageName($usagename);
            $artist->setBiography($faker->text);

            $manager->persist($artist);
            $this->addReference('artist'.$i, $artist);
        }
        $manager->flush();

    }
}