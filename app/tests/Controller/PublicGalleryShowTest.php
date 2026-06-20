<?php

namespace App\Tests\Controller;

use App\Entity\Gallery;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PublicGalleryShowTest extends WebTestCase
{
    public function testGalleryShowDisplaysAssignedPhoto(): void
    {
        $client = static::createClient();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = static::getContainer()
            ->get('doctrine')
            ->getManager();

        $gallery = new Gallery();
        $gallery->setTitle('Gallery show test');
        $gallery->setDescription('Gallery test description');
        $gallery->setCreatedAt(new \DateTimeImmutable());

        $photo = new Photo();
        $photo->setFilename('gallery-show-test.jpg');
        $photo->setTitle('Photo assigned to gallery');
        $photo->setDescription('Photo test description');
        $photo->setCreatedAt(new \DateTimeImmutable());
        $photo->setGallery($gallery);

        $entityManager->persist($gallery);
        $entityManager->persist($photo);
        $entityManager->flush();

        $client->request('GET', '/galleries/'.$gallery->getId());

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Gallery show test');
        self::assertStringContainsString(
            'Photo assigned to gallery',
            $client->getResponse()->getContent()
        );
    }
}
