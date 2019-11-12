<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoterRepository")
 */
class Voter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activite", inversedBy="voters")
     */
    private $id_activite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_personne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdActivite(): ?Activite
    {
        return $this->id_activite;
    }

    public function setIdActivite(?Activite $id_activite): self
    {
        $this->id_activite = $id_activite;

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
}
