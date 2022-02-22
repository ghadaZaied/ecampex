<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, cascade={"persist", "remove"})
     */
    private $produit;


   // private $Commande;

    public function getId(): ?int
    {
        return $this->id;
    }

   /* public function getCommande(): ?Produit
    {
        return $this->Commande;
    }

    public function setCommande(?Produit $Commande): self
    {
        $this->Commande = $Commande;

        return $this;
    }*/

   public function getProduit(): ?Produit
   {
       return $this->produit;
   }

   public function setProduit(?Produit $produit): self
   {
       $this->produit = $produit;

       return $this;
   }



}
