<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("Equipement")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"name is required")]
    #[Groups("Equipement")]
    private ?string $nomeq = null;

    #[ORM\Column]
    #[Groups("Equipement")]
    private ?bool $etateq = null;

    #[ORM\Column]
    #[Groups("Equipement")]
    private ?bool $dispoeq = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[Assert\NotBlank(message:"category is required")]
    #[Groups("Equipement")]
    private ?Categoriesequipement $cate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeq(): ?string
    {
        return $this->nomeq;
    }

    public function setNomeq(string $nomeq): self
    {
        $this->nomeq = $nomeq;

        return $this;
    }

    public function isEtateq(): ?bool
    {
        return $this->etateq;
    }

    public function setEtateq(bool $etateq): self
    {
        $this->etateq = $etateq;

        return $this;
    }

    public function isDispoeq(): ?bool
    {
        return $this->dispoeq;
    }

    public function setDispoeq(bool $dispoeq): self
    {
        $this->dispoeq = $dispoeq;

        return $this;
    }

    public function getCate(): ?categoriesequipement
    {
        return $this->cate;
    }

    public function setCate(?categoriesequipement $cate): self
    {
        $this->cate = $cate;

        return $this;
    }
}
