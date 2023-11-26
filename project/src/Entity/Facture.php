<?php

// src/Entity/Facture.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 * @ORM\Table(name="facture")
 */
class Facture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="facture_id", type="integer", nullable=false)
     */
    private $factureId;

    /**
     * @ORM\Column(name="date_facture", type="date", nullable=true)
     */
    private $dateFacture;

    /**
     * @ORM\Column(name="numero_facture", type="string", length=45, nullable=true)
     */
    private $numeroFacture;

    /**
     * @ORM\Column(name="designation", type="string", length=45, nullable=true)
     */
    private $designation;

    /**
     * @ORM\Column(name="code_produit", type="string", length=45, nullable=true)
     */
    private $codeProduit;

    /**
     * @ORM\Column(name="quantite", type="string", length=45, nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(name="prix_unitaire", type="string", length=45, nullable=true)
     */
    private $prixUnitaire;

    /**
     * @ORM\Column(name="montantHT", type="string", length=45, nullable=true)
     */
    private $montantHT;

    /**
     * @ORM\Column(name="remise", type="string", length=45, nullable=true)
     */
    private $remise;

    /**
     * @ORM\Column(name="tva", type="string", length=45, nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(name="montantttc", type="string", length=45, nullable=true)
     */
    private $montantTTC;
    
/**
 * @ORM\ManyToOne(targetEntity="Fournisseur")
 * @ORM\JoinColumn(name="fournisseur_fournisseur_id", referencedColumnName="fournisseur_id", nullable=false)
 */
private $fournisseur;

    

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="factureFacture")
     * @ORM\JoinTable(name="user_has_facture",
     *   joinColumns={
     *     @ORM\JoinColumn(name="facture_facture_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    // Getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFactureId(): ?int
    {
        return $this->factureId;
    }

    public function setFactureId(?int $factureId): self
    {
        $this->factureId = $factureId;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(?\DateTimeInterface $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    public function getNumeroFacture(): ?string
    {
        return $this->numeroFacture;
    }

    public function setNumeroFacture(?string $numeroFacture): self
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getCodeProduit(): ?string
    {
        return $this->codeProduit;
    }

    public function setCodeProduit(?string $codeProduit): self
    {
        $this->codeProduit = $codeProduit;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(?string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?string
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(?string $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getMontantHT(): ?string
    {
        return $this->montantHT;
    }

    public function setMontantHT(?string $montantHT): self
    {
        $this->montantHT = $montantHT;

        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->remise;
    }

    public function setRemise(?string $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(?string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getMontantTTC(): ?string
    {
        return $this->montantTTC;
    }

    public function setMontantTTC(?string $montantTTC): self
    {
        $this->montantTTC = $montantTTC;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}
