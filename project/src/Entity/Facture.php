<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="fk_facture_fournisseur1_idx", columns={"fournisseur_fournisseur_id"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="fature_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fatureId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_facture", type="date", nullable=true)
     */
    private $dateFacture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_facture", type="string", length=45, nullable=true)
     */
    private $numeroFacture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="designation", type="string", length=45, nullable=true)
     */
    private $designation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_produit", type="string", length=45, nullable=true)
     */
    private $codeProduit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="quantité", type="string", length=45, nullable=true)
     */
    private $quantité;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prix_unitaire", type="string", length=45, nullable=true)
     */
    private $prixUnitaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant HT", type="string", length=45, nullable=true)
     */
    private $montantHt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remise", type="string", length=45, nullable=true)
     */
    private $remise;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TVA", type="string", length=45, nullable=true)
     */
    private $tva;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant TTC", type="string", length=45, nullable=true)
     */
    private $montantTtc;

    /**
     * @var \Fournisseur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fournisseur_fournisseur_id", referencedColumnName="fournisseur_id")
     * })
     */
    private $fournisseurFournisseur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="factureFature")
     */
    private $userUser = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userUser = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
