<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbonnementType
 *
 * @ORM\Table(name="abonnement_type")
 * @ORM\Entity
 */
class AbonnementType
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="id_abonnement", type="integer", nullable=false)
     */
    private $idAbonnement;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIdAbonnement(): ?int
    {
        return $this->idAbonnement;
    }

    public function setIdAbonnement(int $idAbonnement): static
    {
        $this->idAbonnement = $idAbonnement;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }


}
