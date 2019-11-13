<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockersRepository")
 */
class Stockers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produits", inversedBy="stockers")
     */
    private $id_produit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commandes", inversedBy="stockers")
     */
    private $id_commande;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?Produits
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produits $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getIdCommande(): ?Commandes
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commandes $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
