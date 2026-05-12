<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;
use Koriym\HttpConstants\RequestHeader;

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

    public function extract(Request $request) : string
    {
        $header = $request->headers->get(RequestHeader::AUTHORIZATION);
        assert(is_string($header));

        return str_ireplace('Bearer ', '', $header);
    }
}
