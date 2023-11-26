<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Secteur
 *
 * @ORM\Table(name="secteur")
 * @ORM\Entity
 */
class Secteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="secteur_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $secteurId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_secteur", type="string", length=45, nullable=true)
     */
    private $nomSecteur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_secteur", type="string", length=45, nullable=true)
     */
    private $codeSecteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Fournisseur", mappedBy="secteurSecteur")
     */
    private $fournisseurFournisseur = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fournisseurFournisseur = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
