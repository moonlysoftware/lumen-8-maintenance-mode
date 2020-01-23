# Lumen 6 simple maintenance mode

[![Build Status](https://travis-ci.com/faizalmansor/lumen-6-maintenance-mode.svg?branch=master)](https://travis-ci.com/faizalmansor/lumen-6-maintenance-mode)
[![Latest Stable Version](https://poser.pugx.org/faizalmansor/lumen-6-maintenance-mode/v/stable)](https://packagist.org/packages/faizalmansor/lumen-6-maintenance-mode)
[![Total Downloads](https://poser.pugx.org/faizalmansor/lumen-6-maintenance-mode/downloads)](https://packagist.org/packages/faizalmansor/lumen-6-maintenance-mode)
[![License](https://poser.pugx.org/faizalmansor/lumen-6-maintenance-mode/license)](https://packagist.org/packages/faizalmansor/lumen-6-maintenance-mode)

php 7.3 Lumen 6.2

## How to install

```
composer require faizalmansor/lumen-6-maintenance-mode
```

## How to configure
Add this to your AppServiceProvider or in bootstrap/app.php

```
$app->register(
    faizalmansor\MaintenanceMode\Providers\MaintenanceModeServiceProvider::class
);
```

Add the up and down commands in app/console/Kernel.php

```
    protected $commands = [
        \faizalmansor\MaintenanceMode\Console\Commands\DownCommand::class,
        \faizalmansor\MaintenanceMode\Console\Commands\UpCommand::class
    ];
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

Features planned:
- IP Ranges
- Dynamic DNS IP Filtering
