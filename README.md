# EVALANCHE SOAP API CONNECTOR

[![Monthly Downloads](https://poser.pugx.org/scn/evalanche-soap-api-connector/d/monthly)](https://packagist.org/packages/scn/evalanche-soap-api-connector)
[![License](https://poser.pugx.org/scn/evalanche-soap-api-connector/license)](LICENSE)
![tests](https://github.com/SC-Networks/evalanche-soap-api-connector/workflows/tests/badge.svg)

## Install

Via Composer

``` bash
$ composer require scn/evalanche-soap-api-connector
```

## Usage

### General

First create a connection with the access credentials provided by SC-Networks.

```php
require 'vendor/autoload.php';

$connection = \Scn\EvalancheSoapApiConnector\EvalancheConnection::create(
    'given host',
    'given username',
    'given password'
);
```

Then create the client of your choice e.g. FormClient

`$statistic = $connection->createFormClient()->getStatistics(123, false);`

Work with the results

`$statistic->getImpressions()`

Most of the methods will require/return structs which are defined and
described in [the struct repository](https://github.com/SC-Networks/evalanche-soap-api-struct).

## Method Documentation

Can be found [here](/docs/index.md).

## Testing

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
