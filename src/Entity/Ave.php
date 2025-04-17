<?php

namespace App\Entity;

use App\Repository\AveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AveRepository::class)]
class Ave
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreComun = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreCientifico = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 100)]
    private ?string $orden = null;

    #[ORM\Column(length: 100)]
    private ?string $familia = null;

    #[ORM\Column]
    private ?float $longitudMinima = null;

    #[ORM\Column]
    private ?float $longitudMaxima = null;

    #[ORM\Column]
    private ?float $envergaduraMinima = null;

    #[ORM\Column]
    private ?float $envergaduraMaxima = null;

    #[ORM\Column(name: 'imagen_nombre', length: 255, nullable: true)]
    private ?string $imagenNombre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreComun(): ?string
    {
        return $this->nombreComun;
    }

    public function setNombreComun(string $nombreComun): static
    {
        $this->nombreComun = $nombreComun;

        return $this;
    }

    public function getNombreCientifico(): ?string
    {
        return $this->nombreCientifico;
    }

    public function setNombreCientifico(string $nombreCientifico): static
    {
        $this->nombreCientifico = $nombreCientifico;

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

    public function getOrden(): ?string
    {
        return $this->orden;
    }

    public function setOrden(string $orden): static
    {
        $this->orden = $orden;

        return $this;
    }

    public function getFamilia(): ?string
    {
        return $this->familia;
    }

    public function setFamilia(string $familia): static
    {
        $this->familia = $familia;

        return $this;
    }

    public function getLongitudMinima(): ?float
    {
        return $this->longitudMinima;
    }

    public function setLongitudMinima(float $longitudMinima): static
    {
        $this->longitudMinima = $longitudMinima;

        return $this;
    }

    public function getLongitudMaxima(): ?float
    {
        return $this->longitudMaxima;
    }

    public function setLongitudMaxima(float $longitudMaxima): static
    {
        $this->longitudMaxima = $longitudMaxima;

        return $this;
    }

    public function getEnvergaduraMinima(): ?float
    {
        return $this->envergaduraMinima;
    }

    public function setEnvergaduraMinima(float $envergaduraMinima): static
    {
        $this->envergaduraMinima = $envergaduraMinima;

        return $this;
    }

    public function getEnvergaduraMaxima(): ?float
    {
        return $this->envergaduraMaxima;
    }

    public function setEnvergaduraMaxima(float $envergaduraMaxima): static
    {
        $this->envergaduraMaxima = $envergaduraMaxima;

        return $this;
    }

    public function getImagenNombre(): ?string
    {
        return $this->imagenNombre;
    }

    public function setImagenNombre(?string $imagenNombre): self 
    {
        $this->imagenNombre = $imagenNombre;
        return $this;
    }

    public function getImagenUrl(): ?string
    {
        return $this->imagenNombre ? '/images/aves/' . $this -> imagenNombre : null;
    }
}
