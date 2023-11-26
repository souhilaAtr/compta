<?php
// src/Entity/Secteur.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecteurRepository")
 * @ORM\Table(name="secteur")
 */
class Secteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(name="nom_secteur", type="string", length=45, nullable=true)
     */
    private $nomSecteur;

    /**
     * @ORM\Column(name="code_secteur", type="string", length=45, nullable=true)
     */
    private $codeSecteur;

    /**
     * @ORM\ManyToMany(targetEntity="Fournisseur", mappedBy="secteurSecteur")
     */
    private $fournisseurFournisseur;

    public function __construct()
    {
        $this->fournisseurFournisseur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSecteur(): ?string
    {
        return $this->nomSecteur;
    }

    public function setNomSecteur(?string $nomSecteur): self
    {
        $this->nomSecteur = $nomSecteur;

        return $this;
    }

    public function getCodeSecteur(): ?string
    {
        return $this->codeSecteur;
    }

    public function setCodeSecteur(?string $codeSecteur): self
    {
        $this->codeSecteur = $codeSecteur;

        return $this;
    }

    /**
     * @return Collection|Fournisseur[]
     */
    public function getFournisseurFournisseur(): Collection
    {
        return $this->fournisseurFournisseur;
    }

    public function addFournisseurFournisseur(Fournisseur $fournisseurFournisseur): self
    {
        if (!$this->fournisseurFournisseur->contains($fournisseurFournisseur)) {
            $this->fournisseurFournisseur[] = $fournisseurFournisseur;
        }

        return $this;
    }

    public function removeFournisseurFournisseur(Fournisseur $fournisseurFournisseur): self
    {
        $this->fournisseurFournisseur->removeElement($fournisseurFournisseur);

        return $this;
    }
}
