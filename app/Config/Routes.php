<?php

namespace Config;

use PhpParser\Builder\Namespace_;

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
$routes->set404Override(function () {
	echo view('404.html');
});
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
$routes->post('/login', 'Auth::login');
$routes->post('/saveMasukan', 'Admin/KontakController::save');
$routes->get('/detailDokumen/(:any)', 'Home::detail/$1');
$routes->get('/Download/(:any)', 'Home::download/$1');
$routes->get('/Profil', 'Home::profil');
$routes->get('/StrukturOrganisasi', 'Home::struktur');
$routes->get('/ProdukHukum', 'Home::produkHukum');
$routes->get('/TugasPokok', 'Home::tugasPokok');


$routes->get('/logout', 'Auth::logout');
$routes->group('Admin', ["namespace" => "App\Controllers\Admin", 'filter' => 'ceklogin'], function ($routes) {
	$routes->get('/', 'Dashboard::index');

	$routes->group('Kategori',  function ($routes) {
		$routes->get('/', 'KategoriController::index');
		$routes->post('save', 'KategoriController::save');
		$routes->post('delete/(:num)', 'KategoriController::delete/$1');
		$routes->post('update/(:num)', 'KategoriController::update/$1');
	});

	$routes->group('SK',  function ($routes) {
		$routes->get('/', 'SkController::index');
		$routes->get('create', 'SkController::create');
		$routes->get('data', 'SkController::data');
		$routes->post('update/(:any)', 'SkController::update/$1');
		$routes->post('delete/(:any)', 'SkController::delete/$1');
		$routes->get('detail/(:any)', 'SkController::detail/$1');
		$routes->get('cetak/(:any)', 'SkController::cetak/$1');
		$routes->get('edit/(:any)', 'SkController::edit/$1');
		$routes->post('save', 'SkController::save');
	});

	$routes->group('User',  function ($routes) {
		$routes->get('/', 'UserManage::index');
		$routes->get('create', 'UserManage::create');
		$routes->post('save', 'UserManage::save');
		$routes->post('update/(:any)', 'UserManage::update/$1');
		$routes->post('delete/(:any)', 'UserManage::delete/$1');
		$routes->get('edit/(:any)', 'UserManage::edit/$1');
		$routes->post('editPass/(:any)', 'UserManage::ubahPassword/$1');
	});
	//dokumen 
	$routes->group('Dokumen',  function ($routes) {
		$routes->get('/', 'DokumenController::index');
		$routes->get('create', 'DokumenController::create');
		$routes->post('save', 'DokumenController::save');
		$routes->post('update/(:any)', 'DokumenController::update/$1');
		$routes->post('delete/(:any)', 'DokumenController::delete/$1');
		$routes->get('detail/(:any)', 'DokumenController::detail/$1');
		$routes->get('edit/(:any)', 'DokumenController::edit/$1');
	});
	//dokumen internal 
	$routes->group('DokumenInternal',  function ($routes) {
		$routes->get('/', 'DokumenInternController::index');
		$routes->post('save', 'DokumenInternController::save');
		$routes->get('download/(:any)', 'DokumenInternController::download/$1');
		$routes->post('update/(:any)', 'DokumenInternController::update/$1');
		$routes->post('delete/(:any)', 'DokumenInternController::delete/$1');
		$routes->get('detail/(:any)', 'DokumenInternController::detail/$1');
		$routes->get('edit/(:any)', 'DokumenInternController::edit/$1');
	});
	//peraturan
	$routes->group('Peraturan',  function ($routes) {
		$routes->get('/', 'PeraturanController::index');
		$routes->get('create', 'PeraturanController::create');
		$routes->get('edit/(:any)', 'PeraturanController::edit/$1');
		$routes->post('save', 'PeraturanController::save');
		$routes->post('update/(:any)', 'PeraturanController::update/$1');
		$routes->post('delete/(:any)', 'PeraturanController::delete/$1');
	});
	//herarki
	$routes->group('Herarki',  function ($routes) {
		$routes->get('/', 'HerarkiController::index');
		$routes->post('save', 'HerarkiController::save');
		$routes->post('update/(:any)', 'HerarkiController::update/$1');
		$routes->post('delete/(:any)', 'HerarkiController::delete/$1');
	});
	$routes->group('Struktur',  function ($routes) {
		$routes->get('/', 'StrukturOrganisasiController::index');
		$routes->post('update/(:any)', 'StrukturOrganisasiController::update/$1');
	});
	$routes->group('Informasi',  function ($routes) {
		$routes->get('/', 'InformasiController::index');
		$routes->post('update/(:num)', 'InformasiController::update/$1');
	});
	$routes->group('Masukan',  function ($routes) {
		$routes->get('/', 'KontakController::index');
		$routes->post('delete/(:num)', 'KontakController::delete/$1');
	});
	$routes->group('Slider',  function ($routes) {
		$routes->get('/', 'SliderController::index');
		$routes->get('create', 'SliderController::create');
		$routes->get('edit/(:any)', 'SliderController::edit/$1');
		$routes->post('delete/(:num)', 'SliderController::delete/$1');
		$routes->post('update/(:num)', 'SliderController::update/$1');
		$routes->post('save', 'SliderController::save');
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
