<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandesRepository")
 */
class Commandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valide;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnes", inversedBy="commandes")
     */
    private $id_personne;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stockers", mappedBy="id_commande")
     */
    private $stockers;

    public function __construct()
    {
        $this->stockers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getIdPersonne(): ?Personnes
    {
        return $this->id_personne;
    }

    public function setIdPersonne(?Personnes $id_personne): self
    {
        $this->id_personne = $id_personne;

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
            $stocker->setIdCommande($this);
        }

        return $this;
    }

    public function removeStocker(Stockers $stocker): self
    {
        if ($this->stockers->contains($stocker)) {
            $this->stockers->removeElement($stocker);
            // set the owning side to null (unless already changed)
            if ($stocker->getIdCommande() === $this) {
                $stocker->setIdCommande(null);
            }
        }

        return $this;
    }
}
