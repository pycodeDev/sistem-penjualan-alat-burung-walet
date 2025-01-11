<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/tes', 'Home::tes');
$routes->get('/graph', 'ControllerTrx::graph');
$routes->get('client', function() {
    return redirect()->to('/client/home');
});
$routes->get('/', function() {
    return redirect()->to('/client/home');
});

$routes->group('report', function($routes) {
    $routes->get('supplier/view', 'ControllerReport::index');
    $routes->get('trx/view', 'ControllerReport::indexTrx');
    $routes->get('product/view', 'ControllerReport::indexStock');
    $routes->get('supplier', 'ControllerReport::exportPdf');
    $routes->get('product', 'ControllerReport::exportPdfStok');
    $routes->get('trx', 'ControllerReport::exportPdfTrx');
});

$routes->group('report-view', function($routes) {
    $routes->get('supplier', 'ControllerReport::index_view_supplier');
    $routes->get('trx', 'ControllerReport::index_view_trx');
    $routes->get('stok', 'ControllerReport::index_view_product');
});


$routes->get('/admin', 'ControllerAdmin::index');
$routes->get('admin/data-admin', 'ControllerAdmin::index_admin');
$routes->get('admin/data-admin/(:num)?/(:any)?', 'ControllerAdmin::index_admin/$1/$2');
$routes->get('admin/data-admin/add-admin', 'ControllerAdmin::add_admin');
$routes->post('admin/data-admin', 'ControllerAdmin::save_admin');
// $routes->get('/user', 'Home::tes');
$routes->get('upload/(:any)', 'ControllerTrx::show/$1');

$routes->get('/dashboard', 'Home::index', ['filter' => 'auth']);

$routes->group('auth', function($routes) {
    $routes->get('index', 'ControllerAdmin::index');
    $routes->post('index', 'ControllerAdmin::login');
    $routes->get('logout', 'ControllerAdmin::logout');
});
$routes->group('product', ['filter' => 'auth'], function($routes) {
    $routes->get('data-product', 'ControllerProduct::index');
    $routes->get('data-product/(:num)?/(:any)?', 'ControllerProduct::index/$1/$2');
    $routes->get('data-product/detail-product/(:num)', 'ControllerProduct::detail/$1');
    $routes->get('data-product/detail-product/(:num)/(:num)?/(:any)?', 'ControllerProduct::detail/$1');
    $routes->get('data-product/add-product', 'ControllerProduct::add');
    $routes->post('data-product/add-product', 'ControllerProduct::save');
    $routes->get('data-product/edit-product/(:num)', 'ControllerProduct::edit/$1');
    $routes->post('data-product/edit-product', 'ControllerProduct::update');
    $routes->get('data-product/(:num)', 'ControllerProduct::delete/$1');

    $routes->get('category-product', 'ControllerProductCategory::index');
    $routes->get('category-product/(:num)?/(:any)?', 'ControllerProductCategory::index/$1/$2');
    $routes->get('category-product/add-category-product', 'ControllerProductCategory::add');
    $routes->post('category-product/add-category-product', 'ControllerProductCategory::save');
    $routes->get('category-product/edit-category-product/(:num)', 'ControllerProductCategory::edit/$1');
    $routes->post('category-product/edit-category-product', 'ControllerProductCategory::update');
    $routes->get('category-product/(:num)', 'ControllerProductCategory::delete/$1');
});

$routes->group('payment', ['filter' => 'auth'], function($routes) {
    $routes->get('data-payment', 'ControllerPaymentMethod::index');
    $routes->get('data-payment/(:num)?/(:any)?', 'ControllerPaymentMethod::index/$1/$2');
    $routes->get('data-payment/add-payment', 'ControllerPaymentMethod::add');
    $routes->post('data-payment/add-payment', 'ControllerPaymentMethod::save');
    $routes->get('data-payment/edit-payment/(:num)', 'ControllerPaymentMethod::edit/$1');
    $routes->post('data-payment/edit-payment', 'ControllerPaymentMethod::update');
    $routes->get('data-payment/(:num)', 'ControllerPaymentMethod::delete/$1');
});

$routes->group('trx', ['filter' => 'auth'], function($routes) {
    $routes->get('data-trx', 'ControllerTrx::index');
    $routes->get('data-trx/(:num)?/(:any)?', 'ControllerTrx::index/$1/$2');
    $routes->get('data-trx/(:any)', 'ControllerTrx::detail/$1');
    $routes->get('trx-confirm', 'ControllerTrx::confirm_trx');
    $routes->get('trx-confirm/(:num)?/(:any)?', 'ControllerTrx::confirm_trx/$1/$2');
    $routes->get('trx-confirm/(:any)', 'ControllerTrx::detail_confirm_trx/$1');
    $routes->post('trx-confirm', 'ControllerTrx::action_confirm_trx');
});

$routes->group('user', ['filter' => 'auth'], function($routes) {
    $routes->get('data-user', 'ControllerUser::index');
    $routes->get('data-user/(:num)?/(:any)?', 'ControllerUser::index/$1/$2');
    $routes->get('data-user/(:num)', 'ControllerUser::detail/$1');
    $routes->get('data-user/(:num)/(:num)?/(:any)?', 'ControllerUser::detail/$1/$2/$3');
    $routes->post('get-rek', 'ControllerUser::get_rek');
});

$routes->group('supplier', ['filter' => 'auth'], function($routes) {
    $routes->get('data-supplier', 'ControllerSupplier::index');
    $routes->get('data-supplier/(:num)?/(:any)?', 'ControllerSupplier::index/$1/$2');
    $routes->get('data-supplier/add-supplier', 'ControllerSupplier::add');
    $routes->post('data-supplier', 'ControllerSupplier::save');
    $routes->get('data-supplier/edit-supplier/(:num)', 'ControllerSupplier::edit/$1');
    $routes->put('data-supplier', 'ControllerSupplier::update');
    $routes->get('data-supplier/(:num)', 'ControllerSupplier::delete/$1');
    
    $routes->get('data-buyer', 'ControllerBuyer::index');
    $routes->get('data-buyer/(:num)?/(:any)?', 'ControllerBuyer::index/$1/$2');
    $routes->get('data-buyer/add-buyer', 'ControllerBuyer::add');
    $routes->post('data-buyer', 'ControllerBuyer::save');
    $routes->get('data-buyer/edit-buyer/(:num)', 'ControllerBuyer::edit/$1');
    $routes->put('data-buyer', 'ControllerBuyer::update');
    $routes->get('data-buyer/(:num)', 'ControllerBuyer::delete/$1');
});

$routes->group('client', function($routes) {
    $routes->get('login', 'Home::login');
    $routes->post('login', 'Home::p_login');
    $routes->get('register', 'Home::register');
    $routes->post('register', 'Home::p_register');
    $routes->get('rekening', 'ControllerUser::add_rekening');
    $routes->get('setting', 'ControllerUser::settings_profile');
    
    $routes->get('home', 'ControllerUser::dashboard_user');
    $routes->get('home/(:num)/(:any)', 'ControllerUser::dashboard_user/$1/$2');

    $routes->group('cart', function($routes) {
        $routes->get('/', 'ControllerCart::index');
        $routes->post('/', 'ControllerCart::add');
        $routes->put('/', 'ControllerCart::edit');
        $routes->get('(:num)', 'ControllerCart::delete/$1');
    });
    
    $routes->group('product', function($routes) {
        $routes->get('/', 'ControllerProduct::client_index');
        $routes->get('(:num)/(:any)', 'ControllerProduct::client_index/$1/$2');
        $routes->get('(:num)', 'ControllerProduct::client_detail/$1');
    });
    
    $routes->get('search/product', 'ControllerProduct::client_index_search');
    
    $routes->group('trx', function($routes) {
        $routes->get('/', 'ControllerTrx::client_index');
        $routes->post('/', 'ControllerTrx::client_index');
        $routes->post('order', 'ControllerTrx::order');
        $routes->get('(:any)', 'ControllerTrx::client_detail/$1');
        $routes->post('upload', 'ControllerTrx::upload');
    });
    $routes->get('complete/trx/(:any)', 'ControllerTrx::complete_trx/$1');

    $routes->post('review/submit-comment', 'ControllerTrx::review');

    $routes->post('payment-submit', 'ControllerUser::save_rekening');

    $routes->get('logout', 'ControllerUser::logout');
});

