<?php

namespace App\Entity;

use App\Repository\RendezvousTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RendezvousTypeRepository::class)]
class RendezvousType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"Must put a type first")]
    #[Assert\Regex( pattern:'/^[a-z éèàùê&]{3,}$/i', message:'Not a valid type.' )]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'Type', targetEntity: Rendezvous::class)]
    private Collection $rendezvous;

    public function __construct()
    {
        $this->rendezvous = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Rendezvous>
     */
    public function getRendezvous(): Collection
    {
        return $this->rendezvous;
    }

    public function addRendezvou(Rendezvous $rendezvou): self
    {
        if (!$this->rendezvous->contains($rendezvou)) {
            $this->rendezvous->add($rendezvou);
            $rendezvou->setType($this);
        }

        return $this;
    }

    public function removeRendezvou(Rendezvous $rendezvou): self
    {
        if ($this->rendezvous->removeElement($rendezvou)) {
            // set the owning side to null (unless already changed)
            if ($rendezvou->getType() === $this) {
                $rendezvou->setType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->type;
    }
}
