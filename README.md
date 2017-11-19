# Slick I18n package

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Slick I18n is a simple translation and internationalization package.
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
    'Users' => ''
];

```

save this file in `./i18n/pt_PT/messages.php`.

### Language negotiation and setup

Now lets get our translator:

```php

use Slick\I18n\Language;
use Slick\I18n\Translation;
use Slick\I18n\Translator;

/**
 * Set locale based on the browser accept language
 */
$locale = 'en_US';
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
}

$translation = new Translation(new Language($locale), __DIR__.'/i18n');
$translator = new Translator($translation);

    
setlocale(LC_ALL, $locale);

```

The code above is using the browser's language to set the
locale for our translator object. From now on just use the translation methods
on the strings you want to translate.

### Message translation

```php
echo $translator->translate('Hello world');  // will output 'Olá mundo' 
```

### Plural translation

```php
echo $translator->translatePlural('User', 'Users', 2);  // will output 'Utilizadores' 
```

### Using in your classes

You can add translation functionality to your classes by using the
`TranslateMethods` trait and injecting the translator.

```php
use Slick\I18n\TranslateMethods;
use Slick\I18n\TranslationCapableInterface;
use Slick\I18n\TranslatotInterface;

class MyClass implements TranslationCapableInterface
{

    use TranslateMethods;

    public function __construct(TranslatotInterface $translator)
    {
        $this->tranlator = $translator;
    }  
    
    public function getUsers()
    {
        return $this->translatePlural('User', 'Users', $this->getUserCount());
    }
}
 
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email slick.framework@gmail.com instead of using the issue tracker.

## Credits

- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/slick/i18n.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/slickframework/i18n/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/slickframework/i18n.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/slickframework/i18n.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/slick/i18n.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/slick/i18n
[link-travis]: https://travis-ci.org/slickframework/i18n
[link-scrutinizer]: https://scrutinizer-ci.com/g/slickframework/i18n/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/slickframework/i18n
[link-downloads]: https://packagist.org/packages/slickframework/i18n
[link-contributors]: https://github.com/slickframework/i18n/graphs/contributors