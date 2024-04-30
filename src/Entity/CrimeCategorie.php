<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use App\Repository\CrimeCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CrimeCategorieRepository::class)]
#[ApiResource]
class CrimeCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    #[Groups('read')]
    private ?string $categorie = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Crime::class)]
    private Collection $crimes;

    public function __construct()
    {
        $this->crimes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

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
            $crime->setCategorie($this);
        }

        return $this;
    }

    public function removeCrime(Crime $crime): static
    {
        if ($this->crimes->removeElement($crime)) {
            // set the owning side to null (unless already changed)
            if ($crime->getCategorie() === $this) {
                $crime->setCategorie(null);
            }
        }

        return $this;
    }
}
