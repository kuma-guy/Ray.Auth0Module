<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;
use Koriym\HttpConstants\RequestHeader;

class AuthorizationHeaderTokenExtractor implements TokenExtractorInterface
{
    public function supports(Request $request) : bool
    {
        if (null === $header = $request->headers->get(RequestHeader::AUTHORIZATION)) {
            return false;
        }

        $parts = explode(' ', $header);

        return count($parts) === 2 && strcasecmp($parts[0], 'Bearer') === 0;
    }

    public function extract(Request $request) : string
    {
        return str_ireplace('Bearer ', '', $request->headers->get(RequestHeader::AUTHORIZATION));
    }
}
