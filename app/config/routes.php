<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$router->get('/', 'AuthController::login');

// Student routes (Protected by auth middleware)
$router->group(['prefix' => '/student', 'middleware' => ['auth']], function() use ($router) {
    $router->get('/', 'StudentController::index');
    $router->get('/profile', 'StudentController::profile');
});

$router->get('/users', 'UsersController::index');

// JSON API authentication endpoints
$router->match('/api/auth/login', 'AuthController::api_login', ['POST', 'OPTIONS']);
$router->match('/api/auth/refresh', 'AuthController::api_refresh', ['POST', 'OPTIONS']);

// Product API (JWT access token required)
$router->group(['prefix' => '/api/products', 'middleware' => ['api_auth']], function() use ($router) {
    $router->match('/', 'ProductApiController::index', ['GET', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::show', ['GET', 'OPTIONS']);
    $router->match('/', 'ProductApiController::store', ['POST', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::update', ['PUT', 'PATCH', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::destroy', ['DELETE', 'OPTIONS']);
});

// Migration routes
$router->get('/create-migration/{migration_class}', 'MigrationController::create_migration');
$router->get('/migrate', 'MigrationController::migrate');
$router->get('/rollback', 'MigrationController::rollback');
$router->get('/rollback-all', 'MigrationController::rollback_all');
$router->get('/refresh', 'MigrationController::refresh');
$router->get('/status', 'MigrationController::status');

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
