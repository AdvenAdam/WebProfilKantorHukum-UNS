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
$routes->setDefaultController('Home');
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
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::index');
$routes->get('/ceklogin', 'Auth::login');

$routes->group('Admin', function ($routes) {
	$routes->get('/', 'Admin\Dashboard::index');
	//dokumen 
	$routes->group('Dokumen',  function ($routes) {
		$routes->get('/', 'Admin\DokumenController::index');
		$routes->get('create', 'Admin\DokumenController::create');
		$routes->post('save', 'Admin\DokumenController::save');
		$routes->post('update/(:any)', 'Admin\DokumenController::update/$1');
		$routes->post('delete/(:any)', 'Admin\DokumenController::delete/$1');
		$routes->get('detail/(:any)', 'Admin\DokumenController::detail/$1');
		$routes->get('edit/(:any)', 'Admin\DokumenController::edit/$1');
	});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
