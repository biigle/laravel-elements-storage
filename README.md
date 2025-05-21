# Laravel ELEMENTS Storage Driver

[ELEMENTS](https://elements.tv) storage driver for Laravel/Lumen.

**Warning:** This driver guesses the file MIME types based on the filename (as ELEMENTS does not provide the MIME type). MIME types can be easily spoofed if the files are not under your control.

## Installation

Require the package with Composer:

```
composer require biigle/laravel-elements-storage
```

### Laravel

For Laravel 5.4 and lower, add the service provider to `config/app.php`:

```php
Biigle\Filesystem\ElementsServiceProvider::class,
```

### Lumen

Add the service provider to `bootstrap/app.php`:
```php
$app->register(Biigle\Filesystem\ElementsServiceProvider::class);
```

## Configuration

Add a new storage disk to `config/filesystems.php`:

```php
'disks' => [
   'elements' => [
      'driver' => 'elements',
      'baseUri' => env('ELEMENTS_BASE_URL', ''), // e.g. https://elements.example.com
      'token' => env('ELEMENTS_API_TOKEN', ''), // e.g. my-elements-api-token
   ],
]
```

Additional configuration options:

- `disableAsserts` (default: `false`) [[ref]](https://flysystem.thephpleague.com/docs/advanced/performance/)

- `prefix` (default: `null`): Prefix to use for all file paths.

