<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'HomeController::index', ['filter' => 'auth']);

$routes->group('transaksi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'TransaksiController::index');
});

$routes->group('data-master', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'DataMasterController::index');
});

$routes->group('auth', function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->get('login', 'AuthController::login');
    $routes->get('register', 'AuthController::register');
    $routes->get('logout', 'AuthController::logout', ['filter' => 'auth']);
});

//Bagan / Chart
$routes->get("/donut", "ChartController::donutChart");
$routes->get("/column", "ChartController::columnChart");