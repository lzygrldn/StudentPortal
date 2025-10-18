<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login'); // Default page goes to login

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::register');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'AuthController::dashboard');

//Courses
$routes->post('/course/enroll', 'CourseController::enroll');

//Admin actions (CRUD on courses)
$routes->get('/course/create', 'CourseController::create');
$routes->post('/course/store', 'CourseController::store');
$routes->get('/course/edit/(:num)', 'CourseController::edit/$1');
$routes->post('/course/update/(:num)', 'CourseController::update/$1');
$routes->get('/course/delete/(:num)', 'CourseController::delete/$1');