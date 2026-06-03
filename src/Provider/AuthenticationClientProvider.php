<?php

declare(strict_types=1);

namespace Ray\Auth0Module\Provider;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\Configuration\SdkConfiguration;
use Ray\Auth0Module\Annotation\Auth0Config;
use Ray\Di\ProviderInterface;

/**
 * @implements ProviderInterface<Authentication>
 */
class AuthenticationClientProvider implements ProviderInterface
{
    /** @var array<string, mixed> */
    private array $config;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(
        #[Auth0Config('config')] array $config
    ) {
        // Authentication API はバックエンドからの呼び出しに限定され、暗号化セッション Cookie の
        // 読み書きを行わないため STRATEGY_NONE を指定する。これにより cookieSecret 依存を排除する。
        // STRATEGY_NONE は SdkConfiguration の構築時バリデーションを全てスキップする点に注意。
        // clientId 等は Authentication 側の各メソッド呼び出し時に遅延検証される。
        $config['strategy'] = SdkConfiguration::STRATEGY_NONE;
        $this->config = $config;
    }

    public function get() : Authentication
    {
        return new Authentication($this->config);
    }
}
