<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CommentControllerTest extends WebTestCase
{
    public function testCommentIndexRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/comment');

        self::assertResponseRedirects('/login');
    }
}
