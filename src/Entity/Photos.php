<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotosRepository")
 */
class Photos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activites", inversedBy="photos")
     */
    private $id_activite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnes", inversedBy="photos")
     */
    private $id_personne;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commenters", mappedBy="id_photo")
     */
    private $commenters;

    public function __construct()
    {
        $this->commenters = new ArrayCollection();
    }

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

    /**
     * @return Collection|Commenters[]
     */
    public function getCommenters(): Collection
    {
        return $this->commenters;
    }

    public function addCommenter(Commenters $commenter): self
    {
        if (!$this->commenters->contains($commenter)) {
            $this->commenters[] = $commenter;
            $commenter->setIdPhoto($this);
        }

        return $this;
    }

    public function removeCommenter(Commenters $commenter): self
    {
        if ($this->commenters->contains($commenter)) {
            $this->commenters->removeElement($commenter);
            // set the owning side to null (unless already changed)
            if ($commenter->getIdPhoto() === $this) {
                $commenter->setIdPhoto(null);
            }
        }

        return $this;
    }
}
