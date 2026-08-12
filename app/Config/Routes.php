<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login/verificar_usuario', 'LoginController::verificar_usuario');
$routes->setAutoRoute(true);
