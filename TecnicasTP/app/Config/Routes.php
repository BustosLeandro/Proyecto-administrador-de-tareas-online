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
 //$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/cerrarSesion', 'Home::cerrarSesion');

$routes->get('/login', 'login::index');
$routes->get('/login/enviado', 'login::enviado');
$routes->post('/login/enviado', 'login::enviado');

$routes->get('/registrarse', 'registrarse::index');
$routes->get('/registrarse/enviado', 'registrarse::enviado');
$routes->post('/registrarse/enviado', 'registrarse::enviado');
$routes->post('/registrarse/cambiarPassword/(:num)', 'registrarse::cambiarPassword/$1');

$routes->get('/tarea/(:num)', 'tarea::index/$1');
$routes->post('/tarea/formColor/(:num)', 'tarea::formColor/$1');
$routes->post('/tarea/formEstado/(:num)', 'tarea::formEstado/$1');
$routes->post('/tarea/formPrioridad/(:num)', 'tarea::formPrioridad/$1');
$routes->get('/tarea/crearTarea', 'tarea::crearTarea');
$routes->post('/tarea/formTarea/', 'tarea::formTarea');
$routes->get('/tarea/borrarTarea/(:num)', 'tarea::borrarTarea/$1');
$routes->get('/tarea/archivar/(:num)', 'tarea::archivar/$1');

$routes->get('/subtarea/(:num)', 'subtarea::index/$1');
$routes->post('/subtarea/formColor/(:num)', 'subtarea::formColor/$1');
$routes->post('/subtarea/formEstado/(:num)', 'subtarea::formEstado/$1');
$routes->post('/subtarea/formPrioridad/(:num)', 'subtarea::formPrioridad/$1');
$routes->get('/subtarea/crearSubtarea/(:num)', 'subtarea::crearSubtarea/$1');
$routes->post('/subtarea/formSubtarea/(:num)', 'subtarea::formSubtarea/$1');
$routes->get('/subtarea/borrarSubtarea/(:num)', 'subtarea::borrarSubtarea/$1');
$routes->post('/subtarea/formResponsable/(:num)', 'subtarea::formResponsable/$1');

$routes->get('/archivadas', 'archivadas::index');

$routes->get('/comentario/borrarComentario/(:num)/(:num)', 'comentario::borrarComentario/$1/$2');

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
