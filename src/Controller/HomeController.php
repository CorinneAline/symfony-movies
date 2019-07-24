<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MovieRepository $movieRepository)
    {
        $lastMovies = $movieRepository->findLastMovies();

        return $this->render('home/index.html.twig', [
            'last_movies' => $lastMovies
        ]);
    }
}
