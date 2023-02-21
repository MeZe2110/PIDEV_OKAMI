<?php

namespace App\Entity;

use App\Repository\RendezvousRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RendezvousRepository::class)]
#[UniqueEntity(fields:['daterv', 'Salle'], errorPath: 'Salle', message:"A rendez-vous already exists this day in this room.")]
class Rendezvous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"Date is required")]
    #[Assert\GreaterThanOrEqual("today", message:"You cannot have a Rendez-Vous in the past.")]
    private ?\DateTimeInterface $daterv = null;


    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'Rendezvous')]
    #[Assert\NotBlank(message:"You must choose a user")]
    #[Assert\Count(min:2, minMessage:"There must be at  two users to start a rendez-vous.")]
    private Collection $Utilisateur;

    #[ORM\ManyToOne(inversedBy: 'Rendezvous')]
    #[Assert\NotBlank(message:"A rendez-vous must be set in a room.")]
    private ?Salle $Salle = null;

    #[ORM\ManyToOne(inversedBy: 'rendezvous')]
    private ?RendezvousType $Type = null; 

    public function __construct()
    {
        $this->Utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDaterv(): ?\DateTimeInterface
    {
        return $this->daterv;
    }

    public function setDaterv(\DateTimeInterface $daterv): self
    {
        $this->daterv = $daterv;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateur(): Collection
    {
        return $this->Utilisateur;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->Utilisateur->contains($utilisateur)) {
            $this->Utilisateur->add($utilisateur);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        $this->Utilisateur->removeElement($utilisateur);

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->Salle;
    }

    public function setSalle(?Salle $Salle): self
    {
        $this->Salle = $Salle;

        return $this;
    }

    public function getType(): ?RendezvousType
    {
        return $this->Type;
    }

    public function setType(?RendezvousType $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function __toString()
    {
        return 'Rendez-vous ' . $this->Type . ' le : ' . $this->daterv->format('d-m-Y') . ' en salle ' . $this->Salle;
    }
}
