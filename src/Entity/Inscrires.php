<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriresRepository")
 */
class Inscrires
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activites", inversedBy="inscrires")
     */
    private $id_activite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnes", inversedBy="inscrires")
     */
    private $id_personne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdActivite(): ?Activites
    {
        return $this->id_activite;
    }

    public function setIdActivite(?Activites $id_activite): self
    {
        $this->id_activite = $id_activite;

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
}
