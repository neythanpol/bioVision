<?php

namespace App\Entity;

use App\Repository\ProvinciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProvinciaRepository::class)]
class Provincia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer', length: 2,)]
    private ?int $codigo = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToMany(targetEntity: Ave::class, mappedBy: 'provincias')]
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

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): static
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

    /**
     * @return Collection<int, Ave>
     */
    public function getAves(): Collection
    {
        return $this->aves;
    }

    public function addAve(Ave $ave): self
    {
        if (!$this->aves->contains($ave)) {
            $this->aves->add($ave);
            $ave->addProvincia($this);
        }
        return $this;
    }

    public function removeAve(Ave $ave): self
    {
        if (!$this->aves->removeElement($ave)) {
            $ave->removeProvincia($this);
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
