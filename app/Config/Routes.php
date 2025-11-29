<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Route untuk Panel Admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    // Login / Logout
    $routes->get('/', 'AuthController::index');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');

    // Dashboard dan Produk
    $routes->get('dashboard', 'DashboardController::index');
    $routes->resource('produk', ['controller' => 'ProdukController']); // Untuk CRUD Produk
});