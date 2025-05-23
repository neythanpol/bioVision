<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated = null;

    #[ORM\Column(name: "is_verified", type: "boolean", options: ["default" => false])]
    private bool $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Foto::class)]
    private Collection $fotos;

    /**
     * @var Collection<int, Voto>
     */
    #[ORM\OneToMany(targetEntity: Voto::class, mappedBy: 'usuario')]
    private Collection $votos;

    /**
     * @var Collection<int, Articulo>
     */
    #[ORM\OneToMany(targetEntity: Articulo::class, mappedBy: 'autor')]
    private Collection $articulo;

    public function __construct()
    {
        $this->votos = new ArrayCollection();
        $this->articulo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        // Aseguro que siempre se devuelve un array
        $roles = $this->roles;
        // Garantiza que todos los usuarios tengan al menos ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedValue(): void {
        $this->created = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdatedValue(): void {
        $this->updated = new \DateTimeImmutable();
    }

    public function getSalt(): ?string {
        // No se necesita salt si se usan algoritmos modernos
        return null;
    }

    public function eraseCredentials(): void {
        // Si tuviera algo que borrar, se haría aquí
    }

    public function getUserIdentifier(): string {
        // Devuelve el campo que se usará como identificador único
        return $this->username;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getFotos(): Collection
    {
        return $this->fotos;
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
            $voto->setUsuario($this);
        }

        return $this;
    }

    public function removeVoto(Voto $voto): static
    {
        if ($this->votos->removeElement($voto)) {
            // set the owning side to null (unless already changed)
            if ($voto->getUsuario() === $this) {
                $voto->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Articulo>
     */
    public function getArticulo(): Collection
    {
        return $this->articulo;
    }

    public function addArticulo(Articulo $articulo): static
    {
        if (!$this->articulo->contains($articulo)) {
            $this->articulo->add($articulo);
            $articulo->setAutor($this);
        }

        return $this;
    }

    public function removeArticulo(Articulo $articulo): static
    {
        if ($this->articulo->removeElement($articulo)) {
            // set the owning side to null (unless already changed)
            if ($articulo->getAutor() === $this) {
                $articulo->setAutor(null);
            }
        }

        return $this;
    }
}
