<?php

namespace App\Tests\Entity;

use App\Entity\Gallery;
use PHPUnit\Framework\TestCase;

final class GalleryTest extends TestCase
{
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
