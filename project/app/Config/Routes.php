<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Grup Autentikasi (Tanpa Login)
$routes->group('auth', function($routes) {
    $routes->post('login', 'Auth::login');
    $routes->post('register', 'Auth::register');
});

// Grup Data Motor (Akses Publik)
$routes->group('motors', function($routes) {
    $routes->get('/', 'Motors::index');
    $routes->get('(:num)', 'Motors::show/$1');
});

// Grup Transaksi/Aksi Pengguna (Wajib Login/Auth)
$routes->post('test-drive', 'TestDrive::create');

// Grup Panel Admin (Wajib Login sebagai Admin)
$routes->group('admin', function($routes) {
    $routes->get('motors', 'Admin\Motors::index');
    $routes->post('motors', 'Admin\Motors::create');
});