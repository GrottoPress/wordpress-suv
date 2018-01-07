# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 0.2.1 - 2017-11-25

### Changed
- Minor code improvements

## 0.2.0 - 2017-11-09

### Changed
- Compliant with [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/) and [PSR-4](http://www.php-fig.org/psr/psr-4/)
- Replaced PHP Unit with Codeception for testing
- Allowed getting attribute directly instead of via getter method call.

### Removed
- Removed PHP 5 support: Requires PHP version 7.0 or newer.

## 0.1.3 - 2017-08-08

### Added
- Added CHANGELOG.md

### Changed
- Made `gettables` method in `Getter` trait an abstract method.
- Ensure `gettables` method call returns array.

## 0.1.2 - 2017-08-05

### Changed
- Updated test classes to use phpunit version 6

### Fixed
- Fixed wrong return value for callable parameter to `get` method in getter tests

## 0.1.1 - 2017-08-05

### Added
- Set up test suite with [PHPUnit](https://phpunit.de)

### Changed
- Removed check for `trait_exists` in `Getter`.

### Fixed
- Fixed fatal error `Exception` class not found.

## 0.1.0 - 2017-08-05

### Added
- `Getter` trait
