<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama (SPA Landing + Katalog + Detail)
$routes->get('/', 'Home::index');

// Grup Autentikasi
$routes->group('auth', function ($routes) {
    $routes->get('login',    'Auth::loginForm');      // Tampilkan form login
    $routes->post('login',   'Auth::login');          // Proses login → API
    $routes->get('register', 'Auth::registerForm');   // Tampilkan form register
    $routes->post('register', 'Auth::register');      // Proses register → API
    $routes->get('logout',   'Auth::logout');         // Logout
});

// Grup Data Motor (Akses Publik — fallback jika diakses via URL langsung)
$routes->group('motors', function ($routes) {
    $routes->get('/',       'Motors::index');
    $routes->get('(:num)',  'Motors::show/$1');
});

// Test Drive
$routes->get('test-drive',  'TestDrive::index');     // Tampilkan form
$routes->post('test-drive', 'TestDrive::create');    // Proses form → API

// Panel Admin (Wajib Login sebagai Admin)
$routes->group('admin', function ($routes) {
    $routes->get('motors',  'Admin\Motors::index');
    $routes->post('motors', 'Admin\Motors::create');
});