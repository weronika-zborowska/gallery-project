<?php

/**
 * Gallery entity.
 */

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a photo gallery.
 */
#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Nazwa galerii nie może być pusta.')]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Nazwa galerii musi mieć co najmniej {{ limit }} znaki.',
        maxMessage: 'Nazwa galerii może mieć maksymalnie {{ limit }} znaków.'
    )]
    #[ORM\Column(length: 255)]
    private ?string $title = null;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Returns gallery identifier.
     *
     * @return int|null gallery identifier
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns gallery title.
     *
     * @return string|null gallery title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets gallery title.
     *
     * @param string $title gallery title
     *
     * @return static current object
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns gallery description.
     *
     * @return string|null gallery description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets gallery description.
     *
     * @param string|null $description gallery description
     *
     * @return static current object
     */
    public function setDescription(?string $description): static
    {
        $this->description = $description;

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
     * Returns gallery title as string.
     *
     * @return string gallery title
     */
    public function __toString(): string
    {
        return $this->title ?? '';
    }
}
