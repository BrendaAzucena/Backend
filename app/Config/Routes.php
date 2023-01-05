<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->group('api',['namespace'=>'App\Controllers\API'], function ($routes){

    $routes->get('clientes','Clientes::index');
    $routes->get('clientes/(:num)','Clientes::show/$1');
     $routes->post('clientes/crear','Clientes::crear');
     $routes->put('clientes/editar/(:num)','Clientes::editar/$1');
     $routes->delete('clientes/eliminar/(:num)','Clientes::eliminar/$1');

     $routes->get('productos','Productos::index');
     $routes->get('productos/(:num)','Productos::show/$1');
     $routes->post('productos/crear','Productos::crear');
     $routes->put('productos/editar/(:num)','Productos::editar/$1');
     $routes->delete('productos/eliminar/(:num)','Productos::eliminar/$1');
     $routes->get('productos/proveedores/(:num)','Productos::selectProvedores/$1');

     $routes->get('proveedores','Proveedores::index');
     $routes->get('proveedores/(:num)','Proveedores::show/$1');
     $routes->post('proveedores/crear','Proveedores::crear');
     $routes->put('proveedores/editar/(:num)','Proveedores::editar/$1');
     $routes->delete('proveedores/eliminar/(:num)','Proveedores::eliminar/$1');

     $routes->get('ventas','Ventas::index');
     $routes->get('ventas/(:num)','Ventas::show/$1');
     $routes->post('ventas/crear','Ventas::crear');
     $routes->put('ventas/editar/(:num)','Ventas::editar/$1');
     $routes->delete('ventas/eliminar/(:num)','Ventas::eliminar/$1');
     $routes->get('ventas/facturas/(:num)','Ventas::selectFacturas/$1');

     $routes->get('facturas','Facturas::index');
     $routes->get('facturas/(:num)','Facturas::show/$1');
     $routes->post('facturas/crear','Facturas::crear');
     $routes->put('facturas/editar/(:num)','Facturas::editar/$1');
     $routes->delete('facturas/eliminar/(:num)','Facturas::eliminar/$1');
     $routes->get('facturas/cliente/(:num)','Facturas::selectCliente/$1');

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
