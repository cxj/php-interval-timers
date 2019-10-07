# php-interval-timers
A class to manage one or more elapsed-time timers, for such things as performance metrics.

## Installation and Autoloading

This package is installable and PSR-4 autoloadable via Composer as
[cxj/php-interval-timers][].

Alternatively, [download a release][], or clone this repository, then map the
`Cxj\` namespace to the package `src/` directory.

## Dependencies

This package requires PHP 5.1 or later. We recommend using the latest available version of PHP as a matter of principle.

## Quality

[![Build Status](https://travis-ci.org/cxj/php-interval-timers.png?branch=master)](https://travis-ci.org/cxj/php-interval-timers)

## Example Usage

```php
<?php
    $timer = 'mytimer3';
    $this->timer->start($timer);
    usleep(1000);
    $r1 = $this->timer->read($timer);
    echo "$r1 microseconds have past since timer was started" . PHP_EOL;
```
