<?php

namespace App\Entity;

use App\Repository\StockcategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockcategoriesRepository::class)]
class Stockcategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "Name is required") ]
    private ?string $typecat = null;

    #[ORM\OneToMany(mappedBy: 'stockcat', targetEntity: Stock::class)]
    private Collection $stocks;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->typecat;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypecat(): ?string
    {
        return $this->typecat;
    }

    public function setTypecat(string $typecat): self
    {
        $this->typecat = $typecat;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setStockcat($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getStockcat() === $this) {
                $stock->setStockcat(null);
            }
        }

        return $this;
    }
}
