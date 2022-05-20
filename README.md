# Laravel Crud Builder
Simple functionality provider to build raws in Laravel quickly, easy to use and customize.

## Getting starter

### 1. Install Laravel 

Use [composer](https://getcomposer.org/) or [laravel installation](https://laravel.com/docs/8.x/installation) to create a new app.

If you use [composer](https://getcomposer.org/), run this command
```bash
composer create-project laravel/laravel my-app
```

or this if you use the [laravel installation](https://laravel.com/docs/8.x/installation)
```bash
laravel new my-app
``` 

### 2. Install Laravel Crud Builder
Locate in proect folder and execute the next command to generate a new key 
```bash
php artisan key:generate
```

Copy config file template and configure your information in .env  
```bash
cp .env.example .env
```

Instala Laravel Crud Builder usando [composer](https://getcomposer.org/)
```bash
composer require idvazquezrivera/laravel-crud-builder
```

Registrar `CrudProvider` en el archivo `config/app.php`  
```php
Idvazquezrivera\LaravelCrudBuilder\CrudProvider::class,
```

Agregar en `config/app.php` el siguiente alias
```php
'CrudController' =>  Idvazquezrivera\LaravelCrudBuilder\CrudController::class,
```

Agregar el provider el archivo composer.json ubicado en la raiz de nuestro proyecto
```
"extra": {
     "laravel": {
          "providers": [
             "Idvazquezrivera\\LaravelCrudBuilder\\CrudProvider"
         ]
     }
 },
```
Tambien en el mismo archivo composer.json agregar en la seccion `autoload psr-4` 
```
"Idvazquezrivera\\LaravelCrudBuilder\\" : "vendor/idvazquezrivera/src/LaravelCrudBuilder/"
```

En terminal ejecutamos el autoload usando composer
```
composer dump-autoload
```

Publicar la configuracion de laravel-crud-builder con artisan
```
php artisan vendor:publish --tag=crud        
```

### 3. Crea un nuevo crud 

Usa artisan para crear un nuevo controlador 
``` s
php artisan make controller ItemsController
```

Crea las rutas para el catalogo tipo source en `routes/web.php
```php
Route::resource('items', 'App\Http\Controllers\ItemsController');
```

Por ultimo extiende el controlador ItemsCotroller de CrudCotroller
```php
use Idvazquezrivera\LaravelCrudBuilder\CrudController;

class ItemsController extends CrudController

```

Configuracion y Personalizacion
-------------------------------
1. Para catalogos simples no requiere ninguna configuracion extra.
2. Puedes reescribir las acciones en el controlador.
3. En la ruta `resources/views/items` agrega tus propias vistas 
 - form.blade.php 
 - show.blade.php 
 - show.blade.php 


Caracteristicas
---------------
- No requiere la creacion de modelos.
- Carga de archivos
- Validacion de formularios
- Pruebas unitarias


Example using Laravel Crud Builder 
----------------------------------
https://github.com/idvazquezrivera/Scaffold-Laravel-Crud.git 