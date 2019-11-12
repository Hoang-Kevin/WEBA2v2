<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteRepository")
 */
class Activite
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_personne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Photo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voter", mappedBy="id_activite")
     */
    private $voters;

    public function __construct()
    {
        $this->voters = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getIdPersonne(): ?Personne
    {
        return $this->id_personne;
    }

    public function setIdPersonne(?Personne $id_personne): self
    {
        $this->id_personne = $id_personne;

        return $this;
    }

    public function getIdPhoto(): ?Photo
    {
        return $this->id_photo;
    }

    public function setIdPhoto(?Photo $id_photo): self
    {
        $this->id_photo = $id_photo;

        return $this;
    }

    /**
     * @return Collection|Voter[]
     */
    public function getVoters(): Collection
    {
        return $this->voters;
    }

    public function addVoter(Voter $voter): self
    {
        if (!$this->voters->contains($voter)) {
            $this->voters[] = $voter;
            $voter->setIdActivite($this);
        }

        return $this;
    }

    public function removeVoter(Voter $voter): self
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
}
