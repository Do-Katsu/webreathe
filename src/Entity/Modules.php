<?php

namespace App\Entity;

use App\Repository\ModulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModulesRepository::class)]
class Modules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'modules', targetEntity: Mesures::class, cascade: ['persist', 'remove'])]
    private Collection $mesure;

    #[ORM\OneToMany(mappedBy: 'modules', targetEntity: Uptime::class, cascade: ['persist', 'remove'])]
    private Collection $durationSignal;

    public function __construct()
    {
        $this->mesure = new ArrayCollection();
        $this->durationSignal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Mesures>
     */
    public function getMesure(): Collection
    {
        return $this->mesure;
    }

    public function addMesure(Mesures $mesure): self
    {
        if (!$this->mesure->contains($mesure)) {
            $this->mesure->add($mesure);
            $mesure->setModules($this);
        }

        return $this;
    }

    public function removeMesure(Mesures $mesure): self
    {
        if ($this->mesure->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getModules() === $this) {
                $mesure->setModules(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Uptime>
     */
    public function getDurationSignal(): Collection
    {
        return $this->durationSignal;
    }

    public function addDurationSignal(Uptime $durationSignal): self
    {
        if (!$this->durationSignal->contains($durationSignal)) {
            $this->durationSignal->add($durationSignal);
            $durationSignal->setModules($this);
        }

        return $this;
    }

    public function removeDurationSignal(Uptime $durationSignal): self
    {
        if ($this->durationSignal->removeElement($durationSignal)) {
            // set the owning side to null (unless already changed)
            if ($durationSignal->getModules() === $this) {
                $durationSignal->setModules(null);
            }
        }

        return $this;
    }
}
