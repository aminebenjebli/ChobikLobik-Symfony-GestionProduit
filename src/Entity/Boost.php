<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Boost
 *
 * @ORM\Table(name="boost", indexes={@ORM\Index(name="fk_offre", columns={"id_offre_plat"}), @ORM\Index(name="fk_abonnementtp", columns={"sub_id"}), @ORM\Index(name="fk_gerant1", columns={"id_resto"})})
 * @ORM\Entity
 */
class Boost
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="boost_start_date", type="datetime", nullable=false)
     */
    private $boostStartDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="boost_end_date", type="datetime", nullable=false)
     */
    private $boostEndDate;

    /**
     * @var int
     *
     * @ORM\Column(name="num_boost", type="integer", nullable=false)
     */
    private $numBoost;

    /**
     * @var \OffreResto
     *
     * @ORM\ManyToOne(targetEntity="OffreResto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_offre_plat", referencedColumnName="id")
     * })
     */
    private $idOffrePlat;

    /**
     * @var \Abonnement
     *
     * @ORM\ManyToOne(targetEntity="Abonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sub_id", referencedColumnName="abonnement_type_id")
     * })
     */
    private $sub;

    /**
     * @var \Gerant
     *
     * @ORM\ManyToOne(targetEntity="Gerant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_resto", referencedColumnName="id")
     * })
     */
    private $idResto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBoostStartDate(): ?\DateTimeInterface
    {
        return $this->boostStartDate;
    }

    public function setBoostStartDate(\DateTimeInterface $boostStartDate): static
    {
        $this->boostStartDate = $boostStartDate;

        return $this;
    }

    public function getBoostEndDate(): ?\DateTimeInterface
    {
        return $this->boostEndDate;
    }

    public function setBoostEndDate(\DateTimeInterface $boostEndDate): static
    {
        $this->boostEndDate = $boostEndDate;

        return $this;
    }

    public function getNumBoost(): ?int
    {
        return $this->numBoost;
    }

    public function setNumBoost(int $numBoost): static
    {
        $this->numBoost = $numBoost;

        return $this;
    }

    public function getIdOffrePlat(): ?OffreResto
    {
        return $this->idOffrePlat;
    }

    public function setIdOffrePlat(?OffreResto $idOffrePlat): static
    {
        $this->idOffrePlat = $idOffrePlat;

        return $this;
    }

    public function getSub(): ?Abonnement
    {
        return $this->sub;
    }

    public function setSub(?Abonnement $sub): static
    {
        $this->sub = $sub;

        return $this;
    }

    public function getIdResto(): ?Gerant
    {
        return $this->idResto;
    }

    public function setIdResto(?Gerant $idResto): static
    {
        $this->idResto = $idResto;

        return $this;
    }


}
