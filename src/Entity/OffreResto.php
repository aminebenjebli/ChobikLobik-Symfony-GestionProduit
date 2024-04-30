<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * OffreResto
 *
 * @ORM\Table(name="offre_resto", indexes={@ORM\Index(name="fk_plat", columns={"id_plat"}), @ORM\Index(name="fk_gerant", columns={"id_resto"})})
 * @ORM\Entity
 */
class OffreResto
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
     * @ORM\Column(name="pourcentage", type="integer", nullable=false)
     * @Assert\NotBlank(message="Veuillez saisir un pourcentage.")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      notInRangeMessage = "Le pourcentage doit être compris entre {{ min }} et {{ max }}.",
     * ) 
     */
    private $pourcentage;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)

     */
    private $dateFin;

    /**
     * @var float
     *
     * @ORM\Column(name="new_price", type="float", precision=10, scale=0, nullable=false)
     */
    private $newPrice;

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
     * @var \Plat
     *
     * @ORM\ManyToOne(targetEntity="Plat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_plat", referencedColumnName="id_plat")
     * })
     */
    private $idPlat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    public function setPourcentage(int $pourcentage): static
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): static
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

    public function getNewPrice(): ?float
    {
        return $this->newPrice;
    }

    public function setNewPrice(float $newPrice): static
    {
        $this->newPrice = $newPrice;

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

    public function getIdPlat(): ?Plat
    {
        return $this->idPlat;
    }

    public function setIdPlat(?Plat $idPlat): static
    {
        $this->idPlat = $idPlat;

        return $this;
    }
/**
     * @ORM\PreRemove
     */
    public function preRemove(LifecycleEventArgs $args): void
    {
        $entityManager = $args->getEntityManager();

        // Remove the OffreResto entity
        $entityManager->remove($this);
    }

}
