Laravel Scaffold CRUD
=====================
Crea catalogo tipo CRUD de manera rapida.

Instalacion
-----------
Instalacion mediante composer
```
composer require idvazquezrivera/laravel-crud-builder
```
Registrar __CrudProvider__ en el archivo __config/app.php__ 
```
Idvazquezrivera\LaravelCrudBuilder\CrudProvider::class,
```

Agregar en __config/app.php__ el siguiente alias
```
'CrudController' =>  Idvazquezrivera\LaravelCrudBuilder\CrudController::class,
```

En composer.json agregar el provider
```
"extra": {
     "laravel": {
          "providers": [
             "Idvazquezrivera\\LaravelCrudBuilder\\CrudProvider"
         ]
     }
 },
```
Tambien en composer.json agregar en autoload psr-4 
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

Modo de uso
-----------
1.- Usa artisan para crear un nuevo controlador 
```
php artisan make controller ItemsController
```

2.- Crea las rutas para el catalogo tipo source en __routes/web.php
```
Route::resource('items', 'App\Http\Controllers\ItemsController');
```

3.- Por ultimo extiende el controlador ItemsCotroller de CrudCotroller
```
use Idvazquezrivera\LaravelCrudBuilder\CrudController;

class ItemsController extends CrudController

```

Configuracion y Personalizacion
-------------------------------
1. Para catalogos simples no requiere ninguna configuracion extra.
2. Puedes reescribir las acciones en el controlador.
3. En la ruta __resources/views/items__ agrega tus propias vistas 
 - form.blade.php 
 - show.blade.php 
 - show.blade.php 


Caracteristicas
---------------
- No requiere la creacion de modelos.
- Carga de archivos
- Validacion de formularios
- Pruebas unitarias

Ejemplo 
-------
[Scaffold Laravel CRUD](https://github.com/idvazquezrivera/Scaffold-Laravel-Crud)
