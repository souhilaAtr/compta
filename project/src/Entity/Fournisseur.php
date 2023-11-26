<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="fournisseur_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fournisseurId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=45, nullable=true)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=45, nullable=true)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="siren", type="string", length=45, nullable=true)
     */
    private $siren;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_entreprise", type="string", length=45, nullable=true)
     */
    private $nomEntreprise;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Secteur", inversedBy="fournisseurFournisseur")
     * @ORM\JoinTable(name="fournisseur_has_secteur",
     *   joinColumns={
     *     @ORM\JoinColumn(name="fournisseur_fournisseur_id", referencedColumnName="fournisseur_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="secteur_secteur_id", referencedColumnName="secteur_id")
     *   }
     * )
     */
    private $secteurSecteur = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->secteurSecteur = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
