<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;
use Koriym\HttpConstants\RequestHeader;
use Ray\Auth0Module\Exception\TokenNotFound;

class AuthorizationHeaderTokenExtractor implements TokenExtractorInterface
{
    public function supports(Request $request) : bool
    {
        $header = $request->headers->get(RequestHeader::AUTHORIZATION);
        if (! is_string($header)) {
            return false;
        }

        $parts = explode(' ', $header);

        return count($parts) === 2 && strcasecmp($parts[0], 'Bearer') === 0;
    }

    /**
     * @throws TokenNotFound
     */
    public function extract(Request $request) : string
    {
        $header = $request->headers->get(RequestHeader::AUTHORIZATION);
        if (! is_string($header)) {
            throw new TokenNotFound();
        }

        return str_ireplace('Bearer ', '', $header);
    }
}
