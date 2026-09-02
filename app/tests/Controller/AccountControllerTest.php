<?php

/**
 * Test file.
 */

namespace App\Tests\Controller;

use App\Entity\User;
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

    /**
     * Tests account page for logged-in administrator.
     */
    public function testAdminCanOpenAccountPage(): void
    {
        $client = static::createClient();

        $user = $this->createAdmin();
        $client->loginUser($user);

        $client->request('GET', '/account');

        self::assertResponseIsSuccessful();
    }

    /**
     * Tests account edit page for logged-in administrator.
     */
    public function testAdminCanOpenAccountEditPage(): void
    {
        $client = static::createClient();

        $user = $this->createAdmin();
        $client->loginUser($user);

        $client->request('GET', '/account/edit');

        self::assertResponseIsSuccessful();
    }

    /**
     * Tests password change page for logged-in administrator.
     */
    public function testAdminCanOpenPasswordChangePage(): void
    {
        $client = static::createClient();

        $user = $this->createAdmin();
        $client->loginUser($user);

        $client->request('GET', '/account/password');

        self::assertResponseIsSuccessful();
    }

    /**
     * Creates administrator used in tests.
     *
     * @return User test administrator
     */
    private function createAdmin(): User
    {
        $entityManager = static::getContainer()
            ->get('doctrine')
            ->getManager();

        $user = new User();
        $user->setEmail('admin-'.uniqid().'@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('test-password');

        $entityManager->persist($user);
        $entityManager->flush();

        return $user;
    }
}
