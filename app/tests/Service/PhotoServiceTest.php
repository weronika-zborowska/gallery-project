<?php

/**
 * Test file.
 */

namespace App\Tests\Service;

use App\Entity\Photo;
use App\Service\PhotoService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Tests photo service.
 */
final class PhotoServiceTest extends TestCase
{
    /**
     * Tests creating a photo without a new image.
     */
    public function testCreateWithoutImage(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $photo = new Photo();
        $photo->setFilename('existing.jpg');

        $entityManager
            ->expects(self::once())
            ->method('persist')
            ->with($photo);

        $entityManager
            ->expects(self::once())
            ->method('flush');

        $service = new PhotoService($entityManager, sys_get_temp_dir());

        $service->create($photo, null);

        self::assertSame('existing.jpg', $photo->getFilename());
        self::assertInstanceOf(\DateTimeImmutable::class, $photo->getCreatedAt());
    }

    /**
     * Tests updating a photo without replacing the image.
     */
    public function testUpdateWithoutImage(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $photo = new Photo();
        $photo->setFilename('existing.jpg');

        $entityManager
            ->expects(self::once())
            ->method('flush');

        $service = new PhotoService($entityManager, sys_get_temp_dir());

        $service->update($photo, null);

        self::assertSame('existing.jpg', $photo->getFilename());
    }

    /**
     * Tests creating a photo with an uploaded image.
     */
    public function testCreateWithImage(): void
    {
        $projectDir = sys_get_temp_dir().'/gallery-photo-service-test';
        $uploadDir = $projectDir.'/public/uploads/photos';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $sourceFile = tempnam(sys_get_temp_dir(), 'photo-test-');
        file_put_contents($sourceFile, 'test image content');

        $uploadedFile = new UploadedFile(
            $sourceFile,
            'photo.jpg',
            'image/jpeg',
            null,
            true
        );

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager
            ->expects(self::once())
            ->method('persist');

        $entityManager
            ->expects(self::once())
            ->method('flush');

        $photo = new Photo();

        $service = new PhotoService($entityManager, $projectDir);
        $service->create($photo, $uploadedFile);

        self::assertNotNull($photo->getFilename());
        self::assertFileExists($uploadDir.'/'.$photo->getFilename());

        unlink($uploadDir.'/'.$photo->getFilename());
        rmdir($uploadDir);
        rmdir($projectDir.'/public/uploads');
        rmdir($projectDir.'/public');
        rmdir($projectDir);
    }
}
