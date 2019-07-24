<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Sluggable\Sluggable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
    use Sluggable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", mappedBy="moviesMade")
     */
    private $directors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", mappedBy="moviesPlayed")
     * @ORM\JoinTable(name="actor_movie",
     *      joinColumns={@ORM\JoinColumn(name="movie_id", referencedColumnName="id", nullable=false)}
     *      )
     */
    private $actors;

    public function __construct()
    {
        $this->directors = new ArrayCollection();
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Returns an array of the fields used to generate the slug.
     *
     * @return array
     */
    public function getSluggableFields()
    {
        return ['title'];
    }

    /**
     * @return Collection|Artist[]
     */
    public function getDirectors(): Collection
    {
        return $this->directors;
    }

    public function addDirector(Artist $director): self
    {
        if (!$this->directors->contains($director)) {
            $this->directors[] = $director;
            $director->addMoviesMade($this);
        }

        return $this;
    }

    public function removeDirector(Artist $director): self
    {
        if ($this->directors->contains($director)) {
            $this->directors->removeElement($director);
            $director->removeMoviesMade($this);
        }

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Artist $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->addMoviesPlayed($this);
        }

        return $this;
    }

    public function removeActor(Artist $actor): self
    {
        if ($this->actors->contains($actor)) {
            $this->actors->removeElement($actor);
            $actor->removeMoviesPlayed($this);
        }

        return $this;
    }
}
