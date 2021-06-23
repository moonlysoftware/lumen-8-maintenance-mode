# Lumen 8 simple maintenance mode

php 7.2 Lumen 8.x

## How to install

    composer require moonlysoftware/lumen-8-maintenance-mode

## How to configure
Add this to your AppServiceProvider or in bootstrap/app.php

    $app->register(\MoonlySoftware\MaintenanceMode\Providers\MaintenanceModeServiceProvider::class);

Add the up and down commands in app/console/Kernel.php

    protected $commands = [
        \MoonlySoftware\MaintenanceMode\Console\Commands\DownCommand::class,
        \MoonlySoftware\MaintenanceMode\Console\Commands\UpCommand::class
    ];

## Maintenance Mode on

    php artisan down

## Maintenance Mode off

    php artisan up

## IP based access
Currently only ipv4 and no ip ranges

Add ALLOWED_IPS in your .env file

```
ALLOWED_IPS=192.168.1.2,127.0.0.1,136.22.16.0
```

Features planned:
- IP Ranges
- Dynamic DNS IP Filtering
