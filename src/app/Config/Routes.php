<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ruta principal (La raíz de tu web)
//$routes->get('/', 'Home::index');

// Rutas para el sistema de Login
$routes->get('/login', 'Login::index');
$routes->post('/login/procesar', 'Login::procesar');
$routes->get('/logout', 'Login::logout');

//$routes->get('/libros/listado', 'Libros::index');

// Zona protegida
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Home::index');

    $routes->get('/libros/listado', 'Libros::index');

    // Rutas separadas por rol, útiles si luego queréis enlazarlas directamente
    $routes->get('/admin/dashboard', 'Home::index', ['filter' => 'rol:Administrador']);
    $routes->get('/usuario/dashboard', 'Home::index', ['filter' => 'rol:Usuario']);
});