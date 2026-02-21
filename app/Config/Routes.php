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

$routes->get('/register', 'Auth::showRegister');
$routes->post('/register', 'Auth::register');

$routes->get('/admin/users/create', 'AdminUsers::create');
$routes->post('/admin/users/create', 'AdminUsers::store');
