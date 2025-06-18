<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas de Autenticación (Web y API)
$routes->get('auth/login', 'Auth::loginForm');     // Muestra formulario login
$routes->post('auth/login', 'Auth::login');        // Procesa login
$routes->post('api/login', 'Api\Auth::login');     // Procesa login vía API (JWT)

// Rutas protegidas por JWT para API
$routes->group('api', ['filter' => 'jwt'], function ($routes) {
    $routes->get('perfil', 'Api\Home::perfil');    // Perfil del usuario autenticado
    $routes->get('usuarios', 'Api\Home::index');   // Lista de usuarios
});

// Rutas del módulo de Clientes (vinculados a un usuario)
$routes->get('clientes/index/(:num)', 'Clientes::index/$1');
$routes->get('clientes/new/(:num)', 'Clientes::new/$1');
$routes->post('clientes/create/(:num)', 'Clientes::create/$1');
$routes->get('clientes/edit/(:num)', 'Clientes::edit/$1');
$routes->post('clientes/update/(:num)', 'Clientes::update/$1');
$routes->get('clientes/delete/(:num)', 'Clientes::delete/$1');

// Rutas del módulo de Productos o Servicios (vinculados a un usuario)
$routes->get('productos/(:num)', 'ProductosController::index/$1');
$routes->get('productos/(:num)/new', 'ProductosController::new/$1');
$routes->post('productos/(:num)/store', 'ProductosController::store/$1');
$routes->get('productos/edit/(:num)', 'ProductosController::edit/$1');
$routes->put('productos/update/(:num)', 'ProductosController::update/$1');
$routes->get('productos/delete/(:num)', 'ProductosController::delete/$1');

$routes->get('catalogo', 'CatalogoController::index');

// Ruta raíz
$routes->get('/', 'Home::index');

// CRUD de Usuarios (excepto show)
$routes->resource('usuarios', [
    'placeholder' => '(:num)',
    'except' => ['show']
]);
