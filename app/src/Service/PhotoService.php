<?php

/**
 * Photo service.
 */

namespace App\Service;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Service responsible for photo management.
 */
class PhotoService
{
    /**
     * Constructor.
     *
     * @param EntityManagerInterface $entityManager entity manager
     * @param string                 $projectDir    project directory
     */
    public function __construct(private readonly EntityManagerInterface $entityManager, #[Autowire('%kernel.project_dir%')] private readonly string $projectDir)
    {
    }

    /**
     * Creates a photo.
     *
     * @param Photo             $photo     photo entity
     * @param UploadedFile|null $imageFile uploaded image
     */
    public function create(Photo $photo, ?UploadedFile $imageFile): void
    {
        if (null !== $imageFile) {
            $photo->setFilename($this->uploadImage($imageFile));
        }

        $photo->setCreatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($photo);
        $this->entityManager->flush();
    }

    /**
     * Updates a photo.
     *
     * @param Photo             $photo     photo entity
     * @param UploadedFile|null $imageFile uploaded image
     */
    public function update(Photo $photo, ?UploadedFile $imageFile): void
    {
        if (null !== $imageFile) {
            $photo->setFilename($this->uploadImage($imageFile));
        }

        $this->entityManager->flush();
    }

    /**
     * Uploads an image and returns its filename.
     *
     * @param UploadedFile $imageFile uploaded image
     *
     * @return string generated filename
     */
    private function uploadImage(UploadedFile $imageFile): string
    {
        $newFilename = uniqid().'.'.$imageFile->guessExtension();

        $imageFile->move(
            $this->projectDir.'/public/uploads/photos',
            $newFilename
        );

        return $newFilename;
    }
}
