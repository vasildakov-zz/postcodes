# postcodes
Postcode &amp; Geolocation API for the UK

[![Build Status](https://travis-ci.org/vasildakov/postcodes.svg?branch=master)](https://travis-ci.org/vasildakov/postcodes)
[![Coverage Status](https://coveralls.io/repos/github/vasildakov/postcodes/badge.svg?branch=refactoring)](https://coveralls.io/github/vasildakov/postcodes?branch=refactoring)

## Install

Via Composer

```
$ composer install
```

## Usage


## Generate Doctrine entities, repositories and proxies

```
$ php vendor/bin/doctrine orm:generate:entities src

$ php vendor/bin/doctrine orm:generate-repositories src

$ php vendor/bin/doctrine orm:generate-proxies
```

## Testing

```
$ php vendor/bin/phpunit
```

## Start a web server

```
$ php -S 0.0.0.0:9000 -t public/ public/index.php
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.