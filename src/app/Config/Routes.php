<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ruta principal (La raíz de tu web)
$routes->get('/', 'Home::index');

// Rutas para el sistema de Login
$routes->get('/login', 'Login::index');
$routes->post('/login/procesar', 'Login::procesar');
$routes->get('/logout', 'Login::logout');