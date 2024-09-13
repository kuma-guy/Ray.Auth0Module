<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Auth;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token\Parser;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Auth0Module\Exception\InvalidToken;

class Auth implements AuthInterface
{
    /** @var SdkConfiguration */
    private $configuration;

    /** @Auth0Config("config") */
    #[Auth0Config('config')]
    public function __construct(array $config)
    {
        $this->configuration = new SdkConfiguration([
            'domain' => $config['domain'],
            'clientId' => $config['clientId'],
            'clientSecret' => $config['clientSecret'] ?? null,
            'cookieSecret' => $config['cookieSecret'] ?? null,
        ]);
    }

    public function verifyToken(string $token): Parser
    {
        try {
            $parser = new parser($this->configuration, $token);
            $parser->parse();
            $parser->verify(jwksUri: 'https://' . $this->configuration->getDomain() . '/.well-known/jwks.json');

            return $parser;
        } catch (InvalidTokenException $e) {
            throw new InvalidToken($e->getMessage());
        }
    }
}
