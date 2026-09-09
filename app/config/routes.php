<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$router->get('/', 'AuthController::login');

// Student routes (Protected by auth middleware)
$router->group(['prefix' => '/student', 'middleware' => ['auth']], function() use ($router) {
    $router->get('/', 'StudentController::index');
    $router->get('/profile', 'StudentController::profile');
});

$router->get('/users', 'UsersController::index');

// Authentication routes
$router->match('/login', 'AuthController::login', ['GET', 'POST']);
$router->get('/logout', 'AuthController::logout');

// Product routes (Protected by auth middleware)
$router->group(['prefix' => '/products', 'middleware' => ['auth']], function() use ($router) {
    $router->get('/', 'ProductController::index');
    $router->get('/create', 'ProductController::create');
    $router->post('/store', 'ProductController::store');
    $router->get('/edit/{id}', 'ProductController::edit');
    $router->post('/update/{id}', 'ProductController::update');
    $router->get('/delete/{id}', 'ProductController::delete');
});