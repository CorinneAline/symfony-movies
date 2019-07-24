<?php

namespace App\Tests;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testHomePageIsReachable($uri)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $uri);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Symfony Movies', $crawler->filter('title')->text());
    }

    public function urlProvider()
    {
        return [
            ['/']
        ];
    }

    /**
     * @dataProvider urlProvider
     */
    public function testlastMoviesList($uri)
    {
        $client = static::createClient();
        $container = static::$container; //ou self::container

        $movieRepository = $container->get(MovieRepository::class);
        $movies = $movieRepository->findLastMovies();

        $crawler = $client->request('GET', $uri);
        $lastMovies = $crawler->filter('#last_movies');
        $this->assertSame(3, $lastMovies->filter('li')->count());

        foreach ($movies as $movie) {
            $this->assertContains($movie->getTitle(), $lastMovies->text());
        }
    }
}
