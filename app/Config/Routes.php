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
    $routes->post('proses-login', 'AuthController::loginCheck');
    $routes->get('register', 'AuthController::register');
    $routes->post('proses-register', 'AuthController::registerCheck');
    $routes->get('logout', 'AuthController::logout', ['filter' => 'auth']);
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->post('send-code', 'VerificationController::sendVerificationCode');
    $routes->get('enter-code', 'AuthController::enterCode');
    $routes->post('verify-code', 'AuthController::verifyCode');
    $routes->get('reset-password', 'AuthController::resetPassword');
    $routes->post('confirm-password', 'AuthController::confirmPassword');
});

//Bagan / Chart
$routes->get("/donut", "ChartController::donutChart");
$routes->get("/column", "ChartController::columnChart");