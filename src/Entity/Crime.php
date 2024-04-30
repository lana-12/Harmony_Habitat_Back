<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CrimeRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]
#[ORM\Entity(repositoryClass: CrimeRepository::class)]

class Crime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('read')]
    private ?string $annee_crime = null;

    #[ORM\Column]
    #[Groups('read')]
    private ?int $nb_crime = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 6)]
    #[Groups('read')]
    private ?string $taux_pour_mille = null;

    #[ORM\ManyToOne(inversedBy: 'crimes')]
    private ?Commune $commune = null;

    #[ORM\ManyToOne(inversedBy: 'crimes')]
    #[Groups('read')]
    private ?CrimeCategorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeCrime(): ?string
    {
        return $this->annee_crime;
    }

    public function setAnneeCrime(string $annee_crime): static
    {
        $this->annee_crime = $annee_crime;

        return $this;
    }

    public function getNbCrime(): ?int
    {
        return $this->nb_crime;
    }

    public function setNbCrime(int $nb_crime): static
    {
        $this->nb_crime = $nb_crime;

        return $this;
    }

    public function getTauxPourMille(): ?string
    {
        return $this->taux_pour_mille;
    }

    public function setTauxPourMille(string $taux_pour_mille): static
    {
        $this->taux_pour_mille = $taux_pour_mille;

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

    public function getCategorie(): ?CrimeCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?CrimeCategorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
