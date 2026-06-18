<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\Auth;
use App\Controllers\Admin;

/** @var RouteCollection $routes */

// Route Publik (Mahasiswa)
$routes->get('/', [Home::class, 'index']);
$routes->get('/daftar-ormawa', [Home::class, 'daftar']);
$routes->get('/ormawa/(:num)', [Home::class, 'detail/$1']);

// Route Autentikasi
$routes->get('/login', [Auth::class, 'login']);
$routes->post('/loginProcess', [Auth::class, 'loginProcess']);
$routes->get('/logout', [Auth::class, 'logout']);

// Route Admin (Diproteksi Filter Auth)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
  $routes->get('/', [Admin::class, 'index']);
  $routes->get('create', [Admin::class, 'create']);
  $routes->post('store', [Admin::class, 'store']);
  $routes->get('edit/(:num)', [Admin::class, 'edit/$1']);
  $routes->post('update/(:num)', [Admin::class, 'update/$1']);
  $routes->get('delete/(:num)', [Admin::class, 'delete/$1']);
});
