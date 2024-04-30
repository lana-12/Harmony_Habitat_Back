<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    operations: [
        new Get(),
        // new Get(name: 'weather', uriTemplate: '/places/{id}/weather', controller: GetWeather::class),
        new GetCollection(),
    ]
)]

class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('read')]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code_commune = null;

    #[ORM\Column(length: 10)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 80)]
    #[Groups('read')]
    private ?string $nom_commune = null;

    #[ORM\ManyToOne(inversedBy: 'communes')]
    #[Groups('read')]
    private ?PositionGPS $position = null;

    #[ORM\ManyToOne(inversedBy: 'communes')]
    private ?Departement $departement = null;

    #[ORM\ManyToOne(inversedBy: 'communes')]
    private ?Region $region = null;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: Ecole::class)]
    #[Groups('read')]
    private Collection $ecoles;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: ImmoPrix::class)]
    #[Groups('read')]
    private Collection $immoPrixes;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: Crime::class)]
    #[Groups('read')]
    private Collection $crimes;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: Favorite::class)]
    private Collection $favorites;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: Comment::class)]
    private Collection $comments;

    public function __construct()
    {
        $this->ecoles = new ArrayCollection();
        $this->immoPrixes = new ArrayCollection();
        $this->crimes = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCommune(): ?string
    {
        return $this->code_commune;
    }

    public function setCodeCommune(string $code_commune): static
    {
        $this->code_commune = $code_commune;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getNomCommune(): ?string
    {
        return $this->nom_commune;
    }

    public function setNomCommune(string $nom_commune): static
    {
        $this->nom_commune = $nom_commune;

        return $this;
    }

    public function getPosition(): ?PositionGPS
    {
        return $this->position;
    }

    public function setPosition(?PositionGPS $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): static
    {
        $this->departement = $departement;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, Ecole>
     */
    public function getEcoles(): Collection
    {
        return $this->ecoles;
    }

    public function addEcole(Ecole $ecole): static
    {
        if (!$this->ecoles->contains($ecole)) {
            $this->ecoles->add($ecole);
            $ecole->setCommune($this);
        }

        return $this;
    }

    public function removeEcole(Ecole $ecole): static
    {
        if ($this->ecoles->removeElement($ecole)) {
            // set the owning side to null (unless already changed)
            if ($ecole->getCommune() === $this) {
                $ecole->setCommune(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ImmoPrix>
     */
    public function getImmoPrixes(): Collection
    {
        return $this->immoPrixes;
    }

    public function addImmoPrix(ImmoPrix $immoPrix): static
    {
        if (!$this->immoPrixes->contains($immoPrix)) {
            $this->immoPrixes->add($immoPrix);
            $immoPrix->setCommune($this);
        }

        return $this;
    }

    public function removeImmoPrix(ImmoPrix $immoPrix): static
    {
        if ($this->immoPrixes->removeElement($immoPrix)) {
            // set the owning side to null (unless already changed)
            if ($immoPrix->getCommune() === $this) {
                $immoPrix->setCommune(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Crime>
     */
    public function getCrimes(): Collection
    {
        return $this->crimes;
    }

    public function addCrime(Crime $crime): static
    {
        if (!$this->crimes->contains($crime)) {
            $this->crimes->add($crime);
            $crime->setCommune($this);
        }

        return $this;
    }

    public function removeCrime(Crime $crime): static
    {
        if ($this->crimes->removeElement($crime)) {
            // set the owning side to null (unless already changed)
            if ($crime->getCommune() === $this) {
                $crime->setCommune(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setCommune($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getCommune() === $this) {
                $favorite->setCommune(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCommune($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCommune() === $this) {
                $comment->setCommune(null);
            }
        }

        return $this;
    }
}
