<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests public photo controller.
 */
/**
 * Tests public photo controller.
 */
final class PublicPhotoControllerTest extends WebTestCase
{
    /**
     * Tests public photo index.
     */
    /**
     * Tests public photo index.
     */
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/photos');

        self::assertResponseIsSuccessful();
    }
}
