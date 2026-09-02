<?php

/**
 * Photo entity.
 */

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a photo.
 */
#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gallery $gallery = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * Returns photo identifier.
     *
     * @return int|null photo identifier
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns filename.
     *
     * @return string|null filename
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * Sets filename.
     *
     * @param string $filename filename
     *
     * @return static current object
     */
    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Returns title.
     *
     * @return string|null photo title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets title.
     *
     * @param string|null $title photo title
     *
     * @return static current object
     */
    public function setTitle(?string $title): static
    {
        $this->title = $title;

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
     * Returns gallery.
     *
     * @return Gallery|null gallery entity
     */
    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    /**
     * Sets gallery.
     *
     * @param Gallery|null $gallery gallery entity
     *
     * @return static current object
     */
    public function setGallery(?Gallery $gallery): static
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Returns description.
     *
     * @return string|null description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets description.
     *
     * @param string|null $description description
     *
     * @return static current object
     */
    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
