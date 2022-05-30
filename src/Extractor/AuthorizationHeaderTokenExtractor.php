<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;
use Koriym\HttpConstants\RequestHeader;

use function assert;
use function count;
use function explode;
use function is_string;
use function str_ireplace;
use function strcasecmp;

class AuthorizationHeaderTokenExtractor implements TokenExtractorInterface
{
    public function supports(Request $request): bool
    {
        $header = $request->headers->get(RequestHeader::AUTHORIZATION);
        if ($header === null) {
            return false;
        }

        assert(is_string($header));
        $parts = explode(' ', $header);

        return count($parts) === 2 && strcasecmp($parts[0], 'Bearer') === 0;
    }

    public function extract(Request $request): string
    {
        $header = $request->headers->get(RequestHeader::AUTHORIZATION);
        assert(is_string($header));

        return str_ireplace('Bearer ', '', $header);
    }
}
