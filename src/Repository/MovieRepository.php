<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    /**
     * MovieRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * Returns last published movies. A limit can be added in as an argument
     * @param int $limit
     * @return array
     */
    public function findLastMovies($limit = 3): array
    {
        return $this->findBy([], ['date' => 'DESC'], $limit);
    }

    /**
     * Returns last published movie.
     * @return Movie|null
     */
    public function findLastMovie(): ?Movie
    {
        return $this->findOneBy([], ['date' => 'DESC']);
    }
}
