# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [v1.3.1] - 2017-11-19

### Fixed
- Fixed bug on Translator::translatePlural() that fail to set the correct domain name

## [v1.3.0] - 2017-11-19

### Added
- TranslateMethods now check is class has the translator object set
- TranslatorInterface for a better abstract usage
- Translation object to encapsulate different domains, locales and files 
- Language database
- Language value object
- Code of conduct
- PHPSpec for unit and specification tests

### Changed
- TYPE_PHP_ARRAY and TYPE_GETTEX are noe in the Translation class

### Removed
- Translator::getInstance() was removed. It should be used in conjunction with
  a dependency injection container.
- Unit test with PHPUnit

## [v1.2.0] - 2016-02-22

### Added
- Multiple domain on translation
- Multiple locales on translation
- Set the translator types as Translator class constants:
  TYPE_PHP_ARRAY and TYPE_GETTEXT
- Set class property names convention to PSR-2

### removed
- Slick/Configuration dependency


## v1.0.4 - 2015-04-14

### Added
- Initial package release

[Unreleased]: https://github.com/slickframework/i18n/compare/v1.3.1...HEAD
[v1.3.1]: https://github.com/slickframework/i18n/compare/v1.3.0...v1.3.1
[v1.3.0]: https://github.com/slickframework/i18n/compare/v1.2.0...v1.3.0
[v1.2.0]: https://github.com/slickframework/i18n/compare/v1.0.4...v1.2.0
