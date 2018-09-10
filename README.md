Laravel Scaffold
================
Crea catalogo tipo CRUD de manera rapida.

Instalacion
-----------
Instalacion mediante composer
```
composer require idvazquezrivera/scaffold
```

Agregar en el archivo __config/app.php__ el siguiente alias
```
CrudController' => Crud\CrudController::class
```

Modo de uso
-----------
1.- Usa artisan para crear un nuevo controlador 
```
php artisan make controller ItemsController
```

2.- Crea las rutas para el catalogo tipo source
```
Route::resource('items', 'ItemsController');
```

3.- Por ultimo extiende el controlador ItemsCotroller de CrudCotroller
```
class ItemsController extends CrudController
```

Configuracion y Personalizacion
-------------------------------
1. Para catalogos simples no requiere ninguna configuracion extra.
2. Puedes reescribir las acciones en el controlador.
3. Personaliza las vistas colocando archivos __form.blade.php__, __show.blade.php__ o __show.blade.php__ en la ruta __resources/views/items__

Caracteristicas
---------------
- No requiere la creacion de modelos.
- Carga de archivos
- Validacion de formularios
- Pruebas unitarias

Ejemplo 
-------
[Scaffold Laravel CRUD](https://github.com/idvazquezrivera/Scaffold-Laravel-Crud)
