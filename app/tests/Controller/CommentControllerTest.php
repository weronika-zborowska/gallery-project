<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests comment controller access.
 */
/**
 * Tests comment controller access.
 */
final class CommentControllerTest extends WebTestCase
{
    /**
     * Tests that an anonymous user is redirected to login.
     */
    /**
     * Tests that an anonymous user is redirected to login.
     */
    public function testCommentIndexRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/comment');

        self::assertResponseRedirects('/login');
    }
}
