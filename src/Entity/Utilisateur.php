<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomut = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomut = null;

    #[ORM\Column(length: 255)]
    private ?string $emailut = null;

    #[ORM\Column(length: 255)]
    private ?string $mdput = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Roleutilisateur $roleut = null;

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

    public function getRoleut(): ?roleutilisateur
    {
        return $this->roleut;
    }

    public function setRoleut(?roleutilisateur $roleut): self
    {
        $this->roleut = $roleut;

        return $this;
    }
    public function __toString()
    {
        return $this->nomut . ' ' . $this->prenomut;
    }
}
