<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests gallery controller access.
 */
final class GalleryControllerTest extends WebTestCase
{
    /**
     * Tests that an anonymous user is redirected to login.
     */
    public function testGalleryIndexRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/gallery');

        self::assertResponseRedirects('/login');
    }
}
