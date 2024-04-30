<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Features
 *
 * @ORM\Table(name="features", indexes={@ORM\Index(name="fk_abntype", columns={"id_abonnement"})})
 * @ORM\Entity
 */
class Features
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
     * @ORM\Column(name="feature", type="string", length=255, nullable=false)
     */
    private $feature;

    /**
     * @var \AbonnementType
     *
     * @ORM\ManyToOne(targetEntity="AbonnementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_abonnement", referencedColumnName="id")
     * })
     */
    private $idAbonnement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeature(): ?string
    {
        return $this->feature;
    }

    public function setFeature(string $feature): static
    {
        $this->feature = $feature;

        return $this;
    }

    public function getIdAbonnement(): ?AbonnementType
    {
        return $this->idAbonnement;
    }

    public function setIdAbonnement(?AbonnementType $idAbonnement): static
    {
        $this->idAbonnement = $idAbonnement;

        return $this;
    }


}
