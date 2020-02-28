<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;
use Ray\Auth0Module\Annotation\Extractors;
use Ray\Auth0Module\Exception\TokenNotFound;

class TokenExtractorResolver
{
    /**
     * @var array
     */
    private $extractors;

    /**
     * @Extractors
     *
     * @var array
     */
    public function __construct(array $extractors)
    {
        $this->extractors = $extractors;
    }

    public function resolve(Request $request) : TokenExtractorInterface
    {
        foreach ($this->extractors as $extractor) {
            if ($extractor->supports($request)) {
                return $extractor;
            }
        }

        throw new TokenNotFound();
    }
}
