<?php

namespace App\Entity;

use App\Repository\VitessesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VitessesRepository::class)]
class Vitesses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $valeur = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Mesures $mesure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

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
