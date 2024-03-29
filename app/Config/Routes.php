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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::view');
//login
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/register', 'LoginController::register');
$routes->post('/saveregister', 'LoginController::saveRegister');
//petugas
$routes->get('/petugas','petugasController::index');
$routes->post('/petugas','petugasController::simpan');
$routes->get('petugas/hapus/(:segment)','petugasController::delete/$1');
$routes->post('petugas/edit/(:segment)','petugasController::edit/$1');
//masyarakat
$routes->get('/masyarakat','masyarakatController::index');
$routes->post('/masyarakat','masyarakatController::simpan');
$routes->get('masyarakat/hapus/(:segment)','masyarakatController::delete/$1');
$routes->add('masyarakat/edit/(:segment)','masyarakatController::edit/$1');

$routes->post('/tanggapi','TanggapanController::simpan');
$routes->get('/getTanggapan','TanggapanController::getTanggapan');
$routes->get('/pengaduan','pengaduanController::index');
$routes->post('/tambahpengaduan','pengaduanController::simpan');
$routes->get('/pengaduan/hapus/(:segment)','pengaduanController::hapus/$1');

$routes->get('/profil','LoginController::lihatprofil');
$routes->post('/editprofil','LoginController::editprofil');


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
