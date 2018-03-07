# Sauls xkcd api client

[![Build Status](https://travis-ci.org/sauls/xkcd-api-client.svg?branch=master)](https://travis-ci.org/sauls/xkcd-api-client)
[![Packagist](https://img.shields.io/packagist/v/sauls/xkcd-api-client.svg)](https://packagist.org/packages/sauls/xkcd-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/sauls/xkcd-api-client.svg)](https://packagist.org/packages/sauls/xkcd-api-client)
[![Coverage Status](https://img.shields.io/coveralls/github/sauls/xkcd-api-client.svg)](https://coveralls.io/github/sauls/xkcd-api-client?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sauls/xkcd-api-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sauls/xkcd-api-client/?branch=master)
[![License](https://img.shields.io/github/license/sauls/xkcd-api-client.svg)](https://packagist.org/packages/sauls/xkcd-api-client)

Sauls xkcd.com api client.

## Requirements

PHP >= 7.2

## Installation

### Using composer
```bash
$ composer require sauls/xkcd-api-client
```
### Apppend the composer.json file manually
```json
{
    "require": {
        "sauls/xkcd-api-client": "^1.0"
    }
}
```

## Client configuration

Client default configuration that can be overridden by passing new values on client creation.  

```php
[
    'client' => [
        'url' => [
            'latest' => '/info.0.json',
            'comic' => '/{num}/info.0.json',
        ],
        'cache' => [
            'prefix' => '__xkcd__',
            'ttl' => 720,
        ],
    ],
    'http_client' => [
        'base_uri' => 'http://xkcd.com',
    ],
]
```

## The info object

This object is returned when you call the `getLatest`, `getRandom` and `get($num)` methods

```php
class Info
{
    private $month;
    private $num;
    private $link;
    private $year;
    private $news;
    private $safeTitle;
    private $transcript;
    private $alt;
    private $img;
    private $title;
    private $day;
    
    /* getters and setters */
}
```


## Usage without cache

```php

Sauls\Component\xkcd\Api\Client\Client;

$client = new Client();

$latestInfo = $client->getLatest(); // returns latest xkcd.com comic info
$randomInfo = $client->getRandom(); // returns random xkcd.com comic info 
$concreteInfo = $client->get(614); // returns concrete xkcd.com comic info
```


## Usage with cache

Uses `symfony/cache` component to cache the responses. For how to configure the cache see [symfony/cache component documentation](https://symfony.com/doc/current/components/cache.html) 

```php
Sauls\Component\xkcd\Api\Client\Client;

$client = new Client();

$cache = new FilesystemCache(/* parameters */);

$client->setCache($cache);

$latestInfo = $client->getLatest(); 

```

## Exceptions

* `ComicNotFoundException` - is thrown when requested comic was not found e.g. the xkcd api returns `404` response
* `ServiceDownException` - is thrown on all other response statuses
* `XkcdClientException` - is thrown when there is something wrong with your configuration or when errors occur.
