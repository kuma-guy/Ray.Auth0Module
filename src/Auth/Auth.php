<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Auth;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\TokenInterface;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Auth0Module\Exception\InvalidToken;

class Auth implements AuthInterface
{
    private SdkConfiguration $configuration;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(
        #[Auth0Config('config')] array $config
    ) {
        $config['strategy'] = SdkConfiguration::STRATEGY_API;
        $this->configuration = new SdkConfiguration($config);
    }

    public function verifyToken(string $token) : TokenInterface
    {
        try {
            $token = new Token($this->configuration, $token);
            $token
                ->verify()
                ->validate();

            return $token;
        } catch (InvalidTokenException $e) {
            throw new InvalidToken($e->getMessage());
        }
    }
}
