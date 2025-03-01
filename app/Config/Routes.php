<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('pelanggan', static function ($routes) {
    $routes->get('', 'Customer::index');
    $routes->get('tambah', 'Customer::create');
    $routes->post('store', 'Customer::store');
    $routes->get('ubah/(:num)', 'Customer::edit/$1');
    $routes->post('update', 'Customer::update');
    $routes->delete('delete', 'Customer::delete');
});

$routes->group('mobil', static function ($routes) {
    $routes->get('', 'Car::index');
    $routes->get('tambah', 'Car::create');
    $routes->post('store', 'Car::store');
    $routes->get('ubah/(:num)', 'Car::edit/$1');
    $routes->post('update', 'Car::update');
    $routes->delete('delete', 'Car::delete');
});

$routes->group('booking', static function ($routes) {
    $routes->get('', 'Booking::index');
    $routes->get('tambah', 'Booking::create');
    $routes->post('store', 'Booking::store');
    $routes->get('ubah/(:num)', 'Booking::edit/$1');
    $routes->post('update', 'Booking::update');
    $routes->delete('delete', 'Booking::delete');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
