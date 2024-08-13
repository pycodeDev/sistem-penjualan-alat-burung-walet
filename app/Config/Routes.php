<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/tes', 'Home::prd');
$routes->get('/', 'ControllerAdmin::index');

$routes->get('/dashboard', 'Home::index', ['filter' => 'auth']);

$routes->group('auth', function($routes) {
    $routes->get('index', 'ControllerAdmin::index');
    $routes->post('index', 'ControllerAdmin::login');
    $routes->get('logout', 'ControllerAdmin::logout');
});
$routes->group('product', ['filter' => 'auth'], function($routes) {
    $routes->get('data-product', 'ControllerProduct::index');
    $routes->get('data-product/(:num)?/(:any)?', 'ControllerProduct::index');
    $routes->get('data-product/add-product', 'ControllerProduct::add');
    $routes->post('data-product/add-product', 'ControllerProduct::save');
    $routes->get('data-product/edit-product/(:num)', 'ControllerProduct::edit/$1');
    $routes->post('data-product/edit-product', 'ControllerProduct::update');
    $routes->get('data-product/(:num)', 'ControllerProduct::delete/$1');

    $routes->get('category-product', 'ControllerProductCategory::index');
    $routes->get('category-product/(:num)?/(:any)?', 'ControllerProductCategory::index');
    $routes->get('category-product/add-category-product', 'ControllerProductCategory::add');
    $routes->post('category-product/add-category-product', 'ControllerProductCategory::save');
    $routes->get('category-product/edit-category-product/(:num)', 'ControllerProductCategory::edit/$1');
    $routes->post('category-product/edit-category-product', 'ControllerProductCategory::update');
    $routes->get('category-product/(:num)', 'ControllerProductCategory::delete/$1');
});

$routes->group('payment', ['filter' => 'auth'], function($routes) {
    $routes->get('data-payment', 'ControllerPaymentMethod::index');
    $routes->get('data-payment/(:num)?/(:any)?', 'ControllerPaymentMethod::index');
    $routes->get('data-payment/add-payment', 'ControllerPaymentMethod::add');
    $routes->post('data-payment/add-payment', 'ControllerPaymentMethod::save');
    $routes->get('data-payment/edit-payment/(:num)', 'ControllerPaymentMethod::edit/$1');
    $routes->post('data-payment/edit-payment', 'ControllerPaymentMethod::update');
    $routes->get('data-payment/(:num)', 'ControllerPaymentMethod::delete/$1');
});