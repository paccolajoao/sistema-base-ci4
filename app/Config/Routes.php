<?php

namespace Config;

use App\Controllers\Dashboard;
use App\Controllers\Desenvolvimento;
use App\Controllers\Login;
use App\Controllers\Usuario;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
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

/*
 * --------------------------------------------------------------------
 * Dashboard
 * --------------------------------------------------------------------
 */
$routes->get('/', [Dashboard::class, 'index']);
$routes->get('dashboard', [Dashboard::class, 'index']);

/*
 * --------------------------------------------------------------------
 * Login Logout
 * --------------------------------------------------------------------
 */
$routes->group('login', static function ($routes) {
    $routes->get('/', [Login::class, 'index']);
    $routes->post('realizarlogin', [Login::class, 'realizarLogin']);
});

/*
 * --------------------------------------------------------------------
 * Development (Test)
 * --------------------------------------------------------------------
 */

$routes->group('desenvolvimento', static function ($routes) {
    $routes->get('/', [Desenvolvimento::class, 'index']);
    $routes->get('add', [Desenvolvimento::class, 'add']);
    $routes->get('data', [Desenvolvimento::class, 'getFuncionarios']);
    $routes->post('create', [Desenvolvimento::class, 'createUser']);
});

/*
 * --------------------------------------------------------------------
 * Usuários
 * --------------------------------------------------------------------
 */

$routes->group('usuarios', static function ($routes) {
    $routes->get('/', [Usuario::class, 'index']);
    $routes->get('add', [Usuario::class, 'add']);
    $routes->get('add/(:num)', [Usuario::class, 'add']);
    $routes->get('data', [Usuario::class, 'getUsers']);
    $routes->post('create', [Usuario::class, 'createUser']);
    $routes->post('create/(:num)', [Usuario::class, 'createUser']);
    $routes->post('delete/(:num)', [Usuario::class, 'deleteUser']);
});

/*
 * --------------------------------------------------------------------
 * Erros
 * --------------------------------------------------------------------
 */

$routes->group('errors', static function ($routes) {
    $routes->get('404', [Error::class, 'error404']);
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
