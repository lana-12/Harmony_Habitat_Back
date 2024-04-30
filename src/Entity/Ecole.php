<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EcoleRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EcoleRepository::class)]
#[ApiResource]
class Ecole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('read')]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    #[Groups('read')]
    private ?string $nom_ecole = null;

    #[ORM\Column(length: 80)]
    #[Groups('read')]
    private ?string $nom_commune_ecole = null;

    #[ORM\Column(length: 12)]
    #[Groups('read')]
    private ?string $numero_uai_ecole = null;

    #[ORM\Column(length: 255)]
    #[Groups('read')]
    private ?string $rue_adresse_ecole = null;

    #[ORM\Column(length: 10)]
    #[Groups('read')]
    private ?string $code_postal_adresse_ecole = null;

    #[ORM\Column(length: 80, nullable: true)]
    #[Groups('read')]
    private ?string $ville_adresse_ecole = null;

    #[ORM\ManyToOne(inversedBy: 'ecoles')]
    #[Groups('read')]
    private ?EcoleCategorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'ecoles')]
    #[Groups('read')]
    private ?PositionGPS $position = null;

    #[ORM\ManyToOne(inversedBy: 'ecoles')]
    #[Groups('read')]
    private ?Commune $commune = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEcole(): ?string
    {
        return $this->nom_ecole;
    }

    public function setNomEcole(string $nom_ecole): static
    {
        $this->nom_ecole = $nom_ecole;

        return $this;
    }

    public function getNomCommuneEcole(): ?string
    {
        return $this->nom_commune_ecole;
    }

    public function setNomCommuneEcole(string $nom_commune_ecole): static
    {
        $this->nom_commune_ecole = $nom_commune_ecole;

        return $this;
    }

    public function getNumeroUaiEcole(): ?string
    {
        return $this->numero_uai_ecole;
    }

    public function setNumeroUaiEcole(string $numero_uai_ecole): static
    {
        $this->numero_uai_ecole = $numero_uai_ecole;

        return $this;
    }

    public function getRueAdresseEcole(): ?string
    {
        return $this->rue_adresse_ecole;
    }

    public function setRueAdresseEcole(string $rue_adresse_ecole): static
    {
        $this->rue_adresse_ecole = $rue_adresse_ecole;

        return $this;
    }

    public function getCodePostalAdresseEcole(): ?string
    {
        return $this->code_postal_adresse_ecole;
    }

    public function setCodePostalAdresseEcole(string $code_postal_adresse_ecole): static
    {
        $this->code_postal_adresse_ecole = $code_postal_adresse_ecole;

        return $this;
    }

    public function getVilleAdresseEcole(): ?string
    {
        return $this->ville_adresse_ecole;
    }

    public function setVilleAdresseEcole(?string $ville_adresse_ecole): static
    {
        $this->ville_adresse_ecole = $ville_adresse_ecole;

        return $this;
    }

    public function getCategorie(): ?EcoleCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?EcoleCategorie $categorie): static
    {
        $this->categorie = $categorie;

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
