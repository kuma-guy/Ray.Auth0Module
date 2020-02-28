<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Auth;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\JWKFetcher;
use Auth0\SDK\Helpers\Tokens\AsymmetricVerifier;
use Lcobucci\JWT\Token;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Auth0Module\Exception\InvalidToken;

class Auth implements AuthInterface
{
    /**
     * @var AsymmetricVerifier
     */
    private $verifier;

    /**
     * @Auth0Config
     */
    public function __construct(array $config)
    {
        $jwksFetcher = new JWKFetcher();
        $jwks = $jwksFetcher->getKeys('https://' . $config['domain'] . '/.well-known/jwks.json');
        $this->verifier = new AsymmetricVerifier($jwks);
    }

    public function verifyToken(string $token) : Token
    {
        try {
            return $this->verifier->verifyAndDecode($token);
        } catch (InvalidTokenException $e) {
            throw new InvalidToken($e->getMessage());
        }
    }
}
