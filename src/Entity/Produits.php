<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsRepository")
 */
class Produits
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="produits")
     */
    private $id_categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stockers", mappedBy="id_produit")
     */
    private $stockers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function __construct()
    {
        $this->stockers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdCategorie(): ?Categories
    {
        return $this->id_categorie;
    }

    public function setIdCategorie(?Categories $id_categorie): self
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    /**
     * @return Collection|Stockers[]
     */
    public function getStockers(): Collection
    {
        return $this->stockers;
    }

    public function addStocker(Stockers $stocker): self
    {
        if (!$this->stockers->contains($stocker)) {
            $this->stockers[] = $stocker;
            $stocker->setIdProduit($this);
        }

        return $this;
    }

    public function removeStocker(Stockers $stocker): self
    {
        if ($this->stockers->contains($stocker)) {
            $this->stockers->removeElement($stocker);
            // set the owning side to null (unless already changed)
            if ($stocker->getIdProduit() === $this) {
                $stocker->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
