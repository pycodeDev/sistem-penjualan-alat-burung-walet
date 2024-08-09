<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::tes');
$routes->get('/tes', 'Home::prd');

$routes->group('product', function($routes) {
    $routes->get('data-product', 'ControllerProduct::index');
    $routes->get('data-product/(:num)?/(:any)?', 'ControllerProduct::index');
    $routes->get('add-product', 'ControllerProduct::add');
    $routes->get('edit-product/(:num)', 'ControllerProduct::edit');
    $routes->get('category-product', 'Home::prdd');
});
