<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\SectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: SectorRepository::class)]
#[ApiResource(

    operations: [
        new Get(),
        new Post(),
        new Put(security: "is_granted('ROLE_ADMIN')"),
        new GetCollection(),
    ],
    normalizationContext: ['groups' => ['sector_read']],
    denormalizationContext: ['groups' => ['sector_write']]
)]
class Sector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['sector_read','route_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255,nullable: true)]
    #[Groups(['sector_read','sector_write','route_read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT,nullable: true)]
    #[Groups(['sector_read','sector_write','route_read'])]
    private ?string $description_fr = null;

    #[ORM\Column(type: Types::TEXT,nullable: true)]
    #[Groups(['sector_read','sector_write','route_read'])]
    private ?string $description_en = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'sectors')]
    #[Groups(['sector_read','sector_write'])]
    private ?Region $region = null;

    #[ORM\OneToMany(mappedBy: 'sector', targetEntity: Route::class)]
    #[Groups(['sector_read','sector_write'])]
    private Collection $routes;

    #[ORM\OneToMany(mappedBy: 'sector', targetEntity: Circuit::class)]
    #[Groups(['sector_read','sector_write'])]
    private Collection $circuits;

    public function __construct()
    {
        $this->routes = new ArrayCollection();
        $this->circuits = new ArrayCollection();
    }

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

    public function getRegions(): ?Region
    {
        return $this->region;
    }

    public function setRegions(?Region $region): self
    {
        $this->region = $region;

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
            $route->setSector($this);
        }

        return $this;
    }

    public function removeRoute(Route $route): self
    {
        if ($this->routes->removeElement($route)) {
            // set the owning side to null (unless already changed)
            if ($route->getSector() === $this) {
                $route->setSector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Circuit>
     */
    public function getCircuits(): Collection
    {
        return $this->circuits;
    }

    public function addCircuit(Circuit $circuit): self
    {
        if (!$this->circuits->contains($circuit)) {
            $this->circuits->add($circuit);
            $circuit->setSector($this);
        }

        return $this;
    }

    public function removeCircuit(Circuit $circuit): self
    {
        if ($this->circuits->removeElement($circuit)) {
            // set the owning side to null (unless already changed)
            if ($circuit->getSector() === $this) {
                $circuit->setSector(null);
            }
        }

        return $this;
    }
}
