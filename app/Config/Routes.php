<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLoggedin' ]);
$routes->get('/dashboard/(:any)', 'Dashboard::$1', ['filter' => 'isLoggedin' ]);
$routes->get('/profile', 'Profile::index', ['filter' => 'isLoggedin' ]);
$routes->get('/profile/(:any)', 'Profile::$1', ['filter' => 'isLoggedin' ]);
$routes->get('/manajemenkas', 'Manajemenkas::index', ['filter' => 'isLoggedin' ]);
$routes->get('/manajemenkas/(:any)', 'Manajemenkas::$1', ['filter' => 'isLoggedin' ]);
$routes->Delete('/manajemenkas/(:segment)', 'Manajemenkas::destroy/$1', ['filter' => 'isLoggedin' ]);
// $routes->get('/produksi', 'Produksi::index', ['filter' => 'isLoggedin' ]);
// $routes->get('/produksi/(:any)', 'Manajemenkas::$1', ['filter' => 'isLoggedin' ]);
// $routes->Delete('/produksi/(:segment)', 'Manajemenkas::destroy/$1', ['filter' => 'isLoggedin' ]);
$routes->get('/admin', 'Admin::index', ['filter' => 'isLoggedin' ]);
$routes->get('/admin/(:any)', 'Admin::$1', ['filter' => 'isLoggedin' ]);
$routes->Delete('/admin/(:segment)', 'Admin::destroy/$1', ['filter' => 'isLoggedin' ]);
$routes->get('/keuangan', 'Keuangan::index', ['filter' => 'isLoggedin' ]);
$routes->get('/keuangan/(:any)', 'Keuangan::$1', ['filter' => 'isLoggedin' ]);
$routes->Delete('/keuangan/(:segment)', 'Keuangan::destroy/$1', ['filter' => 'isLoggedin' ]);
$routes->get('/gudang', 'Gudang::index', ['filter' => 'isLoggedin' ]);
$routes->get('/gudang/(:any)', 'Gudang::$1', ['filter' => 'isLoggedin' ]);
$routes->Delete('/gudang/(:segment)', 'Gudang::destroy/$1', ['filter' => 'isLoggedin' ]);
$routes->get('/pembelian', 'Pembelian::index', ['filter' => 'isLoggedin' ]);
$routes->get('/pembelian/(:any)', 'Pembelian::$1', ['filter' => 'isLoggedin' ]);
$routes->Delete('/pembelian/(:segment)', 'Pembelian::destroy/$1', ['filter' => 'isLoggedin' ]);




// $routes->group('',['filter' => 'isLoggedin'], function ($routes) {
// 	$routes->get('', 'dashboard::index');
// 	$routes->get('index', 'dashboard::index');
// 	$routes->get('profile/change_password', 	'profile::change_password');
// 	$routes->get('profile/edit_profil', 'profile::edit_profil');
// });

// $routes->group('',['filter' => 'isLoggedin'], function ($routes) {
// 	$routes->get('', 'profile::index');
// 	$routes->get('index', 'profile::index');
// 	$routes->get('profile/change_password', 	'profile::change_password');
// 	$routes->get('profile/edit_profil', 'profile::edit_profil');
// });

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}