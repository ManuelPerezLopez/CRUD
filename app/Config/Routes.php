<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); //ruta raiz

$routes->resource('usuarios', ['placeholder'=> '(:num)', 'except' => ['show']]);
 // Crea las rutas RESTful para el recurso 'usuarios' con el método Resource(), exceptuando 'show'. Esto crea las cinco rutas más comunes necesarias para el CRUD.


