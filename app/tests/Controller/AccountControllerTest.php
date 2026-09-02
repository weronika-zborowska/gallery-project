<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests account controller access.
 */
final class AccountControllerTest extends WebTestCase
{
    /**
     * Tests that an anonymous user is redirected to login.
     */
    public function testAccountRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/account');

        self::assertResponseRedirects('/login');
    }
}
