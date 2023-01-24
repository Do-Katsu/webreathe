<?php

namespace App\Entity;

use App\Repository\UptimeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UptimeRepository::class)]
class Uptime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateValue = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'durationSignal')]
    private ?Modules $modules = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateValue(): ?\DateTimeInterface
    {
        return $this->dateValue;
    }

    public function setDateValue(\DateTimeInterface $dateValue): self
    {
        $this->dateValue = $dateValue;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getModules(): ?Modules
    {
        return $this->modules;
    }

    public function setModules(?Modules $modules): self
    {
        $this->modules = $modules;

        return $this;
    }
}
