<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests photo controller access.
 */
/**
 * Tests photo controller access.
 */
final class PhotoControllerTest extends WebTestCase
{
    /**
     * Tests that an anonymous user is redirected to login.
     */
    /**
     * Tests that an anonymous user is redirected to login.
     */
    public function testPhotoIndexRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/photo');

        self::assertResponseRedirects('/login');
    }
}
