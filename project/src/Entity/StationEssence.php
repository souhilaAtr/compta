<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StationEssence
 *
 * @ORM\Table(name="station_essence", indexes={@ORM\Index(name="fk_station_essence_secteur1_idx", columns={"secteur_secteur_id"})})
 * @ORM\Entity
 */
class StationEssence
{
    /**
     * @var int
     *
     * @ORM\Column(name="station_essence_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $stationEssenceId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_station", type="string", length=45, nullable=true)
     */
    private $nomStation;

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
     * @var \Secteur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Secteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="secteur_secteur_id", referencedColumnName="secteur_id")
     * })
     */
    private $secteurSecteur;


}
