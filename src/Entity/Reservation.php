<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_gerantiddd", columns={"id_restaurant"}), @ORM\Index(name="fk_table", columns={"id_table"}), @ORM\Index(name="fk_clientidd", columns={"id_client"})})
 * @ORM\Entity
 */
class Reservation
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
     * @ORM\Column(name="date_reservation", type="date", nullable=false)
     */
    private $dateReservation;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;

    /**
     * @var \Gerant
     *
     * @ORM\ManyToOne(targetEntity="Gerant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_restaurant", referencedColumnName="id")
     * })
     */
    private $idRestaurant;

    /**
     * @var \Table
     *
     * @ORM\ManyToOne(targetEntity="Table")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_table", referencedColumnName="id")
     * })
     */
    private $idTable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): static
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): static
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdRestaurant(): ?Gerant
    {
        return $this->idRestaurant;
    }

    public function setIdRestaurant(?Gerant $idRestaurant): static
    {
        $this->idRestaurant = $idRestaurant;

        return $this;
    }

    public function getIdTable(): ?Table
    {
        return $this->idTable;
    }

    public function setIdTable(?Table $idTable): static
    {
        $this->idTable = $idTable;

        return $this;
    }


}
