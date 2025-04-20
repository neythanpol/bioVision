<?php

namespace App\Entity;

use App\Repository\MesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MesRepository::class)]
class Mes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $nombre = null;

    #[ORM\ManyToMany(targetEntity: Periodo::class, mappedBy: 'meses')]
    private Collection $periodos;

    public function __construct()
    {
        $this->periodos = new ArrayCollection();
    }

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return Collection<int, Periodo>
     */
    public function getPeriodos(): Collection
    {
        return $this->periodos;
    }

    public function addPeriodo(Periodo $periodo): self
    {
        if (!$this->periodos->contains($periodo)) {
            $this->periodos->add($periodo);
            $periodo->addMes($this);
        }
        return $this;
    }

    public function removePeriodo(Periodo $periodo): self
    {
        if ($this->periodos->removeElement($periodo)) {
            $periodo->removeMes($this);
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}