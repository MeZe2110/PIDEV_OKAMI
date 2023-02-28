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
#[UniqueEntity(fields:['daterv', 'Salle'], errorPath: 'Salle', message:"Il existe déjà un rendez-vous dans cette salle et à cette date.")]
class Rendezvous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:"Une date est requise.")]
    #[Assert\GreaterThanOrEqual("today", message:"Impossible de planifier un Rendez-Vous dans le passé.")]
    private ?\DateTimeInterface $daterv = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: "Rendezvous")]
    #[Assert\Count(min:2, minMessage:"Il doit y avoir au moins deux personne pour planifier un rendez-vous.")]
    private Collection $Utilisateur;

    #[ORM\ManyToOne(inversedBy: 'Rendezvous')]
    #[ORM\JoinColumn(name: "Salle", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    #[Assert\NotBlank(message:"Un rendez-vous doit se passer dans une salle.")]
    private ?Salle $Salle = null;

    #[ORM\ManyToOne(inversedBy: 'rendezvous')]
    #[ORM\JoinColumn(name: "Type", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    private ?RendezvousType $Type = null;

    #[ORM\Column(type:"boolean", options: ["default" => true])]
    private ?bool $Rappel = true; 

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

    public function isRappel(): ?bool
    {
        return $this->Rappel;
    }

    public function setRappel(bool $Rappel): self
    {
        $this->Rappel = $Rappel;

        return $this;
    }
}
