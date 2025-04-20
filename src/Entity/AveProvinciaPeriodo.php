<?php

namespace App\Entity;

use App\Repository\AveProvinciaPeriodoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AveProvinciaPeriodoRepository::class)]
#[ORM\Table(name: 'ave_provincia_periodo')]
class AveProvinciaPeriodo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Ave::class, inversedBy: 'aveProvinciaPeriodos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ave $ave = null;

    #[ORM\ManyToOne(targetEntity: Provincia::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Provincia $provincia = null;

    #[ORM\ManyToOne(targetEntity: Periodo::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Periodo $periodo = null;

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAve(): ?Ave
    {
        return $this->ave;
    }

    public function setAve(?Ave $ave): self
    {
        $this->ave = $ave;
        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;
        return $this;
    }

    public function getPeriodo(): ?Periodo
    {
        return $this->periodo;
    }

    public function setPeriodo(?Periodo $periodo): self
    {
        $this->periodo = $periodo;
        return $this;
    }
}
