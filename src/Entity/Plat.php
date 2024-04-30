<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Plat
 *
 * @ORM\Table(name="plat", indexes={@ORM\Index(name="fk_gerantiid", columns={"id_restaurant"}), @ORM\Index(name="fk_categorieP", columns={"id_category"})})
 * @ORM\Entity
 */
class Plat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_plat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPlat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez saisir le nom")
     * @Assert\Length(
     *     min=3,
     *     minMessage="Votre nom doit contenir au moins {{ limit }} caractères.",
     * )
     * @Assert\Regex(
     *     pattern="/^[^0-9]+$/",
     *     message="Le nom ne doit pas contenir de chiffres."
     * )
     * @Groups("Produit")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez saisir une description") 
     *@Assert\Length(
     * min=7,
     *  max=100,
     *  minMessage="La description doit contenir au moins {{ limit }} caractères.",
     * maxMessage="La description ne peut pas contenir plus de {{ limit }} caractères."
     * )
     * @Groups("Produit")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank(message="Veuillez saisir le prix")
     * @Assert\GreaterThan(value=0, message="Le prix doit être supérieur à 0.")
     * @Groups("Produit")
 */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     * * @Assert\NotBlank(message="Veuillez sélectionner une image.")
     * @Assert\File(
 *     maxSize="5M",
 *     mimeTypes={"image/jpeg", "image/png"},
 *     maxSizeMessage="La taille de l'image ne doit pas dépasser 5Mo.",
 *     mimeTypesMessage="Seules les images au format JPEG ou PNG sont autorisées."
 * )
     */
    private $image;

    /**
 * @var string|null
 *
 * @ORM\Column(name="qrCode", type="string", nullable=true)
 * @Assert\NotBlank(message="Veuillez générer le code QR")
 */
private $qrCode;

public function getQrCode(): ?string
{
    return $this->qrCode;
}

public function setQrCode(?string $qrCode): self
{
    $this->qrCode = $qrCode;

    return $this;
}
    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $idCategory;

    /**
     * @var \Gerant
     *
     * @ORM\ManyToOne(targetEntity="Gerant")
     * @ORM\JoinColumn(name="id_restaurant", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    
    private $idRestaurant;

    public function getIdPlat(): ?int
    {
        return $this->idPlat;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->idCategory;
    }

    public function setIdCategory(?Category $idCategory): static
    {
        $this->idCategory= $idCategory;

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


}
