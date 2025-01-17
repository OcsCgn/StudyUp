<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->get('/(:num)','UserController::index/$1');

$routes->get('delete/(:num)','UserController::delete/$1');
//$routes->get('/userModif/(:num)','UserController::update/$1');
$routes->put('/user/update/(:num)', 'UserController::update/$1');
$routes->put('/user/create','UserController::Create');