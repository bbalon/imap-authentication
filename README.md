# Laravel 4 IMAP Authentication Package

---

Provides an IMAP authentication provider for the Laravel 4 framework

---

## Installation

Add the following lines to your composer.json file:

```
"require": {
    "ronaldcastillo/imap-authentication": "dev-master"
}
```

Now, run composer update on the command line from your project's root directory:

    composer update
    
### Registering the package

Add the following Service Provider to your providers array in ``app/config/app.php``:

```php
'providers' => array(
    'RonaldCastillo\Imap\ImapServiceProvider'
)
```

### Update Laravel's authentication driver configuration

Change your driver to ``'imap'`` in ``app/config/auth.php``:
```php
'driver' => 'imap',
```

### Publish the configuration files

Run this on the command line from the root of your project:

    php artisan config:publish ronaldcastillo/imap-authentication

This will publish the necessary configuration to ``app/config/ronaldcastillo/imap-authentication/``.

Within the configuration files we have two options:

```php
return array(
    'identifier' => 'username',
    'datasource' => '{localhost:143}/readonly'
);
```

The ``identifier`` indicates the name of the field that will be used as the username for the authentication, while the ``datasource`` value is as specified in the php manual for the [imap_open()](http://php.net/imap_open) function.
