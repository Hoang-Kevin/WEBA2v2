<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnesRepository")
 */
class Personnes
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $campus;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *      pattern="/^\w.+((@viacesi\.fr)|(@cesi\.fr))/",
     *      message="Your mail address is incorrect"
     * 
     * )
     */
    private $adressemail;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\Regex(
     *      pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,}/",
     *      message="Your password must contain 1 uppercase letter, 1 lowercase, 1 number and must contain more than 8 characters"
     * 
     * )
     */
    private $motdepasse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles", inversedBy="personnes")
     */
    private $id_role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commandes", mappedBy="id_personne")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activites", mappedBy="id_personne")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voters", mappedBy="id_personne")
     */
    private $voters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscrires", mappedBy="id_personne")
     */
    private $inscrires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photos", mappedBy="id_personne")
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commenters", mappedBy="id_personne")
     */
    private $commenters;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->voters = new ArrayCollection();
        $this->inscrires = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->commenters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getCampus(): ?string
    {
        return $this->campus;
    }

    public function setCampus(string $campus): self
    {
        $this->campus = $campus;

        return $this;
    }

    public function getAdressemail(): ?string
    {
        return $this->adressemail;
    }

    public function setAdressemail(string $adressemail): self
    {
        $this->adressemail = $adressemail;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getIdRole(): ?Roles
    {
        return $this->id_role;
    }

    public function setIdRole(?Roles $id_role): self
    {
        $this->id_role = $id_role;

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setIdPersonne($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getIdPersonne() === $this) {
                $commande->setIdPersonne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activites[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activites $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setIdPersonne($this);
        }

        return $this;
    }

    public function removeActivite(Activites $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getIdPersonne() === $this) {
                $activite->setIdPersonne(null);
            }
        }

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
            $voter->setIdPersonne($this);
        }

        return $this;
    }

    public function removeVoter(Voters $voter): self
    {
        if ($this->voters->contains($voter)) {
            $this->voters->removeElement($voter);
            // set the owning side to null (unless already changed)
            if ($voter->getIdPersonne() === $this) {
                $voter->setIdPersonne(null);
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
            $inscrire->setIdPersonne($this);
        }

        return $this;
    }

    public function removeInscrire(Inscrires $inscrire): self
    {
        if ($this->inscrires->contains($inscrire)) {
            $this->inscrires->removeElement($inscrire);
            // set the owning side to null (unless already changed)
            if ($inscrire->getIdPersonne() === $this) {
                $inscrire->setIdPersonne(null);
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
            $photo->setIdPersonne($this);
        }

        return $this;
    }

    public function removePhoto(Photos $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getIdPersonne() === $this) {
                $photo->setIdPersonne(null);
            }
        }

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
            $commenter->setIdPersonne($this);
        }

        return $this;
    }

    public function removeCommenter(Commenters $commenter): self
    {
        if ($this->commenters->contains($commenter)) {
            $this->commenters->removeElement($commenter);
            // set the owning side to null (unless already changed)
            if ($commenter->getIdPersonne() === $this) {
                $commenter->setIdPersonne(null);
            }
        }

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }
}
