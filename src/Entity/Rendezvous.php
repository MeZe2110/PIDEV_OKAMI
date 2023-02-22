<?php

namespace App\Entity;

use App\Repository\RendezvousRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezvousRepository::class)]
class Rendezvous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $daterv = null;

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
}
