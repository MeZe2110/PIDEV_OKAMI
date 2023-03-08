<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["utilisateur", "rendezvous", "historique"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["utilisateur", "rendezvous", "historique"])]
    private ?string $nomut = null;

    #[ORM\Column(length: 255)]
    #[Groups(["utilisateur", "rendezvous", "historique"])]
    private ?string $prenomut = null;

    #[ORM\Column(length: 255)]
    #[Groups("utilisateur")]
    private ?string $emailut = null;

    #[ORM\Column(length: 255)]
    #[Groups("utilisateur")]
    private ?string $mdput = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("utilisateur")]
    private ?Roleutilisateur $roleut = null;

    #[ORM\ManyToMany(targetEntity: Rendezvous::class, mappedBy: 'Utilisateur')]
    #[Groups("utilisateur")]
    private Collection $Rendezvous;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Historique::class)]
    #[Groups("utilisateur")]
    private Collection $historique;

    public function __construct()
    {
        $this->Rendezvous = new ArrayCollection();
        $this->historique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomut(): ?string
    {
        return $this->nomut;
    }

    public function setNomut(string $nomut): self
    {
        $this->nomut = $nomut;

        return $this;
    }

    public function getPrenomut(): ?string
    {
        return $this->prenomut;
    }

    public function setPrenomut(string $prenomut): self
    {
        $this->prenomut = $prenomut;

        return $this;
    }

    public function getEmailut(): ?string
    {
        return $this->emailut;
    }

    public function setEmailut(string $emailut): self
    {
        $this->emailut = $emailut;

        return $this;
    }

    public function getMdput(): ?string
    {
        return $this->mdput;
    }

    public function setMdput(string $mdput): self
    {
        $this->mdput = $mdput;

        return $this;
    }

    public function getRoleut(): ?Roleutilisateur
    {
        return $this->roleut;
    }

    public function setRoleut(?Roleutilisateur $roleut): self
    {
        $this->roleut = $roleut;

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
            $rendezvou->addUtilisateur($this);
        }

        return $this;
    }

    public function removeRendezvou(Rendezvous $rendezvou): self
    {
        if ($this->Rendezvous->removeElement($rendezvou)) {
            $rendezvou->removeUtilisateur($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nomut . ' ' . $this->prenomut;
    }

    /**
     * @return Collection<int, Historique>
     */
    public function getHistorique(): Collection
    {
        return $this->historique;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historique->contains($historique)) {
            $this->historique->add($historique);
            $historique->setUser($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historique->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getUser() === $this) {
                $historique->setUser(null);
            }
        }

        return $this;
    }
}
