<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;
use Ray\Auth0Module\Exception\TokenNotFound;

interface TokenExtractorInterface
{
    public function supports(Request $request) : bool;

    /**
     * @throws TokenNotFound
     */
    public function extract(Request $request) : string;
}
