<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'HomeController::index', ['filter' => 'auth']);

$routes->group('transaksi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'TransaksiController::index');
    $routes->match(['get', 'post'], 'create', 'TransaksiController::create');
    $routes->match(['get', 'post'], 'update/(:num)', 'TransaksiController::update/$1');
    $routes->post('delete/(:num)', 'TransaksiController::delete/$1');
});

$routes->group('data-master', ['filter' => 'auth'], function ($routes) {

    //Marketing
    $routes->group('marketing', function ($routes) {
        $routes->get('/', 'DataMasterController::index_marketing');
        $routes->match(['get', 'post'], 'create', 'DataMasterController::create_marketing');
        $routes->match(['get', 'post'], 'update/(:num)', 'DataMasterController::update_marketing/$1');
        $routes->post('delete/(:num)', 'DataMasterController::delete_marketing/$1');
    });

    //Commodity
    $routes->group('commodity', function ($routes) {
        $routes->get('/', 'DataMasterController::index_commodity');
        $routes->match(['get', 'post'], 'create', 'DataMasterController::create_commodity');
        $routes->match(['get', 'post'], 'update/(:num)', 'DataMasterController::update_commodity/$1');
        $routes->post('delete/(:num)', 'DataMasterController::delete_commodity/$1');
    });

    //Location
    $routes->group('location', function ($routes) {
        $routes->get('/', 'DataMasterController::index_lokasi');
        $routes->match(['get', 'post'], 'create', 'DataMasterController::create_lokasi');
        $routes->match(['get', 'post'], 'update/(:num)', 'DataMasterController::update_lokasi/$1');
        $routes->post('delete/(:num)', 'DataMasterController::delete_lokasi/$1');
    });
});

$routes->group('auth', function ($routes) {
    // Login
    $routes->get('login', 'AuthController::login');
    $routes->post('proses-login', 'AuthController::loginCheck');

    // Register
    $routes->get('register', 'AuthController::register');
    $routes->post('proses-register', 'AuthController::registerCheck');

    // Logout
    $routes->get('logout', 'AuthController::logout', ['filter' => 'auth']);

    // Forgot Password
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->post('send-code', 'VerificationController::sendVerificationCode');
    $routes->get('enter-code', 'AuthController::enterCode');
    $routes->post('verify-code', 'AuthController::verifyCode');
    $routes->get('reset-password', 'AuthController::resetPassword');
    $routes->post('confirm-password', 'AuthController::confirmPassword');
});
