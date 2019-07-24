<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $usageName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movie", inversedBy="directors")
     * @ORM\JoinTable(name="director_movie")
     */
    private $moviesMade;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movie", inversedBy="actors")
     * @ORM\JoinTable(name="actor_movie")
     */
    private $moviesPlayed;


    /**
     * Artist constructor.
     */
    public function __construct()
    {
        $this->moviesMade = new ArrayCollection();
        $this->moviesPlayed = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Artist
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return Artist
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsageName(): ?string
    {
        return $this->usageName;
    }

    /**
     * @param string $usageName
     * @return Artist
     */
    public function setUsageName(string $usageName): self
    {
        $this->usageName = $usageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBiography(): ?string
    {
        return $this->biography;
    }

    /**
     * @param string|null $biography
     * @return Artist
     */
    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMoviesMade(): Collection
    {
        return $this->moviesMade;
    }

    /**
     * @param Movie $moviesMade
     * @return Artist
     */
    public function addMoviesMade(Movie $moviesMade): self
    {
        if (!$this->moviesMade->contains($moviesMade)) {
            $this->moviesMade[] = $moviesMade;
        }

        return $this;
    }

    /**
     * @param Movie $moviesMade
     * @return Artist
     */
    public function removeMoviesMade(Movie $moviesMade): self
    {
        if ($this->moviesMade->contains($moviesMade)) {
            $this->moviesMade->removeElement($moviesMade);
        }

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMoviesPlayed(): Collection
    {
        return $this->moviesPlayed;
    }

    /**
     * @param Movie $moviesPlayed
     * @return Artist
     */
    public function addMoviesPlayed(Movie $moviesPlayed): self
    {
        if (!$this->moviesPlayed->contains($moviesPlayed)) {
            $this->moviesPlayed[] = $moviesPlayed;
        }

        return $this;
    }

    /**
     * @param Movie $moviesPlayed
     * @return Artist
     */
    public function removeMoviesPlayed(Movie $moviesPlayed): self
    {
        if ($this->moviesPlayed->contains($moviesPlayed)) {
            $this->moviesPlayed->removeElement($moviesPlayed);
        }

        return $this;
    }
}
