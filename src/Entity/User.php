<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 20)]
    private ?string $voornaam = null;

    #[ORM\Column(length: 20)]
    private ?string $achternaam = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $geboortedatum = null;

    #[ORM\Column(length: 20)]
    private ?string $telefoonnummer = null;

    #[ORM\Column(length: 20)]
    private ?string $adress = null;

    #[ORM\Column(length: 20)]
    private ?string $postcode = null;

    #[ORM\Column(length: 20)]
    private ?string $woonplaats = null;

    #[ORM\Column(length: 200)]
    private ?string $motivatie = null;

    #[ORM\Column(length: 50)]
    private ?string $CV = null;

    #[ORM\Column(length: 100)]
    private ?string $profielfoto = null;

    #[ORM\Column(length: 20)]
    private ?string $bedrijf = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?logo $logo = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Vacature::class)]
    private Collection $vacatures;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Sollicitatie::class)]
    private Collection $sollicitaties;

    public function __construct()
    {
        $this->vacatures = new ArrayCollection();
        $this->sollicitaties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
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
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getGeboortedatum(): ?\DateTimeInterface
    {
        return $this->geboortedatum;
    }

    public function setGeboortedatum(\DateTimeInterface $geboortedatum): self
    {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    public function getTelefoonnummer(): ?string
    {
        return $this->telefoonnummer;
    }

    public function setTelefoonnummer(string $telefoonnummer): self
    {
        $this->telefoonnummer = $telefoonnummer;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->woonplaats;
    }

    public function setWoonplaats(string $woonplaats): self
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    public function getMotivatie(): ?string
    {
        return $this->motivatie;
    }

    public function setMotivatie(string $motivatie): self
    {
        $this->motivatie = $motivatie;

        return $this;
    }

    public function getCV(): ?string
    {
        return $this->CV;
    }

    public function setCV(string $CV): self
    {
        $this->CV = $CV;

        return $this;
    }

    public function getProfielfoto(): ?string
    {
        return $this->profielfoto;
    }

    public function setProfielfoto(string $profielfoto): self
    {
        $this->profielfoto = $profielfoto;

        return $this;
    }

    public function getBedrijf(): ?string
    {
        return $this->bedrijf;
    }

    public function setBedrijf(string $bedrijf): self
    {
        $this->bedrijf = $bedrijf;

        return $this;
    }

    public function getLogo(): ?logo
    {
        return $this->logo;
    }

    public function setLogo(?logo $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Vacature>
     */
    public function getVacatures(): Collection
    {
        return $this->vacatures;
    }

    public function addVacature(Vacature $vacature): self
    {
        if (!$this->vacatures->contains($vacature)) {
            $this->vacatures->add($vacature);
            $vacature->setUser($this);
        }

        return $this;
    }

    public function removeVacature(Vacature $vacature): self
    {
        if ($this->vacatures->removeElement($vacature)) {
            // set the owning side to null (unless already changed)
            if ($vacature->getUser() === $this) {
                $vacature->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sollicitatie>
     */
    public function getSollicitaties(): Collection
    {
        return $this->sollicitaties;
    }

    public function addSollicitaty(Sollicitatie $sollicitaty): self
    {
        if (!$this->sollicitaties->contains($sollicitaty)) {
            $this->sollicitaties->add($sollicitaty);
            $sollicitaty->setUser($this);
        }

        return $this;
    }

    public function removeSollicitaty(Sollicitatie $sollicitaty): self
    {
        if ($this->sollicitaties->removeElement($sollicitaty)) {
            // set the owning side to null (unless already changed)
            if ($sollicitaty->getUser() === $this) {
                $sollicitaty->setUser(null);
            }
        }

        return $this;
    }
}
