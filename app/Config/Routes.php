<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('mahasiswa', 'Mahasiswa::index');
$routes->get('mahasiswa/tambah', 'Mahasiswa::tambah');
$routes->post('mahasiswa/simpan', 'Mahasiswa::simpan');
$routes->get('mahasiswa/ubah/(:num)', 'Mahasiswa::ubah/$1');
$routes->post('mahasiswa/perbarui/(:num)', 'Mahasiswa::perbarui/$1');
$routes->post('mahasiswa/hapus/(:num)', 'Mahasiswa::hapus/$1');
