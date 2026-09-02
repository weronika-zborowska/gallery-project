<?php

/**
 * Test file.
 */

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Tests User entity.
 */
final class UserTest extends TestCase
{
    /**
     * Tests user getters, setters and roles.
     */
    public function testGettersSettersAndRoles(): void
    {
        $user = new User();

        self::assertNull($user->getId());

        $user->setEmail('admin@example.com');
        self::assertSame('admin@example.com', $user->getEmail());
        self::assertSame('admin@example.com', $user->getUserIdentifier());

        $user->setRoles(['ROLE_ADMIN']);
        self::assertContains('ROLE_ADMIN', $user->getRoles());
        self::assertContains('ROLE_USER', $user->getRoles());

        $user->setPassword('hashed-password');
        self::assertSame('hashed-password', $user->getPassword());

        $user->eraseCredentials();
    }
}
