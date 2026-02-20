<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::show');
$routes->get('/login', 'Auth::show');
$routes->post('/login', 'Auth::authenticate');
