<?php

namespace App\Entity;

use App\Repository\CategoriesequipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriesequipementRepository::class)]
class Categoriesequipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"name is required")]
    #[Groups("Equipement")]
    private ?string $nomcate = null;

    #[ORM\OneToMany(mappedBy: 'cate', targetEntity: Equipement::class)]

    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcate(): ?string
    {
        return $this->nomcate;
    }

    public function setNomcate(string $nomcate): self
    {
        $this->nomcate = $nomcate;

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setCate($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getCate() === $this) {
                $equipement->setCate(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nomcate;
    }
}
