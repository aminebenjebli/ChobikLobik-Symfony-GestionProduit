<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement", indexes={@ORM\Index(name="fk_abonnement", columns={"abonnement_type_id"}), @ORM\Index(name="fk_gerantt", columns={"id_resto"})})
 * @ORM\Entity
 */
class Abonnement
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
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=false)
     */
    private $dateFin;

    /**
     * @var \Gerant
     *
     * @ORM\ManyToOne(targetEntity="Gerant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_resto", referencedColumnName="id")
     * })
     */
    private $idResto;

    /**
     * @var \AbonnementType
     *
     * @ORM\ManyToOne(targetEntity="AbonnementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abonnement_type_id", referencedColumnName="id")
     * })
     */
    private $abonnementType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

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

    public function getAbonnementType(): ?AbonnementType
    {
        return $this->abonnementType;
    }

    public function setAbonnementType(?AbonnementType $abonnementType): static
    {
        $this->abonnementType = $abonnementType;

        return $this;
    }


}
