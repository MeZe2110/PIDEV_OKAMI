<?php

namespace App\Entity;

use App\Repository\VehiculesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: VehiculesRepository::class)]
class Vehicules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "Name is required") ]
    #[Assert\Length(min:3,minMessage: "lenght min 3")]
    protected ?string $nomvh = null;

    #[ORM\Column]
     
    private ?bool $dispovh = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "etat is required") ]
    private ?string $etatvh = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "the description is required") ]
    private ?string $descvh = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categoriesvehicules $catv = null;

   
    #[ORM\Column(name: "imagesvh", type: "string", length: 255)]
    private $imagesvh;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomvh(): ?string
    {
        return $this->nomvh;
    }

    public function setNomvh(string $nomvh): self
    {
        $this->nomvh = $nomvh;

        return $this;
    }

    public function isDispovh(): ?bool
    {
        return $this->dispovh;
    }

    public function setDispovh(bool $dispovh): self
    {
        $this->dispovh = $dispovh;

        return $this;
    }

    public function getEtatvh(): ?string
    {
        return $this->etatvh;
    }

    public function setEtatvh(string $etatvh): self
    {
        $this->etatvh = $etatvh;

        return $this;
    }

    public function getDescvh(): ?string
    {
        return $this->descvh;
    }

    public function setDescvh(string $descvh): self
    {
        $this->descvh = $descvh;

        return $this;
    }

    public function getCatv(): ?Categoriesvehicules
    {
        return $this->catv;
    }

    public function setCatv(?Categoriesvehicules $catv): self
    {
        $this->catv = $catv;

        return $this;
    }

    public function getImagesvh(): ?string
    {
        return $this->imagesvh;
    }

    public function setImagesvh(string $imagesvh): self
    {
        $this->imagesvh = $imagesvh;

        return $this;
    }
}
