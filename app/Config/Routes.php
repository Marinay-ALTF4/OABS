<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/login', 'Auth::show');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');
