<?php

namespace App\Entity;

use App\Repository\LogoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogoRepository::class)]
class Logo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $logo = null;

    #[ORM\OneToMany(mappedBy: 'logo', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'logo', targetEntity: Vacature::class)]
    private Collection $vacatures;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->vacatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setLogo($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLogo() === $this) {
                $user->setLogo(null);
            }
        }

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
            $vacature->setLogo($this);
        }

        return $this;
    }

    public function removeVacature(Vacature $vacature): self
    {
        if ($this->vacatures->removeElement($vacature)) {
            // set the owning side to null (unless already changed)
            if ($vacature->getLogo() === $this) {
                $vacature->setLogo(null);
            }
        }

        return $this;
    }
}
