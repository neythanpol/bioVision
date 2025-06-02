<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Ya existe una cuenta con este email')]
#[UniqueEntity(fields: ['username'], message: 'Este nombre de usuario ya está en uso')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'El nombre de usuario es obligatorio')]
    #[Assert\Length(
        min: 4,
        max: 20,
        minMessage: 'El usuario debe tener al menos {{ limit }} caracteres',
        maxMessage: 'El usuario no puede tener más de {{ limit }} caracteres'
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9_]+$/',
        message: 'El nombre de usuario solo puede contener letras, números y guiones bajos'
    )]
    private ?string $username = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'El email es obligatorio')]
    #[Assert\Email(message: 'El email {{ value }} no es válido')]
    #[Assert\Length(max: 180)]
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
    
    private ?string $plainPassword = null;

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
        $roles = $this->roles;
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
        return null;
    }

    public function eraseCredentials(): void {
    }

    public function getUserIdentifier(): string {
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
            if ($articulo->getAutor() === $this) {
                $articulo->setAutor(null);
            }
        }

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
}
