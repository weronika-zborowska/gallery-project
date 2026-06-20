<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GalleryControllerTest extends WebTestCase
{
    public function testGalleryIndexRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/gallery');

        self::assertResponseRedirects('/login');
    }
}
