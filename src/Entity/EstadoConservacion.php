<?php

namespace App\Entity;

use App\Repository\EstadoConservacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadoConservacionRepository::class)]
class EstadoConservacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $codigo = null; // Ej: "LC", "EN", "VU"

    #[ORM\Column(length: 100)]
    private ?string $nombre = null; // Ej: "Preocupación menor", "En peligro", "Vulnerable"

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'estadoConservacion', targetEntity: Ave::class)]
    private Collection $aves;

    public function __construct()
    {
        $this->aves = new ArrayCollection();
    }

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Ave>
     */
    public function getAves(): Collection
    {
        return $this->aves;
    }

    public function __toString(): string
    {
        return $this->codigo.' - '.$this->nombre;
    }
}
