<?php
declare(strict_types=1);

namespace Ray\Auth0Module\Auth;

use PHPUnit\Framework\TestCase;
use Ray\Auth0Module\Exception\InvalidToken;

class AuthTest extends TestCase
{
    private array $validConfig = [
        'domain' => 'test.auth0.com',
        'clientId' => 'test-client-id',
        'clientSecret' => 'test-client-secret',
        'cookieSecret' => 'test-cookie-secret',
        'audience' => ['test-audience']
    ];

    public function testConstructorWithValidConfig(): void
    {
        $auth = new Auth($this->validConfig);
        $this->assertInstanceOf(Auth::class, $auth);
    }

    public function testVerifyTokenWithInvalidToken(): void
    {
        $auth = new Auth($this->validConfig);
        $invalidTokenString = 'invalid.token';

        $this->expectException(InvalidToken::class);
        $auth->verifyToken($invalidTokenString);
    }
}
