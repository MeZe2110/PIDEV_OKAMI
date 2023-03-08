<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: HistoriqueRepository::class)]
class Historique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("historique")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("historique")]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'historique')]
    #[Groups("historique")]
    private ?Utilisateur $User = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Groups("historique")]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $type): self
    {
        $this->description = $type;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->User;
    }

    public function setUser(?Utilisateur $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function createHistorique($description, $userId, UtilisateurRepository $userRepository) : self
    {
        $this->setDescription($description);
        $this->setUser($userRepository->findOneBy(['id' => $userId]));
        $this->setDate(new DateTime());
        return $this;
    }

}
