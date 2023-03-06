<?php

namespace App\Entity;

use App\Repository\CategoriesvehiculesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/////
#[ORM\Entity(repositoryClass: CategoriesvehiculesRepository::class)]
class Categoriesvehicules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("students")]
    private ?int $id ;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "type is required") ]
    #[Groups("students")]
    private ?string $typecatv ;

    #[ORM\OneToMany(mappedBy: 'catv', targetEntity: Vehicules::class)]
    private Collection $vehicules;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypecatv(): ?string
    {
        return $this->typecatv;
    }

    public function setTypecatv(?string $typecatv): self
    {
        $this->typecatv = $typecatv;

        return $this;
    }

    /**
     * @return Collection<int, Vehicules>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicules $vehicule): self
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setCatv($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicules $vehicule): self
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getCatv() === $this) {
                $vehicule->setCatv(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->typecatv;
 
   }
   
}
