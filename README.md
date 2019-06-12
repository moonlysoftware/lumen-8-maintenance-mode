# Lumen 5 simple maintenance mode

[![Build Status](https://travis-ci.org/j3rrey/lumen-maintenance-mode.svg)](https://travis-ci.org/j3rrey/lumen-maintenance-mode)

php 7.2 Lumen 5.8

## How to install

```
composer require j3rrey/lumen-5-maintenance-mode
```

## How to configure
Add this to your AppServiceProvider or in bootstrap/app.php

```
$app->register(
    j3rrey\MaintenanceMode\Providers\MaintenanceModeServiceProvider::class
);
```

Add the up and down commands in app/console/Kernel.php

```
    protected $commands = [
        \j3rrey\MaintenanceMode\Console\Commands\DownCommand::class,
        \j3rrey\MaintenanceMode\Console\Commands\UpCommand::class
    ];
```


## Customize View

In case there is no 503 view file you will be asked if it should be created for you when putting your application in maintenance mode.

Example views at the bottom

```
resources/views/errors/503.blade.php
```

## Maintenance Mode on

```
php artisan down
```

## Maintenance Mode off

```
php artisan up
```

## IP based access
Currently only ipv4 and no ipranges

Add ALLOWED_IPS in your .env file

```
ALLOWED_IPS=192.168.1.2,127.0.0.1,136.22.16.0
```

## Example view

Laravel 503 blade file(2016):
https://github.com/laravel/laravel/blob/696ab5149e6b6169f73b75321eaabf47a4a26645/resources/views/errors/503.blade.php


Default View:

![Default View]("https://i.postimg.cc/8pH9pXZx/Screen-Shot-2019-06-12-at-11-24-08.png")


