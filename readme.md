Laravel Extendable Router
===========
Adds an extend method to the Laravel-4 router allowing you to add custom route extensions

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `amhol/extendable-routing`.

    "require": {
        "amhol/extendable-routing": "1.*"
    }

Next, update Composer from the Terminal:

    composer update

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

    'AMHOL\ExtendableRouting\ExtendableRoutingServiceProvider'

## Usage

Firstly, you need to add your route extensions, I prefer to do this by adding an `app/routeextensions.php` file as below:

```php
<?php

/*
|--------------------------------------------------------------------------
| Application Route Extensions
|--------------------------------------------------------------------------
|
| Here is where you can extend the router with your own methods.
| It's a breeze. Simply tell the Laravel Router the methods it should 
| respond to and give it the Closure to execute when that method is 
| called.
|
*/

// Route::extend('api', function($resources, $actions = ['index', 'show', 'update', 'create']) {
//     // my custom extension
//     // Route::get($resources, ...);
// });
```

Then adding the following to the bottom of `app/start/global.php`:

```php
require app_path().'/routeextensions.php';
```

You can then access your custom routing methods via the `Route` facade in `routes.php` as normal.