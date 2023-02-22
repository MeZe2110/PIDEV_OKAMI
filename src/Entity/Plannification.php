<?php

namespace App\Entity;

use App\Repository\PlannificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlannificationRepository::class)]
class Plannification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datepl = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heuredebutpl = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heurefinpl = null;

    #[ORM\ManyToOne(inversedBy: 'plannificationsalle')]
    private ?Salle $salle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatepl(): ?\DateTimeInterface
    {
        return $this->datepl;
    }

    public function setDatepl(\DateTimeInterface $datepl): self
    {
        $this->datepl = $datepl;

        return $this;
    }

    public function getHeuredebutpl(): ?\DateTimeInterface
    {
        return $this->heuredebutpl;
    }

    public function setHeuredebutpl(\DateTimeInterface $heuredebutpl): self
    {
        $this->heuredebutpl = $heuredebutpl;

        return $this;
    }

    public function getHeurefinpl(): ?\DateTimeInterface
    {
        return $this->heurefinpl;
    }

    public function setHeurefinpl(\DateTimeInterface $heurefinpl): self
    {
        $this->heurefinpl = $heurefinpl;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
