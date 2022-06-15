# Router

El proceso de enrutamiento consiste en hacer coincidir un URI con una acción. El módulo de enrutamiento es responsable de asignar las solicitudes entrantes del navegador a las acciones particulares del controlador. Básicamente, estamos tratando de enviar todas las solicitudes realizadas al servidor a un solo archivo, al ```index.php``` en el directorio raíz de la aplicación.

Esta característica se puede lograr agregando una configuración de servidor web según el servidor que elija.

## Apache - .htaccess

Este es un ejemplo básico de un archivo htaccess. Básicamente, redirige todas las solicitudes a nuestro archivo index.php.

```.htaccess
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [L]
```

Guardar como ```.htaccess``` en el mismo directorio que su "archivo raíz".

## Enrutamiento

El enrutador de **Plume** usa un solo archivo raíz, al que se redireccionan todas las solicitudes del servidor, luego toma estas solicitudes y las compara con las reglas que ha definido. A continuación, muestran los resultados al usuario.

## Clase de enrutador

La clase de enrutador es la interfaz con la que interactúa para realizar cualquier acción de enrutamiento en su aplicación. 

```php
$rute = new Plume\Kernel\Router\Rute;

$rute->get('/', function(){
    echo 'Hola Mundo!';
});

$rute->routing();
```

## Creando Rutas

Puede definir rutas de aplicaciones utilizando métodos proxy en la instancia de ```Plume\Kernel\Router\Rute```. **Plume** admite diferentes tipos de solicitudes, veámoslas.

### GET

Puede agregar una ruta que maneje solo solicitudes GET HTTP con el método ```get()```. Acepta dos argumentos:

- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE).
- La devolución de llamada de la ruta.

```php
$rute->get('/home', function(){
    //Tu código
});
```

### POST

Puede agregar una ruta que maneje solo solicitudes POST HTTP con el método ```post()```. Acepta dos argumentos:

- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE).
- La devolución de llamada de la ruta.

```php
$rute->post('/home', function(){
    //Tu código
});
```

### Varios métodos

Puede agregar una ruta que maneje varias solicitudes HTTP con el método ```map()```. Acepta tres argumentos:

- Matriz con los valores de los métodos permitidos.
- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE).
- La devolución de llamada de la ruta.

```php
$rute->map(['get', 'post'], '/home', function(){
    //Tu código
});
```

### Cualquier solicitud

Puede agregar una ruta que acepte cualquiera de las solicitudes HTTP con el método ```any()```. Acepta dos argumentos:

- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE).
- La devolución de llamada de la ruta.

```php
$rute->any('/home', function(){
    //Tu código
});
```

## Devolución de llamada de la ruta

Cada método de enrutamiento descrito anteriormente acepta una rutina de devolución de llamada como argumento final.

### Clousure

Puede usar una función anónima, o Cierre, como el destino al que se asigna una ruta. Esta función será ejecutada cuando el usuario visita ese URI. Esto es útil para ejecutar rápidamente tareas pequeñas, o incluso para mostrar una vista sencilla:

```php
$rute->get('/', function(){
    //Tu código
});
```

### Controlador

También puede usar una matriz con los valores del controlador y el método a instanciar como destino de la ruta asigna. Normalmente esta matriz acepta dos posiciones siendo la primera posición el controlador a ser instanciado y la segunda posición el método a ser cargado.

```php
$rute->get('/', [Foo\Bar\MyController::class,'index']);
```

El método ```index()``` del controlador definido se cargara de manera predeterminada solamente definiendo una matriz de una sola posición.

```php
$rute->get('/', [Foo\Bar\MyController::class]);
$rute->get('/', ['Foo\Bar\AnotherController']);
```

### Agrupar rutas

Puedes agrupar tus rutas bajo un nombre común con el método ```group()``. Esto le permite reducir la escritura necesaria para construir un amplio conjunto de rutas que comparten la cadena de apertura, como cuando se construye un área de administración:

```php
$rute->group('/admin', function($rute)
{
    $rute->get('/blogs', function(){
        echo 'ADMIN DASHBOARD';
    });
    $rute->get('/users', [Foo\Bar\Controller::class,'user']);
});
```

## Marcadores de posición

A veces necesitará capturar segmentos del URI dentro de su ruta. Por ejemplo, es posible que deba capturar la ID de un usuario de la URL. Puede hacerlo definiendo parámetros de ruta como marcadores de posición:

```php
$rute->get('/user/(:num)', function($id){
    return "User id: $id";
});
```

Puede definir tantos parámetros de ruta como requiera su ruta:

```php
$rute->get('/posts/(:num)/comments/(:alpha)', function($postId, $comment){
    //Tu código
});
```

Los parámetros de ruta siempre serán representados como marcadores de posición, estos se inyectan en las devoluciones de llamada/controladores de ruta en función de su orden; los nombres de los argumentos de devolución de llamada/controlador de ruta no importan.

Los marcadores de posición son simplemente cadenas que representan un patrón de expresión regular durante el proceso de enrutamiento, estos marcadores de posición se reemplazan  con el valor de la expresión regular.

A continuación los marcadores de posición que están disponibles para su uso en rutas:

|Marcadores  |Descripción                                    |
|------------|-----------------------------------------------|
|(:any)      |Adminte cualquier carácter excepto la barra(/) |
|(:alphanum) |Admite caracteres alfanuméricos                |
|(:num)      |Admite caracteres numéricos                    |
|(:alpha)    |Admite caracteres alfabéticos                  |

## Creación de rutas como matriz de datos

En lugar de definir las rutas una por una puede pasarlas todas como una de datos asociativos a través del método ```setAll()```.

```php
$rute_array = [
    '/' => [
        'method' => 'get',
        'action' => ['Foo\\Bar\\MyController']
    ],
    '/form' => [
        'method' => ['get','post'],
        'action' => ['Foo\\Bar\\MyController', 'form']
    ],
    '/hello/(:alphanum)' => [
        'method' => '*',
        'action' => function($user){echo "Hola $user";}
    ]
];

$rute->setAll($rute_array);
```

Utilice el método ```getAll()``` para visualizar todas las rutas registradas .

```php
$rute->getAll();
```

### Ejecutando tus rutas

Después de configurar todas las rutas, deberá despachar las rutas. Esto se logra a través del método ```routing()```.

```php
$rute->routing();
```
