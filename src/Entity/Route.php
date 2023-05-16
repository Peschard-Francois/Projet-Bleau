<?php

namespace App\Entity;

use App\Repository\RouteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouteRepository::class)]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $level = null;

    #[ORM\Column(length: 255)]
    private ?string $description_fr = null;

    #[ORM\Column(length: 255)]
    private ?string $description_en = null;

    #[ORM\Column]
    private ?int $rating_value = null;

    #[ORM\Column]
    private ?int $nb_rating = null;

    #[ORM\Column]
    private ?int $nb_repetition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->description_fr;
    }

    public function setDescriptionFr(string $description_fr): self
    {
        $this->description_fr = $description_fr;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->description_en;
    }

    public function setDescriptionEn(string $description_en): self
    {
        $this->description_en = $description_en;

        return $this;
    }

    public function getRatingValue(): ?int
    {
        return $this->rating_value;
    }

    public function setRatingValue(int $rating_value): self
    {
        $this->rating_value = $rating_value;

        return $this;
    }

    public function getNbRating(): ?int
    {
        return $this->nb_rating;
    }

    public function setNbRating(int $nb_rating): self
    {
        $this->nb_rating = $nb_rating;

        return $this;
    }

    public function getNbRepetition(): ?int
    {
        return $this->nb_repetition;
    }

    public function setNbRepetition(int $nb_repetition): self
    {
        $this->nb_repetition = $nb_repetition;

        return $this;
    }
}
