<?php

namespace App\Entity;

use App\Repository\SollicitatieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SollicitatieRepository::class)]
class Sollicitatie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sollicitaties')]
    private ?Vacature $vacature = null;

    #[ORM\ManyToOne(inversedBy: 'sollicitaties')]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $uitgenodigd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVacature(): ?Vacature
    {
        return $this->vacature;
    }

    public function setVacature(?Vacature $vacature): self
    {
        $this->vacature = $vacature;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isUitgenodigd(): ?bool
    {
        return $this->uitgenodigd;
    }

    public function setUitgenodigd(bool $uitgenodigd): self
    {
        $this->uitgenodigd = $uitgenodigd;

        return $this;
    }
}
