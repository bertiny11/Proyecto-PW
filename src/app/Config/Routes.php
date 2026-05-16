<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- RUTAS PÚBLICAS ---
// Sistema de Login (Rama Bertini)
$routes->get('login', 'Login::index');
$routes->post('login/procesar', 'Login::procesar');
$routes->get('logout', 'Login::logout');

// --- ZONA PROTEGIDA (Requiere estar logueado) ---
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    
    // Ruta raíz protegida (redirige al dashboard correspondiente)
    $routes->get('/', 'Home::index');

    // Tu listado de libros (Dani)
    $routes->get('libros/listado', 'Libros::index');

    // Vistas de los Dashboards separadas por filtro de Rol
    $routes->get('admin/dashboard', 'Home::index', ['filter' => 'rol:Administrador']);
    $routes->get('usuario/dashboard', 'Home::index', ['filter' => 'rol:Usuario']);

    // Tu CRUD de Libros (Dani y Miriam)
    $routes->get('libros/crear', 'Libros::crear');
    $routes->post('libros/guardar', 'Libros::guardar');
    $routes->get('libros/editar/(:num)', 'Libros::editar/$1');
    $routes->post('libros/actualizar/(:num)', 'Libros::actualizar/$1');
    $routes->get('libros/borrar/(:num)', 'Libros::borrar/$1');
});