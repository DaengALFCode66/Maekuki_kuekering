<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('api/checkout', 'CheckoutController::process');
// Route untuk Panel Admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    // Login / Logout
    $routes->get('/', 'AuthController::index');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');

    // Dashboard dan Produk
    $routes->get('dashboard', 'DashboardController::index');
    $routes->resource('produk', ['controller' => 'ProdukController']); // Untuk CRUD Produk

    // Manajemen Pesanan
    $routes->get('pesanan', 'PesananController::index');
    $routes->post('pesanan/update/(:num)', 'PesananController::update/$1'); // Untuk update status

    // RUTE BARU: Menampilkan halaman Edit Pesanan
    $routes->get('pesanan/(:num)/edit', 'PesananController::edit/$1');

    // RUTE BARU: DELETE PESANAN
    $routes->delete('pesanan/(:num)', 'PesananController::delete/$1'); // <-- TAMB
});
