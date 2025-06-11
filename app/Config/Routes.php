<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('auth/login', 'Auth::loginForm');  // muestra el formulario
$routes->post('auth/login', 'Auth::login');     // procesa el login
$routes->post('api/login', 'Api\Auth::login'); // para procesar el login (API)

$routes->group('api', ['filter' => 'jwt'], function($routes) {
    $routes->get('perfil', 'Api\Home::perfil');  // solo accesible con JWT válido
    $routes->get('usuarios', 'Api\Home::index');
});

$routes->get('clientes/index/(:num)', 'Clientes::index/$1');
$routes->get('clientes/new/(:num)', 'Clientes::new/$1');
$routes->post('clientes/create/(:num)', 'Clientes::create/$1');
$routes->get('clientes/edit/(:num)', 'Clientes::edit/$1');
$routes->post('clientes/update/(:num)', 'Clientes::update/$1');
$routes->get('clientes/delete/(:num)', 'Clientes::delete/$1');



$routes->get('/', 'Home::index'); //ruta raiz

$routes->resource('usuarios', ['placeholder'=> '(:num)', 'except' => ['show']]);
 // Crea las rutas RESTful para el recurso 'usuarios' con el método Resource(), exceptuando 'show'. Esto crea las cinco rutas más comunes necesarias para el CRUD.


