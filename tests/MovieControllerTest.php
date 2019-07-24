<?php

namespace App\Tests;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\DomCrawler\Crawler;

class MovieControllerTest extends WebTestCase
{
    public function testMovieDetailsIsBrowsableFromHome()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->filter('#last_movies li > a')->link();
        $crawlerDetails = $client->click($link);
        $container = self::$container;
        $movieRepository = $container->get(MovieRepository::class);
        $lastMovie = $movieRepository->findLastMovie();
        $this->assertContains($lastMovie->getTitle(), $crawlerDetails->filter('h1')->text());
        $this->assertContains($lastMovie->getDate()->format('d/m/Y'), $crawlerDetails->filter('time')->text());
        $this->assertGreaterThanOrEqual(1, $lastMovie->getDirectors()->count());

        foreach ($lastMovie->getDirectors() as $director){
            $this->assertContains($director->getUsageName(), $crawlerDetails->filter('time ~ p')->text());
        }

        foreach ($lastMovie->getActors() as $actor){
            $this->assertContains($actor->getUsageName(), $crawlerDetails->filter('#actors li')->each(function (Crawler $node, $i) use ($actor) {
                return $actor->getUsageName() == $node->text();
            }));
        }
    }
}
