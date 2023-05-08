<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["User", "rendezvous", "historique"])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(["User", "rendezvous", "historique"])]
    #[Assert\NotBlank(message: "L'email est requis")]
    #[Assert\Email(message: 'L\'email {{ value }} est non valide. exmple : nomprenom@esprit.tn',)]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(["User", "rendezvous", "historique"])]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(["User", "rendezvous", "historique"])]
    #[Assert\NotBlank(message: "Le nom est requis")]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'nom doit être au moins  {{ limit }} characteres ',
        maxMessage: 'nom ne doit pas depasser {{ limit }} characteres',
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(["User", "rendezvous", "historique"])]
    #[Assert\NotBlank(message: "prenom is required")]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'prenom doit être au moins  {{ limit }} characteres ',
        maxMessage: 'prenom ne doit pas depasser {{ limit }} characteres',
    )]
    private ?string $prenom = null;

    #[ORM\Column(nullable:true)]
    #[Groups("User")]
    #[Assert\NotBlank(message: "Le numéro de téléphone est requis")]
    #[Assert\Positive(message: "Le numéro est incorrecte")]
    #[Assert\Length(
        min: 8,
        max: 8,
        minMessage: 'numero doit être au moins  {{ limit }} characteres ',
        maxMessage: 'numero doit pas depasser {{ limit }} characteres',
    )]
    private ?int $phone_number = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(name: "role_id", referencedColumnName: "id", nullable: true, onDelete: "CASCADE")]
    #[Groups(["User", "rendezvous", "historique"])]
    private ?Roleuser $role = null;

    #[ORM\Column(type: 'boolean', nullable: true, options: ['default' => 0])]
    #[Groups("User")]
    private $isVerified = 0;

    #[ORM\ManyToMany(targetEntity: Rendezvous::class, mappedBy: 'User')]
    #[Groups("User")]
    private Collection $Rendezvous;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Historique::class)]
    #[Groups("User")]
    private Collection $historique;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $username = null;
    #[ORM\Column(length: 255, nullable:true)]
    private ?string $gender = null;

    public function __construct()
    {
        $this->Rendezvous = new ArrayCollection();
        $this->historique = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {

    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function setPhoneNumber(int $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getRole(): ?Roleuser
    {
        return $this->role;
    }

    public function setRole(?Roleuser $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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
            $rendezvou->addUser($this);
        }

        return $this;
    }

    public function removeRendezvou(Rendezvous $rendezvou): self
    {
        if ($this->Rendezvous->removeElement($rendezvou)) {
            $rendezvou->removeUser($this);
        }

        return $this;
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

    public function __toString()
    {
        return $this->nom . ' ' . $this->prenom;
    }
}
