<?php

namespace App\Entity;

use App\Repository\RouteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_fr = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_en = null;

    #[ORM\Column]
    private ?int $rating_value = null;

    #[ORM\Column]
    private ?int $nb_rating = null;

    #[ORM\Column]
    private ?int $nb_repetition = null;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'routes')]
    private Collection $types;

    #[ORM\ManyToMany(targetEntity: BleauVideo::class, inversedBy: 'routes')]
    private Collection $bleauVideos;

    #[ORM\ManyToMany(targetEntity: BleauImage::class, inversedBy: 'routes')]
    private Collection $bleauImages;

    #[ORM\ManyToMany(targetEntity: BleauDescription::class, inversedBy: 'routes')]
    private Collection $bleauDescriptions;

    #[ORM\ManyToOne(inversedBy: 'routes')]
    private ?Sector $sector = null;

    #[ORM\ManyToOne(inversedBy: 'routes')]
    private ?Setter $setter = null;

    #[ORM\ManyToMany(targetEntity: Circuit::class, inversedBy: 'routes')]
    private Collection $circuit;

    #[ORM\OneToMany(mappedBy: 'route', targetEntity: Image::class)]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'route', targetEntity: Video::class)]
    private Collection $videos;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->bleauVideos = new ArrayCollection();
        $this->bleauImages = new ArrayCollection();
        $this->bleauDescriptions = new ArrayCollection();
        $this->circuit = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
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

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    /**
     * @return Collection<int, BleauVideo>
     */
    public function getBleauVideos(): Collection
    {
        return $this->bleauVideos;
    }

    public function addBleauVideo(BleauVideo $bleauVideo): self
    {
        if (!$this->bleauVideos->contains($bleauVideo)) {
            $this->bleauVideos->add($bleauVideo);
        }

        return $this;
    }

    public function removeBleauVideo(BleauVideo $bleauVideo): self
    {
        $this->BleauVideos->removeElement($bleauVideo);

        return $this;
    }

    /**
     * @return Collection<int, BleauImage>
     */
    public function getBleauImages(): Collection
    {
        return $this->bleauImages;
    }

    public function addBleauImage(BleauImage $bleauImage): self
    {
        if (!$this->bleauImages->contains($bleauImage)) {
            $this->bleauImages->add($bleauImage);
        }

        return $this;
    }

    public function removeBleauImage(BleauImage $bleauImage): self
    {
        $this->bleauImages->removeElement($bleauImage);

        return $this;
    }

    /**
     * @return Collection<int, BleauDescription>
     */
    public function getBleauDescriptions(): Collection
    {
        return $this->bleauDescriptions;
    }

    public function addBleauDescription(BleauDescription $bleauDescription): self
    {
        if (!$this->bleauDescriptions->contains($bleauDescription)) {
            $this->bleauDescriptions->add($bleauDescription);
        }

        return $this;
    }

    public function removeBleauDescription(BleauDescription $bleauDescription): self
    {
        $this->bleauDescriptions->removeElement($bleauDescription);

        return $this;
    }

    public function getSector(): ?Sector
    {
        return $this->sector;
    }

    public function setSector(?Sector $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getSetter(): ?Setter
    {
        return $this->setter;
    }

    public function setSetter(?Setter $setter): self
    {
        $this->setter = $setter;

        return $this;
    }

    /**
     * @return Collection<int, Circuit>
     */
    public function getCircuit(): Collection
    {
        return $this->circuit;
    }

    public function addCircuit(Circuit $circuit): self
    {
        if (!$this->circuit->contains($circuit)) {
            $this->circuit->add($circuit);
        }

        return $this;
    }

    public function removeCircuit(Circuit $circuit): self
    {
        $this->circuit->removeElement($circuit);

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setRoute($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getRoute() === $this) {
                $image->setRoute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setRoute($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getRoute() === $this) {
                $video->setRoute(null);
            }
        }

        return $this;
    }
}
