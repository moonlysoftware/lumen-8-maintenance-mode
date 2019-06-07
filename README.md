# Lumen 5.8 simple maintenance mode

[![Latest Stable Version](https://poser.pugx.org/j3rrey/lumen-maintenance-mode/v/stable)](https://packagist.org/packages/j3rrey/lumen-maintenance-mode)
[![Total Downloads](https://poser.pugx.org/j3rrey/lumen-maintenance-mode/downloads)](https://packagist.org/packages/j3rrey/lumen-maintenance-mode)
[![License](https://poser.pugx.org/j3rrey/lumen-maintenance-mode/license)](https://packagist.org/packages/rdehnhardt/lumen-maintenance-mode)
[![Build Status](https://travis-ci.org/j3rrey/lumen-maintenance-mode.svg)](https://travis-ci.org/rdehnhardt/lumen-maintenance-mode)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/j3rrey/lumen-maintenance-mode/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/j3rrey/lumen-maintenance-mode/?branch=master)




## How to install

```
composer require J3rrey/lumen-maintenance-mode
```

## How to configure
In bootstrap/app.php, add this instruction in providers

```
$app->register(
    j3rrey\MaintenanceMode\Providers\MaintenanceModeServiceProvider::class
);
```

Add the up and down commands in app/console/Kernel.php

```
    protected $commands = [
        \J3rrey\MaintenanceMode\Console\Commands\DownCommand::class,
        \J3rrey\MaintenanceMode\Console\Commands\UpCommand::class
    ];
```


## Set View

```
resources/views/errors/503.blade.php
```

## Put the application into maintenance mode.

```
php artisan down
```

## Bring the application out of maintenance mode.

```
php artisan up
```

## IP released for access

In .env file

```
ALLOWED_IPS=999.99.9.999,999.99.9.999,999.99.9.999
```
