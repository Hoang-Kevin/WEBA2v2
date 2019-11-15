<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivitesRepository")
 */
class Activites
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cout;

    /**
     * @ORM\Column(type="boolean")
     */
    private $recurrence;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valide;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnes", inversedBy="activites")
     */
    private $id_personne;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voters", mappedBy="id_activite")
     */
    private $voters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscrires", mappedBy="id_activite")
     */
    private $inscrires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photos", mappedBy="id_activite")
     */
    private $photos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    public function __construct()
    {
        $this->voters = new ArrayCollection();
        $this->inscrires = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date->format('Y-m-d');

        return $this;
    }

    public function getCout(): ?bool
    {
        return $this->cout;
    }

    public function setCout(bool $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getRecurrence(): ?bool
    {
        return $this->recurrence;
    }

    public function setRecurrence(bool $recurrence): self
    {
        $this->recurrence = $recurrence;

        return $this;
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
     * @return Collection|Voters[]
     */
    public function getVoters(): Collection
    {
        return $this->voters;
    }

    public function addVoter(Voters $voter): self
    {
        if (!$this->voters->contains($voter)) {
            $this->voters[] = $voter;
            $voter->setIdActivite($this);
        }

        return $this;
    }

    public function removeVoter(Voters $voter): self
    {
        if ($this->voters->contains($voter)) {
            $this->voters->removeElement($voter);
            // set the owning side to null (unless already changed)
            if ($voter->getIdActivite() === $this) {
                $voter->setIdActivite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inscrires[]
     */
    public function getInscrires(): Collection
    {
        return $this->inscrires;
    }

    public function addInscrire(Inscrires $inscrire): self
    {
        if (!$this->inscrires->contains($inscrire)) {
            $this->inscrires[] = $inscrire;
            $inscrire->setIdActivite($this);
        }

        return $this;
    }

    public function removeInscrire(Inscrires $inscrire): self
    {
        if ($this->inscrires->contains($inscrire)) {
            $this->inscrires->removeElement($inscrire);
            // set the owning side to null (unless already changed)
            if ($inscrire->getIdActivite() === $this) {
                $inscrire->setIdActivite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Photos[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photos $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setIdActivite($this);
        }

        return $this;
    }

    public function removePhoto(Photos $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getIdActivite() === $this) {
                $photo->setIdActivite(null);
            }
        }

        return $this;
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
}
