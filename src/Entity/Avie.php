<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Avie
 *
 * @ORM\Table(name="avie")
 * @ORM\Entity
 */
class Avie
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
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="etoile", type="float", precision=10, scale=0, nullable=false)
     */
    private $etoile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEtoile(): ?float
    {
        return $this->etoile;
    }

    public function setEtoile(float $etoile): static
    {
        $this->etoile = $etoile;

        return $this;
    }


}
