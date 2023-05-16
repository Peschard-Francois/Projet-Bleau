<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CircuitRepository::class)]
class Circuit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_fr = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_en = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $create_date = null;

    #[ORM\ManyToMany(targetEntity: Route::class, mappedBy: 'circuit')]
    private Collection $routes;

    #[ORM\OneToMany(mappedBy: 'circuit', targetEntity: Color::class)]
    private Collection $colors;

    public function __construct()
    {
        $this->routes = new ArrayCollection();
        $this->colors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }

    /**
     * @return Collection<int, Route>
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    public function addRoute(Route $route): self
    {
        if (!$this->routes->contains($route)) {
            $this->routes->add($route);
            $route->addCircuit($this);
        }

        return $this;
    }

    public function removeRoute(Route $route): self
    {
        if ($this->routes->removeElement($route)) {
            $route->removeCircuit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Color>
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors->add($color);
            $color->setCircuit($this);
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        if ($this->colors->removeElement($color)) {
            // set the owning side to null (unless already changed)
            if ($color->getCircuit() === $this) {
                $color->setCircuit(null);
            }
        }

        return $this;
    }
}
