# Print models as html or pdf with stationery and watermark

[![Latest Version on Packagist](https://img.shields.io/packagist/v/orlyapps/laravel-printable.svg?style=flat-square)](https://packagist.org/packages/orlyapps/laravel-printable)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/orlyapps/laravel-printable/run-tests?label=tests)](https://github.com/orlyapps/laravel-printable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/orlyapps/laravel-printable/Check%20&%20fix%20styling?label=code%20style)](https://github.com/orlyapps/laravel-printable/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/orlyapps/laravel-printable.svg?style=flat-square)](https://packagist.org/packages/orlyapps/laravel-printable)

## Installation

You can install the package via composer:

```bash
composer require orlyapps/laravel-printable
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Orlyapps\Printable\PrintableServiceProvider" --tag="laravel-printable-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Orlyapps\Printable\PrintableServiceProvider" --tag="laravel-printable-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
// @TODO
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Florian Strauß](https://github.com/orlyapps)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
