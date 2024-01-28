
#### Rutas con parámetros
- Creamos el controller con : ``php artisan make:controller NoteController``
- Creamos el modelo y la migracion con: ``php artisan make:model Note --migration``
- Creamos la base de datos en HeidiSQL, en el archivo de migración añadimos los campos que tendrá la tabla y en el modelo añadimos el _fillable_ con los campos.
- Ejecutamos la migración con: php artisan _migrate_

![Pasted image 20240126075640](https://github.com/Mileccc/crud/assets/121825748/e6adbb58-02e2-4440-82d8-906cd8ca6045)


#### CRUD parte 1
##### Creación de 2 ventanas con rutas conectadas

![Pasted image 20240126105036](https://github.com/Mileccc/crud/assets/121825748/699ad8ea-b548-4bb1-b294-200da976aff3)


##### Creación de notas desde la ventana

![Pasted image 20240126113518](https://github.com/Mileccc/crud/assets/121825748/cc9856cc-69f5-4dfc-acaa-3c0ac2589418)

![Pasted image 20240127075500](https://github.com/Mileccc/crud/assets/121825748/4f57e7f1-4bd4-4361-8361-8fa460ec0f09)



**OPCIONES PARA RECIBIR LA REQUEST**
- opción 1
```php
  public function store(Request $request){

    $note = new Note();
    $note->title = $request->title;
    $note->description = $request->description;
    $note->save();
    
    return redirect()->route('anote.index');
  }
```

- opción 2
```php
  public function store(Request $request){

    Note::create([
        'title' => $request->title,
        'description' => $request->description
    ]);
    
    return redirect()->route('anote.index');
  }
```

- opción 3
```php
  public function store(Request $request){

    Note::create($request->all());

    return redirect()->route('anote.index');
  }
```

##### Editar notas

- Al pasar en el link del Edit la ruta al ``anote.edit`` si fuese necesario pasar varios valores se podría pasar un array:
```php
<a href="{{ route('anote.edit', ['note' => $note->id])}}">EDIT</a>
```

![Pasted image 20240127080338](https://github.com/Mileccc/crud/assets/121825748/12b55229-ae34-4b32-b83e-47ae1d388b08)


![Pasted image 20240127080355](https://github.com/Mileccc/crud/assets/121825748/5d7538d9-37e5-43b1-af42-f4f9147051e9)


![Pasted image 20240127080408](https://github.com/Mileccc/crud/assets/121825748/f0970348-0f53-4487-aacf-5d4a1cb94825)


##### Añadiendo funcionalidad al botón Actualizar la nota
- Si solo queremos asignar algunos valores podemos hacerlo de la siguiente manera:
```php
public function update(Request $request, $nite)
{
	$note = Note::find($note);
	$note->title = $request->title; 
	$note->description = $request->descrition;
	$note->save();
}
```

![Pasted image 20240127101107](https://github.com/Mileccc/crud/assets/121825748/74cbcf24-6c9d-40f5-8454-9c1f49d5eda6)


##### Mostrar la información de las notas

![Pasted image 20240127102835](https://github.com/Mileccc/crud/assets/121825748/be9fda0c-dfb6-49d7-9e8d-68650397d0d5)


![Pasted image 20240127104523](https://github.com/Mileccc/crud/assets/121825748/c9987970-2023-42ff-9084-e3534468684c)


##### Borrar una nota

![Pasted image 20240127104337](https://github.com/Mileccc/crud/assets/121825748/e831a192-3c32-424f-9220-1bd5914973fe)


![Pasted image 20240127104450](https://github.com/Mileccc/crud/assets/121825748/122ee889-3d3d-45c2-a062-5572beb1bd0b)


##### Tipamos la información devuelta por el controlador

![Pasted image 20240127105317](https://github.com/Mileccc/crud/assets/121825748/0f2f2270-75e7-4e3d-a493-8e4ee75ee65f)


#### Validación y Custom Request
##### Validación opcional en el controlador(no recomendada)

![Pasted image 20240127111055](https://github.com/Mileccc/crud/assets/121825748/f0594c2a-c62a-4536-99dd-d78938632885)


##### Validación recomendada
- Desde consola ejecutamos :
```
php artisan make:request NoteRequest
```

![Pasted image 20240127113833](https://github.com/Mileccc/crud/assets/121825748/64bf6ddc-dc4f-4d20-b854-5ec89c8a1a02)



#### Gestión de errores
- Se puede marcar en un estilo inline una clase para estilos error especifico con
```php
<p style="color:red;">{{ $message }} class="@error('title') danger @enderror" </p>
```

- Tambien podemos hacer un tratamiento generalista de los errores con:
```php
@if($errors->any())
<ul>
    @foreach($errors->all() as $err)
    <li>{{ $err }}</li>
    @endforeach
</ul>
@endif
```

![Pasted image 20240128074951](https://github.com/Mileccc/crud/assets/121825748/dd30090e-8c0c-4699-a6c7-7b8cc4b5f5f1)


![Pasted image 20240128080132](https://github.com/Mileccc/crud/assets/121825748/52982d91-2708-42cc-a06f-46a46fc79746)


#### Mensajes de sesión

![Pasted image 20240128082554](https://github.com/Mileccc/crud/assets/121825748/4e9b1d9d-2825-4497-8e4a-641183153c71)


![Pasted image 20240128080218](https://github.com/Mileccc/crud/assets/121825748/8ed15857-fc4e-4429-885e-0e35ddcc0158)


![Pasted image 20240128080240](https://github.com/Mileccc/crud/assets/121825748/2003cc53-e6bd-44d4-a046-11222e9ce0ad)



#### Rutas y Controladores Resource

##### Routes
- Podemos abreviar el crud tanto de las _rutas_ como de los _controladores_ usando ``resource``.
- Con ``resource`` no representamos una única ruta, si no un conjunto de rutas:
```php
Route::resource('post', PostController:_:class);
```
- Podemos _visualizar todas las rutas_ en nuestro proyecto y podemos observar como con resource se están generando automáticamente muchas rutas ejecutando en consola:

```bash
php artisan route:list
```

![Pasted image 20240128084125](https://github.com/Mileccc/crud/assets/121825748/ba54caa9-6bcf-495b-89ac-3e05c24963b7)


##### Controller
- Para abreviar la creación del controlador ejecutaremos en consola:
```bash
php artisan make:controller PostController --resource
```

- Creará automáticamente en la carpeta ``Controllers`` un controlador con todas las funciones ya creadas de los CRUD

```php
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

```


