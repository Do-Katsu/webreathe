<?php

namespace App\Entity;

use App\Repository\PositionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: PositionsRepository::class)]
class Positions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 4)]
    private ?string $lat = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 9, scale: 4)]
    private ?string $lng = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Mesures $mesure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getMesure(): ?Mesures
    {
        return $this->mesure;
    }

    public function setMesure(?Mesures $mesure): self
    {
        $this->mesure = $mesure;

        return $this;
    }
}
