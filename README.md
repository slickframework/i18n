# Slick I18n package

[![Latest Version](https://img.shields.io/github/release/slickframework/i18n.svg?style=flat-square)](https://github.com/slickframework/i18n/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/slickframework/i18n/develop.svg?style=flat-square)](https://travis-ci.org/slickframework/i18n)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/slickframework/i18n/develop.svg?style=flat-square)](https://scrutinizer-ci.com/g/slickframework/i18n/code-structure?branch=develop)
[![Quality Score](https://img.shields.io/scrutinizer/g/slickframework/i18n/develop.svg?style=flat-square)](https://scrutinizer-ci.com/g/slickframework/i18n?branch=develop)
[![Total Downloads](https://img.shields.io/packagist/dt/slick/i18n.svg?style=flat-square)](https://packagist.org/packages/slick/i18n)

Slick I18n is a simple translation and internationalization package for Slick.
It depends on Zend/I18n which is a complete translation suite that supports all
major formats and includes popular features like plural translations and text domains.

This package is compliant with PSR-2 code standards and PSR-4 autoload standards. It
also applies the [semantic version 2.0.0](http://semver.org) specification.

## Install

Via Composer

``` bash
$ composer require slick/i18n
```

## Usage

### Messages file

Create a messages file:

```php
/**
 * pt_PT messages file
 */

return [
    '' => array(
            'plural_forms' => 'nplurals=2; plural=n!=1;'
        ),
    'Hello world' => 'Olá mundo',
    'User' => ['Utilizador', 'Utilizadores'],
    'Users' = ''
];

```

save this file in `./i18n/pt_PT/default.php`.

### Language negotiation and setup

Now lets get our translator:

```php

use Slick\I18n\Translator;

/**
 * Set locale based on the browser accept language
 */
$locale = 'en_US';
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
}

Translator::getInstance()->setLocale($locale)
    ->type = 'phparray';
setlocale(LC_ALL, $locale);

```

The code above is using the browser's language to set the
locale for our translator object. From now on just use the translation methods
on the strings you want to translate.

### Message translation

```php
$t = Translator::getInstance();

echo $t->translate('Hello world');  // will output 'Olá mundo' 
```

### Plural translation

```php
$t = Translator::getInstance();

echo $t->translatePlural('User', 'Users', 2);  // will output 'Utilizadores' 
```

### Using in your classes

You can add translation functionality to your classes by using the
`TranslateMethods` trait.

```php
use Slick\I18n\TranslateMethods;

class MyClass
{

    use TranslateMethods;
    
    public function getUsers()
    {
        return $this->translatePlural('User', 'Users', $this->getUserCount());
    }
}
 
```

## Testing

``` bash
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email silvam.filipe@gmail.com instead of using the issue tracker.

## Credits

- [Slick framework](https://github.com/slickframework)
- [All Contributors](https://github.com/slickframework/common/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

