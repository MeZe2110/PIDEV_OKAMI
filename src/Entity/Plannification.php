<?php

namespace App\Entity;

use App\Repository\PlannificationRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlannificationRepository::class)]
class Plannification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank (message:"Date de planniication requis !")]
    #[Assert\Date()]
    #[GreaterThan(value: "today", message: "La date de plannification doit être supérieure à la date actuelle")]
    private ?\DateTimeInterface $datepl = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank (message:"Heure de planniication requis !")]
    private ?\DateTimeInterface $heuredebutpl = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank (message:"Heure Fin de planniication requis !")]
    #[GreaterThan(propertyPath: "heuredebutpl", message: "L'heure de fin doit être supérieure à l'heure de début")]
    private ?\DateTimeInterface $heurefinpl = null;

    #[ORM\ManyToOne(inversedBy: 'plannificationsalle')]
    #[Assert\NotBlank (message:"La salle requis !")]
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
