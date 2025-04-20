<?php

namespace App\Entity;

use App\Repository\PeriodoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeriodoRepository::class)]
class Periodo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $tipo = null;

    #[ORM\ManyToMany(targetEntity: Mes::class, inversedBy: 'periodos')]
    #[ORM\JoinTable(name: 'periodo_mes')]
    private Collection $meses;

    #[ORM\OneToMany(mappedBy: 'periodo', targetEntity: AveProvinciaPeriodo::class)]
    private Collection $aveProvinciaPeriodos;

    public function __construct()
    {
        $this->meses = new ArrayCollection();
        $this->aveProvinciaPeriodos = new ArrayCollection();
    }

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Mes>
     */
    public function getMeses(): Collection
    {
        return $this->meses;
    }

    public function addMes(Mes $mes): self
    {
        if (!$this->meses->contains($mes)) {
            $this->meses->add($mes);
        }
        return $this;
    }

    public function removeMes(Mes $mes): self
    {
        $this->meses->removeElement($mes);
        return $this;
    }

    /**
     * @return Collection<int, AveProvinciaPeriodo>
     */
    public function getAveProvinciaPeriodos(): Collection
    {
        return $this->aveProvinciaPeriodos;
    }

    public function __toString()
    {
        return $this->tipo;
    }
}
