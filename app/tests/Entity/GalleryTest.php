<?php

/**
 * Test file.
 */

namespace App\Tests\Entity;

use App\Entity\Gallery;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Gallery entity.
 */
/**
 * Tests the Gallery entity.
 */
final class GalleryTest extends TestCase
{
    /**
     * Tests gallery getters and setters.
     */
    /**
     * Tests gallery getters and setters.
     */
    public function testGettersAndSetters(): void
    {
        $gallery = new Gallery();
        $createdAt = new \DateTimeImmutable();

        $gallery->setTitle('Test gallery');
        $gallery->setDescription('Test description');
        $gallery->setCreatedAt($createdAt);

        self::assertSame('Test gallery', $gallery->getTitle());
        self::assertSame('Test description', $gallery->getDescription());
        self::assertSame($createdAt, $gallery->getCreatedAt());
        self::assertSame('Test gallery', (string) $gallery);
    }
}
