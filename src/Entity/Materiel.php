<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_materiel;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_materiel;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_materiel;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation_materiel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMateriel(): ?string
    {
        return $this->nom_materiel;
    }

    public function setNomMateriel(string $nom_materiel): self
    {
        $this->nom_materiel = $nom_materiel;

        return $this;
    }

    public function getPrixMateriel(): ?float
    {
        return $this->prix_materiel;
    }

    public function setPrixMateriel(float $prix_materiel): self
    {
        $this->prix_materiel = $prix_materiel;

        return $this;
    }

    public function getQuantiteMateriel(): ?int
    {
        return $this->quantite_materiel;
    }

    public function setQuantiteMateriel(int $quantite_materiel): self
    {
        $this->quantite_materiel = $quantite_materiel;

        return $this;
    }

    public function getDateCreationMateriel(): ?\DateTimeInterface
    {
        return $this->date_creation_materiel;
    }

    public function setDateCreationMateriel(\DateTimeInterface $date_creation_materiel): self
    {
        $this->date_creation_materiel = $date_creation_materiel;

        return $this;
    }

}
