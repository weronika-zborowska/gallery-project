<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PhotoControllerTest extends WebTestCase
{
    public function testPhotoIndexRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/photo');

        self::assertResponseRedirects('/login');
    }
}
