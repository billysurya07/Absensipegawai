<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index'); // Set rute default ke halaman login
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->get('logout', 'Login::logout');


$routes->get('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan', 'Admin\jabatan::index', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/create', 'Admin\jabatan::create', ['filter' => 'adminFilter']);
$routes->post('admin/jabatan/store', 'Admin\jabatan::store', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/edit/(:segment)', 'Admin\jabatan::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/jabatan/update/(:segment)', 'Admin\jabatan::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/delete/(:segment)', 'Admin\jabatan::delete/$1', ['filter' => 'adminFilter']);


$routes->get('pegawai/home', 'Pegawai\Home::index', ['filter' => 'pegawaiFilter']);


