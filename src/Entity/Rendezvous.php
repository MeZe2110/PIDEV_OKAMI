<?php

namespace App\Entity;

use App\Repository\RendezvousRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RendezvousRepository::class)]
#[UniqueEntity(fields:['daterv', 'Salle'], errorPath: 'Salle', message:"Il existe déjà un rendez-vous dans cette salle et à cette date.")]
class Rendezvous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("rendezvous")]
    private ?int $id = null;
   
    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Assert\NotBlank(message:"Une date est requise.")]
    #[Assert\GreaterThanOrEqual("now", message:"Impossible de planifier un Rendez-Vous dans le passé.")]
    #[Groups("rendezvous")]
    private ?\DateTimeInterface $daterv = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: "Rendezvous")]
    #[Assert\Count(min:2, minMessage:"Il doit y avoir au moins deux personne pour planifier un rendez-vous.")]
    #[Groups("rendezvous")]
    private Collection $Utilisateur;

    #[ORM\ManyToOne(inversedBy: 'Rendezvous')]
    #[ORM\JoinColumn(name: "Salle", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    #[Assert\NotBlank(message:"Un rendez-vous doit se passer dans une salle.")]
    #[Groups("rendezvous")]
    private ?Salle $Salle = null;

    #[ORM\ManyToOne(inversedBy: 'rendezvous')]
    #[ORM\JoinColumn(name: "Type", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    #[Groups("rendezvous")]
    private ?RendezvousType $Type = null;

    #[ORM\Column(type:"boolean", options: ["default" => true])]
    #[Groups("rendezvous")]
    private ?bool $Rappel = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Assert\GreaterThanOrEqual("1970-01-01 00:00:00.0 +10 minutes", message:"Un rendez-vous doit faire au moins 10min")]
    #[Groups("rendezvous")]
    private ?\DateTimeInterface $endAt =  null; 

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

    public function setDaterv(\DateTimeInterface $daterv = null): self
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

    public function isRappel(): ?bool
    {
        return $this->Rappel;
    }

    public function setRappel(bool $Rappel): self
    {
        $this->Rappel = $Rappel;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function __toString()
    {
        return 'Rendez-vous ' . $this->Type . ' le : ' . $this->daterv->format('d-m-Y') . ' en salle ' . $this->Salle;
    }

    public function showDuree()
    {
        $hours = (int) $this->daterv->format('H');
        $minutes = (int) $this->daterv->format('i');
        $duree_string = "";
        if ($hours && $minutes) {
            return $duree_string . $hours . " heures et " . $minutes . " minutes";
        }
        else {
            if ($hours) {
                $duree_string = $duree_string . $hours . " heures";
            }
            if ($minutes) {
                $duree_string = $duree_string . $minutes . " minutes";
            }
        }

        return $duree_string;
    }

}
