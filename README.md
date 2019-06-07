# Lumen 5.8 simple maintenance mode

[![Latest Stable Version](https://poser.pugx.org/j3rrey/lumen-maintenance-mode/v/stable)](https://packagist.org/packages/j3rrey/lumen-maintenance-mode)

[![Build Status](https://travis-ci.org/j3rrey/lumen-maintenance-mode.svg)](https://travis-ci.org/rdehnhardt/lumen-maintenance-mode)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/j3rrey/lumen-maintenance-mode/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/j3rrey/lumen-maintenance-mode/?branch=master)




## How to install

```
composer require j3rrey/lumen-maintenance-mode
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


## Add/Set View

Example views at the bottom

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

## Example view

Laravel 503 blade file:
https://github.com/laravel/laravel/blob/696ab5149e6b6169f73b75321eaabf47a4a26645/resources/views/errors/503.blade.php

My prefferred one
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <title>Maintenance</title>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #333;
            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            transform-style: preserve-3d;
            font-family: 'Open Sans', sans-serif;
        }
        header {
            color: #fff;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            text-align: center;
            margin: 0 auto;
        }
        header h1, header p  {
            margin: 0;
            padding: .25em 0;
        }
        header p {
            color: #999;
            font-size: .8em;
        }
    </style>
</head>
<body>
<header>
    <h1>Maintenance mode</h1>
    <p>We are currently working to bring you a great services</p>
</header>
</body>
</html>

```

