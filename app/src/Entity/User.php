<?php
/**
 * User entity.
 */

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Represents an application user.
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles.
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string|null The hashed password.
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * Returns user identifier.
     *
     * @return int|null User identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns user email.
     *
     * @return string|null User email.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets user email.
     *
     * @param string $email User email.
     *
     * @return static Current object.
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns visual user identifier.
     *
     * @return string User identifier.
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * Returns user roles.
     *
     * @return list<string> User roles.
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Sets user roles.
     *
     * @param list<string> $roles User roles.
     *
     * @return static Current object.
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returns hashed password.
     *
     * @return string|null Hashed password.
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets hashed password.
     *
     * @param string $password Hashed password.
     *
     * @return static Current object.
     */
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Removes sensitive temporary data.
     *
     * @return void
     */
    #[\Deprecated]
    public function eraseCredentials(): void
    {
    }
}
