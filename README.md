# Laravel Crud Builder
Simple functionality provider to build raws in Laravel quickly, easy to use and customize.

## Getting starter

### 1. Install Laravel 

Create new laravel app, visit [laravel docs](https://laravel.com/docs), or try downloading this [laravel crud builder example](https://github.com/idvazquezrivera/ExampleLaravelCrudBuilder.git) or use your existent laravel app.

If use [composer](https://getcomposer.org/), run this
```bash
composer create-project laravel/laravel my-app
```

or use [laravel installation](https://laravel.com/docs/8.x/installation)
```bash
laravel new my-app
``` 
Run in project folder
```bash
php artisan key:generate
```
Copy config file template and configure your information in .env  
```bash
cp .env.example .env
```
### 2. Install Laravel Crud Builder

Install laravel crud builder 
```bash
composer require idvazquezrivera/laravel-crud-builder
```

Register `CrudProvider` and `CrudController` in `config/app.php`  
```php  

'providers' => [
  Idvazquezrivera\LaravelCrudBuilder\CrudProvider::class,
  ...
]
...
'aliases' => [
  'CrudController' =>  Idvazquezrivera\LaravelCrudBuilder\CrudController::class
  ...
]
```

Add provider in main composer.json
```json
"extra": {
  "laravel": {
    "providers": [
      "Idvazquezrivera\\LaravelCrudBuilder\\CrudProvider"
    ]
  }
}
...
"autoload": {
  "psr-4": {
    "Idvazquezrivera\\LaravelCrudBuilder\\" : "vendor/idvazquezrivera/src/LaravelCrudBuilder/"
  }
}
```

Run composer autoload
```bash
composer dump-autoload
```

Publish laravel crud builder config with artisan
```bash
php artisan vendor:publish --tag=crud    
```

### 3. Create crud 

Use artisan to create a new controller 
```bash
php artisan make controller ItemsController
```

Add routes in `routes/web.php`
```php
Route::resource('items', 'App\Http\Controllers\ItemsController');
```

ItemsCotroller extends from CrudCotroller
```php
use Idvazquezrivera\LaravelCrudBuilder\CrudController;

class ItemsController extends CrudController

```

## Configure and customize

1. For simple catalogs it does not require any extra configuration.
2. You can rewrite the shares in the controller.
3. On the `resources/views/items` route add your own views
    - form.blade.php
    - show.blade.php
    - index.blade.php


## Features
-----------
- Does not require the creation of models.
- File loading
- Validation of forms
- Unit tests


## Example 
https://github.com/idvazquezrivera/lavel-crud.git
