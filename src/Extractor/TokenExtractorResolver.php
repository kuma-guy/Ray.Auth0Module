<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Extractor;

use Aura\Web\Request;
use Ray\Auth0Module\Annotation\Extractors;
use Ray\Auth0Module\Exception\TokenNotFound;

use function assert;

class TokenExtractorResolver
{
    /** @var array<string, object> */
    private $extractors;

    /**
     * @param array<string, object> $extractors
     *
     * @Extractors
     */
    #[Extractors]
    public function __construct(array $extractors)
    {
        $this->extractors = $extractors;
    }

    public function resolve(Request $request): object
    {
        foreach ($this->extractors as $extractor) {
            assert($extractor instanceof TokenExtractorInterface);
            if ($extractor->supports($request)) {
                return $extractor;
            }
        }

        throw new TokenNotFound();
    }
}
