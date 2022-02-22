<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="type produit is required")
     */
    private $type_produit;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="prix is required")
     */
    private $prix_produit;

    /**
     * @ORM\Column(type="date")
     ** @Assert\NotBlank(message="date expo is required")
     */
    private $date_expo;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="date fin is required")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="disponibilité is required")
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="type action is required")
     */
    private $type_action;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="image is required")
     */
    private $imgproduit;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeProduit(): ?string
    {
        return $this->type_produit;
    }

    public function setTypeProduit(string $type_produit): self
    {
        $this->type_produit = $type_produit;

        return $this;
    }

    public function getPrixProduit(): ?string
    {
        return $this->prix_produit;
    }

    public function setPrixProduit(string $prix_produit): self
    {
        $this->prix_produit = $prix_produit;

        return $this;
    }

    public function getImgproduit(): ?string
    {
        return $this->imgproduit;
    }

    public function setImgproduit(string $imgproduit): self
    {
        $this->imgproduit = $imgproduit;

        return $this;
    }



    public function getDateExpo(): ?\DateTimeInterface
    {
        return $this->date_expo;
    }

    public function setDateExpo(\DateTimeInterface $date_expo): self
    {
        $this->date_expo = $date_expo;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getTypeAction(): ?string
    {
        return $this->type_action;
    }

    public function setTypeAction(string $type_action): self
    {
        $this->type_action = $type_action;

        return $this;
    }

    public function __toString()
    {
        return $this->getTypeProduit();
    }




}
