<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests public gallery controller.
 */
/**
 * Tests public gallery controller.
 */
final class PublicGalleryControllerTest extends WebTestCase
{
    /**
     * Tests public gallery index.
     */
    /**
     * Tests public gallery index.
     */
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
    }
}
