<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentersRepository")
 */
class Commenters
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Photos", inversedBy="commenters")
     */
    private $id_photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnes", inversedBy="commenters")
     */
    private $id_personne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPhoto(): ?Photos
    {
        return $this->id_photo;
    }

    public function setIdPhoto(?Photos $id_photo): self
    {
        $this->id_photo = $id_photo;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
