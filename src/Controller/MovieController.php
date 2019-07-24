<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;

/**
 * Class MovieController
 * @package App\Controller
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/movie/{slug}", name="movie_details")
     */
    public function details(Movie $movie)
    {
        return $this->render('movie/details.html.twig', [
            'movie' => $movie,
        ]);
    }
}
