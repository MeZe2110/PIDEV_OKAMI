<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("Stock")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "Name is required") ]
    #[Groups("Stock")]
    private ?string $nomst = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "description is required") ]
    #[Groups("Stock")]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[GreaterThan(value: "today", message: "La date d'expiration doit être supérieure à la date actuelle")]
    #[Groups("Stock")]
    private ?\DateTimeInterface $dateexpirationst = null;


    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[Assert\NotBlank (message: "stockcat is required") ]
    #[Groups("Stock")]
    private ?Stockcategories $stockcat = null;

    #[ORM\Column]
    #[Assert\NotBlank (message: "quantites is required") ]
    #[Assert\Positive(message:"quantite doit etre positive !")]
    #[Groups("Stock")]
    private ?int $quantites = null;
    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomst(): ?string
    {
        return $this->nomst;
    }

    public function setNomst(string $nomst): self
    {
        $this->nomst = $nomst;

        return $this;
    }

    public function getdescription(): ?string
    {
        return $this->description;
    }

    public function setdescription(string $description): self
    {
        $this->description= $description;

        return $this;
    }
    public function isExpired(): bool
    {
      return $this->dateexpirationst <= new \DateTime();
    }
    public function getDateexpirationst(): ?\DateTimeInterface
    {
        return $this->dateexpirationst;
    }

    public function setDateexpirationst(\DateTimeInterface $dateexpirationst): self
    {
        $this->dateexpirationst = $dateexpirationst;

        return $this;
    }
    #[Groups("Stock")]
    public function getStockcat(): ?stockcategories
    {
        return $this->stockcat;
    }

    public function setStockcat(?stockcategories $stockcat): self
    {
        $this->stockcat = $stockcat;

        return $this;
    }

    public function getQuantites(): ?int
    {
        return $this->quantites;
    }

    public function setQuantites(int $quantites): self
    {
        $this->quantites = $quantites;

        return $this;
    }

    
}
