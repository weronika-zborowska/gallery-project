<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AccountControllerTest extends WebTestCase
{
    public function testAccountRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/account');

        self::assertResponseRedirects('/login');
    }
}
