<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomst = null;

    #[ORM\Column(length: 255)]
    private ?string $etatst = null;

    #[ORM\Column(length: 255)]
    private ?string $dateexpirationst = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    private ?stockcategories $stockcat = null;


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

    public function getEtatst(): ?string
    {
        return $this->etatst;
    }

    public function setEtatst(string $etatst): self
    {
        $this->etatst = $etatst;

        return $this;
    }

    public function getDateexpirationst(): ?string
    {
        return $this->dateexpirationst;
    }

    public function setDateexpirationst(string $dateexpirationst): self
    {
        $this->dateexpirationst = $dateexpirationst;

        return $this;
    }

    public function getStockcat(): ?stockcategories
    {
        return $this->stockcat;
    }

    public function setStockcat(?stockcategories $stockcat): self
    {
        $this->stockcat = $stockcat;

        return $this;
    }

    
}
