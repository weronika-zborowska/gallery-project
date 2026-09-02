<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use App\Entity\Comment;
use App\Entity\Gallery;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests public photo comments.
 */
/**
 * Tests public photo comments.
 */
final class PublicPhotoCommentTest extends WebTestCase
{
    /**
     * Tests that an anonymous user can add a comment.
     */
    /**
     * Tests that an anonymous user can add a comment.
     */
    public function testAnonymousUserCanAddCommentToPhoto(): void
    {
        $client = static::createClient();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = static::getContainer()
            ->get('doctrine')
            ->getManager();

        $gallery = new Gallery();
        $gallery->setTitle('Gallery for comment test');
        $gallery->setDescription('Gallery description');
        $gallery->setCreatedAt(new \DateTimeImmutable());

        $photo = new Photo();
        $photo->setFilename('test-photo.jpg');
        $photo->setTitle('Photo for comment test');
        $photo->setDescription('Photo description');
        $photo->setCreatedAt(new \DateTimeImmutable());
        $photo->setGallery($gallery);

        $entityManager->persist($gallery);
        $entityManager->persist($photo);
        $entityManager->flush();

        $client->request('GET', '/photos/'.$photo->getId());

        self::assertResponseIsSuccessful();

        $client->submitForm('Dodaj komentarz', [
            'comment[email]' => 'test@example.com',
            'comment[nickname]' => 'Tester',
            'comment[content]' => 'To jest komentarz testowy.',
        ]);

        self::assertResponseRedirects('/photos/'.$photo->getId());

        $comment = $entityManager
            ->getRepository(Comment::class)
            ->findOneBy([
                'photo' => $photo,
                'email' => 'test@example.com',
            ]);

        self::assertNotNull($comment);
        self::assertSame('Tester', $comment->getNickname());
        self::assertSame('To jest komentarz testowy.', $comment->getContent());
    }
}
