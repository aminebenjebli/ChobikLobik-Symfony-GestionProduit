<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Table
 *
 * @ORM\Table(name="table", indexes={@ORM\Index(name="fk_gert", columns={"id_resto"})})
 * @ORM\Entity
 */
class Table
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
     * @ORM\Column(name="nombre_p", type="integer", nullable=false)
     */
    private $nombreP;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

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

    public function getNombreP(): ?int
    {
        return $this->nombreP;
    }

    public function setNombreP(int $nombreP): static
    {
        $this->nombreP = $nombreP;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
