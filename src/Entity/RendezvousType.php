<?php

namespace App\Entity;

use App\Repository\RendezvousTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RendezvousTypeRepository::class)]
class RendezvousType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["rendezvous", "rendezvousType"])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex( pattern:'/^[a-z éèàùê&-_]{3,}$/i', message:'Type invalide, doit contenir au moins 3 caractères.' )]
    #[Groups(["rendezvous", "rendezvousType"])]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'Type', targetEntity: Rendezvous::class)]
    #[Groups("rendezvousType")]
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
