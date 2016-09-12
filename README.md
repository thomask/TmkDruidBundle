# DruidBundle

## About ##

This bundle integrates [Druid PHP](https://github.com/pixelfederation/druid-php) into your Symfony2 application. It exposes the library as a service and includes a data collector that adds information about performed queries to the Symfony profiler.

## Instalation

Installation of this library uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

Put the following into your composer.json

    {
        "require": {
            "thomask/druid-bundle": "dev-master"
        }
    }

## Configuration

```yaml
tmk_druid:
    drivers:
        guzzle:
            scheme: http
            host: localhost
            port: 8082
            path: /druid/v2
            proxy: null
            timeout: null
```

## Usage

This bundle creates the `tmk_druid.client` service. You can refer to the [Druid PHP docs](https://github.com/pixelfederation/druid-php) for further reference.
