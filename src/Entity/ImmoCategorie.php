<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImmoCategorieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImmoCategorieRepository::class)]
#[ApiResource]
class ImmoCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Groups('read')]
    private ?string $categorie = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: ImmoPrix::class)]

    private Collection $immoPrixes;

    public function __construct()
    {
        $this->immoPrixes = new ArrayCollection();
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
            $immoPrix->setCategorie($this);
        }

        return $this;
    }

    public function removeImmoPrix(ImmoPrix $immoPrix): static
    {
        if ($this->immoPrixes->removeElement($immoPrix)) {
            // set the owning side to null (unless already changed)
            if ($immoPrix->getCategorie() === $this) {
                $immoPrix->setCategorie(null);
            }
        }

        return $this;
    }
}
