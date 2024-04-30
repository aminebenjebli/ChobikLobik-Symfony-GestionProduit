<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZoneLiv
 *
 * @ORM\Table(name="zone_liv")
 * @ORM\Entity
 */
class ZoneLiv
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
     * @ORM\Column(name="zone", type="string", length=255, nullable=false)
     */
    private $zone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(string $zone): static
    {
        $this->zone = $zone;

        return $this;
    }


}
