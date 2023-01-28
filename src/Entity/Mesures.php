<?php

namespace App\Entity;

use App\Repository\MesuresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MesuresRepository::class)]
class Mesures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'mesure')]
    private ?Modules $modules = null;

    #[ORM\OneToOne(mappedBy: 'mesure', targetEntity: Vitesses::class)]
    private ?Vitesses $vitesse = null;

    #[ORM\OneToOne(mappedBy: 'mesure', targetEntity: Positions::class)]
    private ?Positions $position = null;
    
    #[ORM\OneToOne(mappedBy: 'mesure', targetEntity: Tempratures::class)]
    private ?Tempratures $Temprature = null;
    
    #[ORM\OneToOne(mappedBy: 'mesure', targetEntity: Consommations::class)]
    private ?Consommations $Consommation = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getVitesse(): ?Vitesses
    {
        return $this->vitesse;
    }

    public function setVitesse(?Vitesses $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getPosition(): ?Positions
    {
        return $this->position;
    }

    public function setPosition(?Positions $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTemprature(): ?Tempratures
    {
        return $this->temprature;
    }

    public function setTemprature(?Tempratures $temprature): self
    {
        $this->temprature = $temprature;

        return $this;
    }

    public function getConsommation(): ?Consommations
    {
        return $this->consommation;
    }

    public function setConsommation(?Consommations $consommation): self
    {
        $this->consommation = $consommation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

}
