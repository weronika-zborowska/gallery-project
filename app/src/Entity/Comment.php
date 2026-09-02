<?php

/**
 * Comment entity.
 */

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a photo comment.
 */
#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    #[ORM\Column(length: 100)]
    private ?string $nickname = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 1000)]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Photo $photo = null;

    /**
     * Returns comment identifier.
     *
     * @return int|null comment identifier
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns author email.
     *
     * @return string|null author email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets author email.
     *
     * @param string $email author email
     *
     * @return static current object
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns author nickname.
     *
     * @return string|null author nickname
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * Sets author nickname.
     *
     * @param string $nickname author nickname
     *
     * @return static current object
     */
    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Returns comment content.
     *
     * @return string|null comment content
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets comment content.
     *
     * @param string $content comment content
     *
     * @return static current object
     */
    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns creation date.
     *
     * @return \DateTimeImmutable|null creation date
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Sets creation date.
     *
     * @param \DateTimeImmutable $createdAt creation date
     *
     * @return static current object
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns related photo.
     *
     * @return Photo|null related photo
     */
    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    /**
     * Sets related photo.
     *
     * @param Photo|null $photo related photo
     *
     * @return static current object
     */
    public function setPhoto(?Photo $photo): static
    {
        $this->photo = $photo;

        return $this;
    }
}
