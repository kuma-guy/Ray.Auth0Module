<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;

interface TokenExtractorInterface
{
    public function supports(Request $request): bool;

    public function extract(Request $request): string;
}
