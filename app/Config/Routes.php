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
    $routes->get('data-product/detail-product/(:num)', 'ControllerProduct::detail/$1');
    $routes->get('data-product/detail-product/(:num)/(:num)?/(:any)?', 'ControllerProduct::detail/$1');
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

$routes->group('trx', ['filter' => 'auth'], function($routes) {
    $routes->get('data-trx', 'ControllerTrx::index');
    $routes->get('data-trx/(:num)?/(:any)?', 'ControllerTrx::index');
    $routes->get('data-trx/(:any)', 'ControllerTrx::detail/$1');
    $routes->get('trx-confirm', 'ControllerTrx::confirm_trx');
    $routes->get('trx-confirm/(:any)', 'ControllerTrx::detail_confirm_trx/$1');
    $routes->post('trx-confirm', 'ControllerTrx::action_confirm_trx');
});

$routes->group('user', ['filter' => 'auth'], function($routes) {
    $routes->get('data-user', 'ControllerUser::index');
    $routes->get('data-user/(:num)?/(:any)?', 'ControllerUser::index');
    $routes->get('data-user/(:num)', 'ControllerUser::detail/$1');
});

$routes->group('supplier', ['filter' => 'auth'], function($routes) {
    $routes->get('data-supplier', 'ControllerSupplier::index');
    $routes->get('data-supplier/(:num)?/(:any)?', 'ControllerSupplier::index');
    $routes->get('data-supplier/add-supplier', 'ControllerSupplier::add');
    $routes->post('data-supplier', 'ControllerSupplier::save');
    $routes->get('data-supplier/edit-supplier/(:num)', 'ControllerSupplier::edit/$1');
    $routes->put('data-supplier', 'ControllerSupplier::update');
    $routes->get('data-supplier/(:num)', 'ControllerSupplier::delete/$1');
    
    $routes->get('data-buyer', 'ControllerBuyer::index');
    $routes->get('data-buyer/(:num)?/(:any)?', 'ControllerBuyer::index');
    $routes->get('data-buyer/add-buyer', 'ControllerBuyer::add');
    $routes->post('data-buyer', 'ControllerBuyer::save');
    $routes->get('data-buyer/edit-buyer/(:num)', 'ControllerBuyer::edit/$1');
    $routes->put('data-buyer', 'ControllerBuyer::update');
    $routes->get('data-buyer/(:num)', 'ControllerBuyer::delete/$1');
});