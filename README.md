# Ray.Auth0Module

## Installation

### Composer install

    $ composer require ray/auth0-module

### Module install

```php
use Ray\Di\AbstractModule;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\AuraSqlModule\AuraSqlQueryModule;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new Auth0Module([
            'domain' => getenv('AUTH0_DOMAIN'),
            'client_id' => getenv('AUTH0_CLIENT_ID'),
            'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
        ]));
    }
}
```
    
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
