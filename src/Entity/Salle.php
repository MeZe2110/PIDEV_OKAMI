<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["salles", "rendezvous"])]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank (message:"Numéro de la salle requis !")]
    #[Assert\Positive(message:"Numéro de la salle doit etre positive !")]
    #[Assert\LessThanOrEqual(value:10, message:"Le numéro de la salle doit être inférieur ou égal à 10")]
    #[Groups(["salles", "rendezvous"])]
    private ?int $numsa = null;

    #[ORM\Column]
    #[Assert\NotBlank (message:"Étage de la salle requis !")]
    #[Assert\GreaterThanOrEqual(value: 0, message:"L'étage de la salle doit être supérieur ou égal à 0")]
    #[Assert\LessThanOrEqual(value:6, message:"L'étage de la salle doit être inférieur ou égal à 6")]
    #[Groups(["salles", "rendezvous"])]
    private ?int $etagesa = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:"Type de la salle requis !")]
    #[Assert\Choice(choices: ['soin', 'operation'], message: 'Le type de salle doit être "soin" ou "operation".')]
    #[Groups(["salles", "rendezvous"])]
    private ?string $typesa = null;

    #[ORM\OneToMany(mappedBy: 'salle', targetEntity: Plannification::class)]
    #[Groups("salles")]
    private Collection $plannificationsalle;

    #[ORM\OneToMany(mappedBy: 'Salle', targetEntity: Rendezvous::class, orphanRemoval: true)]
    #[Groups("salles")]
    private Collection $Rendezvous;

    public function __construct()
    {
        $this->plannificationsalle = new ArrayCollection();
        $this->Rendezvous = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumsa(): ?int
    {
        return $this->numsa;
    }

    public function setNumsa(int $numsa): self
    {
        $this->numsa = $numsa;

        return $this;
    }

    public function getEtagesa(): ?int
    {
        return $this->etagesa;
    }

    public function setEtagesa(int $etagesa): self
    {
        $this->etagesa = $etagesa;

        return $this;
    }

    public function getTypesa(): ?string
    {
        return $this->typesa;
    }

    public function setTypesa(string $typesa): self
    {
        $this->typesa = $typesa;

        return $this;
    }

    /**
     * @return Collection<int, Plannification>
     */
    public function getPlannificationsalle(): Collection
    {
        return $this->plannificationsalle;
    }

    public function addPlannificationsalle(Plannification $plannificationsalle): self
    {
        if (!$this->plannificationsalle->contains($plannificationsalle)) {
            $this->plannificationsalle->add($plannificationsalle);
            $plannificationsalle->setSalle($this);
        }

        return $this;
    }

    public function removePlannificationsalle(Plannification $plannificationsalle): self
    {
        if ($this->plannificationsalle->removeElement($plannificationsalle)) {
            // set the owning side to null (unless already changed)
            if ($plannificationsalle->getSalle() === $this) {
                $plannificationsalle->setSalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rendezvous>
     */
    public function getRendezvous(): Collection
    {
        return $this->Rendezvous;
    }

    public function addRendezvou(Rendezvous $rendezvou): self
    {
        if (!$this->Rendezvous->contains($rendezvou)) {
            $this->Rendezvous->add($rendezvou);
            $rendezvou->setSalle($this);
        }

        return $this;
    }

    public function removeRendezvou(Rendezvous $rendezvou): self
    {
        if ($this->Rendezvous->removeElement($rendezvou)) {
            // set the owning side to null (unless already changed)
            if ($rendezvou->getSalle() === $this) {
                $rendezvou->setSalle(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return 'Salle ' . $this->etagesa . ($this->numsa < 10 ? 0 . $this->numsa : $this->numsa) ;
    }
}
