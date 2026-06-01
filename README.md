# Ray.Auth0Module

## Installation

### Composer install

    $ composer require ray/auth0-module

### Module install

```php
use Ray\Di\AbstractModule;
use Ray\Auth0Module\Auth0Module;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new Auth0Module([
            'domain' => getenv('AUTH0_DOMAIN'),
            'clientId' => getenv('AUTH0_MANAGEMENT_CLIENT_ID'),
            'clientSecret' => getenv('AUTH0_MANAGEMENT_CLIENT_SECRET'),
            'audience' => [getenv('AUTH0_AUDIENCE')],
        ]));
    }
}
```

> **Note:** `cookieSecret`（`AUTH0_MANAGEMENT_COOKIE_SECRET`）は不要になりました。本モジュールは Auth0-PHP SDK の `api` / `management` / `none` strategy を使用しており、暗号化セッション Cookie の読み書きは行いません。既存の設定に `cookieSecret` が含まれていても無視されるだけで実害はありません。

## Usage

```php
class User extends ResourceObject
{
    public function __construct() {
        private Management $managementClient;
    }()
    
    public function onPost(): static
    {
        // ....    
        $this->managementClient->users()->create([
            'connection' => CONNECTION_NAME,
            'email' => $email,
            'email_verified' => true,
            'name' => $name,
            'password' => $initialPassword,
        ]);
}
```

See more at https://github.com/auth0/Auth0-PHP
