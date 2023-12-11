<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('/', 'UserController::userRegistration');
$routes->get('user/registration', 'UserController::userRegistration');
$routes->post('user/store', 'UserController::userRegistration');
$routes->get('getuserdata', 'UserController::getListOfUser');
$routes->post('user/get', 'UserController::getListOfUser');
$routes->post('user/edit', 'UserController::userEdit');
$routes->post('user/delete', 'UserController::userDelete');
$routes->post('user/update', 'UserController::userUpdate');



