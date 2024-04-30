<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImmoPrixRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImmoPrixRepository::class)]
#[ApiResource]
class ImmoPrix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    #[Groups('read')] 
    private ?string $prix_m2 = null;

    #[ORM\ManyToOne(inversedBy: 'immoPrixes')]
    #[Groups('read')]
    private ?ImmoCategorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'immoPrixes')]
    private ?Commune $commune = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixM2(): ?string
    {
        return $this->prix_m2;
    }

    public function setPrixM2(string $prix_m2): static
    {
        $this->prix_m2 = $prix_m2;

        return $this;
    }

    public function getCategorie(): ?ImmoCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?ImmoCategorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): static
    {
        $this->commune = $commune;

        return $this;
    }
}
