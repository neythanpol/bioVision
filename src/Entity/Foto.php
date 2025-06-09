<?php

namespace App\Entity;

use App\Entity\Usuario;
use App\Entity\Ave;
use App\Repository\FotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FotoRepository::class)]
#[Vich\Uploadable]
class Foto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'fotos_aves', fileNameProperty: 'nombreArchivo')]
    private ?File $archivo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombreArchivo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaSubida = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'fotos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne(targetEntity: Ave::class, inversedBy: 'fotos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ave $ave = null;

    /**
     * @var Collection<int, Voto>
     */
    #[ORM\OneToMany(targetEntity: Voto::class, mappedBy: 'foto')]
    private Collection $votos;

    public function __construct()
    {
        $this->fechaSubida = new \DateTime();
        $this->votos = new ArrayCollection();
    }

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArchivo(): ?File
    {
        return $this->archivo;
    }

    public function setArchivo(?File $archivo = null): void
    {
        $this->archivo = $archivo;

        if (null !== $archivo) {
            $this->fechaSubida = new \DateTimeImmutable();
        }
    }

    public function getNombreArchivo(): ?string
    {
        return $this->nombreArchivo;
    }

    public function setNombreArchivo(string $nombreArchivo): static
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaSubida(): ?\DateTimeInterface
    {
        return $this->fechaSubida;
    }

    public function setFechaSubida(\DateTimeInterface $fechaSubida): static
    {
        $this->fechaSubida = $fechaSubida;

        return $this;
    }

    public function getUrlRelativa(): string
    {
        return 'uploads/fotos/aves/' .$this->nombreArchivo;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
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

    /**
     * @return Collection<int, Voto>
     */
    public function getVotos(): Collection
    {
        return $this->votos;
    }

    public function addVoto(Voto $voto): static
    {
        if (!$this->votos->contains($voto)) {
            $this->votos->add($voto);
            $voto->setFoto($this);
        }

        return $this;
    }

    public function removeVoto(Voto $voto): static
    {
        if ($this->votos->removeElement($voto)) {
            if ($voto->getFoto() === $this) {
                $voto->setFoto(null);
            }
        }

        return $this;
    }
}
