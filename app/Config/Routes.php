<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->group('transaksi', function ($routes) {
    $routes->get('/', 'TransaksiController::index');
});

$routes->group('data-master', function ($routes) {
    $routes->get('/', 'DataMasterController::index');
});

$routes->group('auth', function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->get('login', 'AuthController::login');
    $routes->get('register', 'AuthController::register');
    $routes->get('logout', 'AuthController::logout');
});
